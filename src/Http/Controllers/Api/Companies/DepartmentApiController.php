<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\Department;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\Department\CreateRequest;
use Nusara\Pulse\Http\Requests\Department\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\DepartmentExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class DepartmentApiController extends NusaraPulseBaseController
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
        $totalData = Department::count();
        $departments = Pipeline::send(Department::query())
            ->through([
                \Nusara\Pulse\Http\Filters\Department\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $departments->count();
        $departments = $departments->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Department']),
            data: $departments->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $departments
            )
        );
    }

    /**
     * Get a specific Department data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $departments = Department::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Department']),
            data: $departments
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
        $departments = Department::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Department']),
            data: $departments
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
        $departments = Department::findOrFail($id);
        $departments->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Department']),
            data: $departments
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
        $departments = Department::findOrFail($id);
        $deletedDepartment = tap($departments)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Department']),
            data: $deletedDepartment
        );
    }

    /**
     * Export Department data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new DepartmentExport, 'department.xlsx');
    }
}
