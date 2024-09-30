<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\SalaryBenefitHistory;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\SalaryBenefitHistory\CreateRequest;
use Nusara\Pulse\Http\Requests\SalaryBenefitHistory\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\SalaryBenefitHistoryExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class SalaryBenefitHistoryApiController extends NusaraPulseBaseController
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
        $totalData = SalaryBenefitHistory::count();
        $salarybenefithistories = Pipeline::send(SalaryBenefitHistory::query())
            ->through([
                \Nusara\Pulse\Http\Filters\SalaryBenefitHistory\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $salarybenefithistories->count();
        $salarybenefithistories = $salarybenefithistories->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Benefit History']),
            data: $salarybenefithistories->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $salarybenefithistories
            )
        );
    }

    /**
     * Get a specific Salary Benefit History data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $salarybenefithistories = SalaryBenefitHistory::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Salary Benefit History']),
            data: $salarybenefithistories
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
        $salarybenefithistories = SalaryBenefitHistory::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Salary Benefit History']),
            data: $salarybenefithistories
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
        $salarybenefithistories = SalaryBenefitHistory::findOrFail($id);
        $salarybenefithistories->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Salary Benefit History']),
            data: $salarybenefithistories
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
        $salarybenefithistories = SalaryBenefitHistory::findOrFail($id);
        $deletedSalaryBenefitHistory = tap($salarybenefithistories)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Salary Benefit History']),
            data: $deletedSalaryBenefitHistory
        );
    }

    /**
     * Export Salary Benefit History data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new SalaryBenefitHistoryExport, 'salary-benefit-history.xlsx');
    }
}
