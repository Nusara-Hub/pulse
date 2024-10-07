<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\SalaryBenefit;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\SalaryBenefit\CreateRequest;
use Nusara\Pulse\Http\Requests\SalaryBenefit\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\SalaryBenefitExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class SalaryBenefitApiController extends NusaraPulseBaseController
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
        $totalData = SalaryBenefit::count();
        $salarybenefits = Pipeline::send(SalaryBenefit::query()->with(['employee','component']))
            ->through([
                \Nusara\Pulse\Http\Filters\SalaryBenefit\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $salarybenefits->count();
        $salarybenefits = $salarybenefits->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Benefit']),
            data: $salarybenefits->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $salarybenefits
            )
        );
    }

    /**
     * Get a specific Salary Benefit data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $salarybenefits = SalaryBenefit::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Benefit']),
            data: $salarybenefits
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
        $salarybenefits = SalaryBenefit::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Salary Benefit']),
            data: $salarybenefits
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
        $salarybenefits = SalaryBenefit::findOrFail($id);
        $salarybenefits->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Salary Benefit']),
            data: $salarybenefits
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
        $salarybenefits = SalaryBenefit::findOrFail($id);
        $deletedSalaryBenefit = tap($salarybenefits)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Salary Benefit']),
            data: $deletedSalaryBenefit
        );
    }

    /**
     * Export Salary Benefit data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new SalaryBenefitExport, 'salary-benefit.xlsx');
    }
}
