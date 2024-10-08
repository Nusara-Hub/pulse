<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Api\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use App\Functions\ResponseJson;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Response;
use Nusara\Pulse\Models\SkillGroup;
use Illuminate\Http\Request;
use Nusara\Pulse\Http\Requests\SkillGroup\CreateRequest;
use Nusara\Pulse\Http\Requests\SkillGroup\UpdateRequest;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Nusara\Pulse\Http\Exports\SkillGroupExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class SkillGroupApiController extends NusaraPulseBaseController
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
        $totalData = SkillGroup::count();
        $skillgroups = Pipeline::send(SkillGroup::query()->with('parent'))
            ->through([
                \Nusara\Pulse\Http\Filters\SkillGroup\BySearch::class,
            ])
            ->thenReturn();
        $totalFiltered = $skillgroups->count();
        $skillgroups = $skillgroups->orderBy('created_at','desc')->paginate($limit, ['*'], 'page', $page);


        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Skill Group']),
            data: $skillgroups->items(),
            pagination: PaginationResource::build(
                totalData: $totalData,
                totalFiltered: $totalFiltered,
                paginationCollection: $skillgroups
            )
        );
    }

    /**
     * Get a specific Skill Group data by id
     *
     * @param string $id The id of education institute
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $skillgroups = SkillGroup::findOrFail($id);

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.fetched', ['prop' => 'Skill Group']),
            data: $skillgroups
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
        $skillgroups = SkillGroup::create($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.created', ['prop' => 'Skill Group']),
            data: $skillgroups
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
        $skillgroups = SkillGroup::findOrFail($id);
        $skillgroups->update($request->validated());

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.updated', ['prop' => 'Skill Group']),
            data: $skillgroups
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
        $skillgroups = SkillGroup::findOrFail($id);
        $deletedSkillGroup = tap($skillgroups)->delete();

        return ResponseJson::success(
            ok: true,
            code: Response::HTTP_OK,
            message: __('app.notification.flash.deleted', ['prop' => 'Skill Group']),
            data: $deletedSkillGroup
        );
    }

    /**
     * Export Skill Group data to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new SkillGroupExport, 'skill-group.xlsx');
    }
}
