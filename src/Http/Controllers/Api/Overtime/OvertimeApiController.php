<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Overtime;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\Overtime;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\Overtime\CreateRequest;
use Nusara\Pulse\Http\Requests\Overtime\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\OvertimeExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class OvertimeApiController extends NusaraPulseBaseController
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
        $totalData = Overtime::count();
        $overtimes = Pipeline::send(Overtime::query()->with(['employee','shiftment']))
            ->through([
                \Nusara\Pulse\Http\Filters\Overtime\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $overtimes->count();
        $overtimes = $overtimes->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Overtime']),
            data: $overtimes->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $overtimes
            )
        );
    }

    /**
     * Get a specific Overtime data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $overtimes = Overtime::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Overtime']),
            data: $overtimes
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
        $overtimes = Overtime::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Overtime']),
            data: $overtimes
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
        $overtimes = Overtime::findOrFail($id);
        $overtimes->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Overtime']),
            data: $overtimes
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
        $overtimes = Overtime::findOrFail($id);
        $deletedOvertime = tap($overtimes)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Overtime']),
            data: $deletedOvertime
        );
    }

    /**
     * Export Overtime data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new OvertimeExport, 'overtime.xlsx');
    }
}
