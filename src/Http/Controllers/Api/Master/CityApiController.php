<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\City;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\City\CreateRequest;
use Nusara\Pulse\Http\Requests\City\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\CityExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class CityApiController extends NusaraPulseBaseController
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
        $totalData = City::count();
        $cities = Pipeline::send(City::query()->with('region'))
            ->through([
                \Nusara\Pulse\Http\Filters\City\BySearch::class,
            ])
            ->thenReturn();
        $cities = $cities->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);
        $totalFiltered = $cities->count();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'City']),
            data: $cities->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $cities
            )
        );
    }

    /**
     * Get a specific City data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $cities = City::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'City']),
            data: $cities
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
        $cities = City::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'City']),
            data: $cities
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
        $cities = City::findOrFail($id);
        $cities->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'City']),
            data: $cities
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
        $cities = City::findOrFail($id);
        $deletedCity = tap($cities)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'City']),
            data: $deletedCity
        );
    }

    /**
     * Export City data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new CityExport, 'city.xlsx');
    }
}
