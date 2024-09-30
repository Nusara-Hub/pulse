<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\SalaryComponent;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\SalaryComponent\CreateRequest;
use Nusara\Pulse\Http\Requests\SalaryComponent\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\SalaryComponentExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class SalaryComponentApiController extends NusaraPulseBaseController
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
        $totalData = SalaryComponent::count();
        $salarycomponents = Pipeline::send(SalaryComponent::query())
            ->through([
                \Nusara\Pulse\Http\Filters\SalaryComponent\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $salarycomponents->count();
        $salarycomponents = $salarycomponents->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Component']),
            data: $salarycomponents->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $salarycomponents
            )
        );
    }

    /**
     * Get a specific Salary Component data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $salarycomponents = SalaryComponent::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Component']),
            data: $salarycomponents
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
        $salarycomponents = SalaryComponent::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Salary Component']),
            data: $salarycomponents
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
        $salarycomponents = SalaryComponent::findOrFail($id);
        $salarycomponents->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Salary Component']),
            data: $salarycomponents
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
        $salarycomponents = SalaryComponent::findOrFail($id);
        $deletedSalaryComponent = tap($salarycomponents)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Salary Component']),
            data: $deletedSalaryComponent
        );
    }

    /**
     * Export Salary Component data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new SalaryComponentExport, 'salary-component.xlsx');
    }
}
