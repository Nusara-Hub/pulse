<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Leave;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\LeaveReason;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\Reason\CreateRequest;
use Nusara\Pulse\Http\Requests\Reason\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\ReasonExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class LeaveReasonApiController extends NusaraPulseBaseController
{
    /**
     * Get all education institute data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $totalData = LeaveReason::count();
        $reasons = Pipeline::send(LeaveReason::query())
            ->through([
                \Nusara\Pulse\Http\Filters\Reason\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $reasons->count();
        $reasons = $reasons->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Reason']),
            data: $reasons->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $reasons
            )
        );
    }

    /**
     * Get a specific Reason data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $reasons = LeaveReason::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Reason']),
            data: $reasons
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $reasons = LeaveReason::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Reason']),
            data: $reasons
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $reasons = LeaveReason::findOrFail($id);
        $reasons->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Reason']),
            data: $reasons
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function delete(string $id): JsonResponse
    {
        $reasons = LeaveReason::findOrFail($id);
        $deletedReason = tap($reasons)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Reason']),
            data: $deletedReason
        );
    }

    /**
     * Export Reason data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new ReasonExport, 'reason.xlsx');
    }
}
