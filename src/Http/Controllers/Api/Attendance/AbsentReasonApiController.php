<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Attendance;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\AbsentReason;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\AbsentReason\CreateRequest;
use Nusara\Pulse\Http\Requests\AbsentReason\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\AbsentReasonExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class AbsentReasonApiController extends NusaraPulseBaseController
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
        $totalData = AbsentReason::count();
        $absentreasons = Pipeline::send(AbsentReason::query())
            ->through([
                \Nusara\Pulse\Http\Filters\AbsentReason\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $absentreasons->count();
        $absentreasons = $absentreasons->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Absent Reason']),
            data: $absentreasons->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $absentreasons
            )
        );
    }

    /**
     * Get a specific Absent Reason data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $absentreasons = AbsentReason::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Absent Reason']),
            data: $absentreasons
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
        $absentreasons = AbsentReason::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Absent Reason']),
            data: $absentreasons
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
        $absentreasons = AbsentReason::findOrFail($id);
        $absentreasons->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Absent Reason']),
            data: $absentreasons
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
        $absentreasons = AbsentReason::findOrFail($id);
        $deletedAbsentReason = tap($absentreasons)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Absent Reason']),
            data: $deletedAbsentReason
        );
    }

    /**
     * Export Absent Reason data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new AbsentReasonExport, 'absent-reason.xlsx');
    }
}
