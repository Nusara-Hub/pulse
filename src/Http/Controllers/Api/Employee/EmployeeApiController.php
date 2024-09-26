<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\Employee;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\Employee\CreateRequest;
use Nusara\Pulse\Http\Requests\Employee\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\EmployeeExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class EmployeeApiController extends NusaraPulseBaseController
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
        $totalData = Employee::count();
        $employees = Pipeline::send(Employee::query())
            ->through([
                \Nusara\Pulse\Http\Filters\Employee\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $employees->count();
        $employees = $employees->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Employee']),
            data: $employees->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $employees
            )
        );
    }

    /**
     * Get a specific Employee data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $employees = Employee::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Employee']),
            data: $employees
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
        $employees = Employee::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Employee']),
            data: $employees
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
        $employees = Employee::findOrFail($id);
        $employees->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Employee']),
            data: $employees
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
        $employees = Employee::findOrFail($id);
        $deletedEmployee = tap($employees)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Employee']),
            data: $deletedEmployee
        );
    }

    /**
     * Export Employee data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new EmployeeExport, 'employee.xlsx');
    }
}
