<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Companies;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\JobLevel;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\JobLevel\CreateRequest;
use Nusara\Pulse\Http\Requests\JobLevel\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\JobLevelExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class JobLevelApiController extends NusaraPulseBaseController
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
        $totalData = JobLevel::count();
        $joblevels = Pipeline::send(JobLevel::query())
            ->through([
                \Nusara\Pulse\Http\Filters\JobLevel\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $joblevels->count();
        $joblevels = $joblevels->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Job Level']),
            data: $joblevels->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $joblevels
            )
        );
    }

    /**
     * Get a specific Job Level data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $joblevels = JobLevel::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Job Level']),
            data: $joblevels
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
        $joblevels = JobLevel::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Job Level']),
            data: $joblevels
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
        $joblevels = JobLevel::findOrFail($id);
        $joblevels->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Job Level']),
            data: $joblevels
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
        $joblevels = JobLevel::findOrFail($id);
        $deletedJobLevel = tap($joblevels)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Job Level']),
            data: $deletedJobLevel
        );
    }

    /**
     * Export Job Level data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new JobLevelExport, 'job-level.xlsx');
    }
}
