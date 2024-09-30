<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Attendance;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\Shiftment;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\Shiftment\CreateRequest;
use Nusara\Pulse\Http\Requests\Shiftment\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\ShiftmentExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class ShiftmentApiController extends NusaraPulseBaseController
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
        $totalData = Shiftment::count();
        $shiftments = Pipeline::send(Shiftment::query())
            ->through([
                \Nusara\Pulse\Http\Filters\Shiftment\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $shiftments->count();
        $shiftments = $shiftments->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Shiftment']),
            data: $shiftments->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $shiftments
            )
        );
    }

    /**
     * Get a specific Shiftment data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $shiftments = Shiftment::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Shiftment']),
            data: $shiftments
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
        $shiftments = Shiftment::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Shiftment']),
            data: $shiftments
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
        $shiftments = Shiftment::findOrFail($id);
        $shiftments->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Shiftment']),
            data: $shiftments
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
        $shiftments = Shiftment::findOrFail($id);
        $deletedShiftment = tap($shiftments)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Shiftment']),
            data: $deletedShiftment
        );
    }

    /**
     * Export Shiftment data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new ShiftmentExport, 'shiftment.xlsx');
    }
}
