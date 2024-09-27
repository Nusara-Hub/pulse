<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\SalaryAllowance;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\SalaryAllowance\CreateRequest;
use Nusara\Pulse\Http\Requests\SalaryAllowance\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\SalaryAllowanceExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class SalaryAllowanceApiController extends NusaraPulseBaseController
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
        $totalData = SalaryAllowance::count();
        $salaryallowances = Pipeline::send(SalaryAllowance::query())
            ->through([
                \Nusara\Pulse\Http\Filters\SalaryAllowance\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $salaryallowances->count();
        $salaryallowances = $salaryallowances->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Allowance']),
            data: $salaryallowances->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $salaryallowances
            )
        );
    }

    /**
     * Get a specific Salary Allowance data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $salaryallowances = SalaryAllowance::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Allowance']),
            data: $salaryallowances
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
        $salaryallowances = SalaryAllowance::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Salary Allowance']),
            data: $salaryallowances
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
        $salaryallowances = SalaryAllowance::findOrFail($id);
        $salaryallowances->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Salary Allowance']),
            data: $salaryallowances
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
        $salaryallowances = SalaryAllowance::findOrFail($id);
        $deletedSalaryAllowance = tap($salaryallowances)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Salary Allowance']),
            data: $deletedSalaryAllowance
        );
    }

    /**
     * Export Salary Allowance data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new SalaryAllowanceExport, 'salary-allowance.xlsx');
    }
}
