<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\EducationInstitute;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\EducationInstitute\CreateRequest;
use Nusara\Pulse\Http\Requests\EducationInstitute\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\EducationInstituteExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class EducationInstituteApiController extends NusaraPulseBaseController
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
        $totalData = EducationInstitute::count();
        $educationInstitutes = Pipeline::send(EducationInstitute::query())
            ->through([
                \Nusara\Pulse\Http\Filters\EducationInstitute\BySearch::class,
                \Nusara\Pulse\Http\Filters\EducationInstitute\ByName::class,
            ])
            ->thenReturn();
        $educationInstitutes = $educationInstitutes->paginate($limit, ['*'], 'page', $page);
        $totalFiltered = $educationInstitutes->count();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: 'Data Education Institute',
            data: $educationInstitutes->items(),
            pagination: [
                'total_data' => $totalData,
                'total_filtered' => $totalFiltered,
                //next page
                'next_page' => $educationInstitutes->nextPageUrl() != null ? true : false,
                //previous page
                'previous_page' => $educationInstitutes->previousPageUrl() != null ? true : false,
                'current_page' => $educationInstitutes->currentPage(),
                'per_page' => $educationInstitutes->perPage(),
                'total_pages' => $educationInstitutes->lastPage(),
            ]
        );
    }

    /**
     * Get a specific education institute data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $educationInstitute = EducationInstitute::find($id);
        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: 'Data Education Institute',
            data: $educationInstitute
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
        $educationInstitute = EducationInstitute::create($request->validated());
        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: 'Data Education Institute',
            data: $educationInstitute
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
        $educationInstitute = EducationInstitute::find($id);
        $educationInstitute->update($request->validated());
        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: 'Data Education Institute',
            data: $educationInstitute
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
        $educationInstitute = EducationInstitute::find($id);
        $educationInstitute->delete();
        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: 'Data Education Institute',
            data: $educationInstitute
        );
    }

    /**
     * Export education institute data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new EducationInstituteExport, 'education-institute.xlsx');
    }
}
