<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SkillGroupController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::SkillGroup/Index' Inertia page.
     *
     * This action is responsible for rendering the main Skill Group listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::SkillGroup/Index');
    }

    /**
     * Renders the 'pulse::SkillGroup/Input' Inertia page.
     *
     * This action is responsible for rendering the Skill Group input page, which is used to create a new Skill Group.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::SkillGroup/Input');
    }

    /**
     * Renders the 'pulse::SkillGroup/Input' Inertia page with the specified Skill Group ID.
     *
     * This action is responsible for rendering the Skill Group input page, which is used to edit an existing Skill Group.
     *
     * @param string $id The ID of the Skill Group to edit.
     * @return \Inertia\Response The Inertia response containing the Skill Group input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::SkillGroup/Input', [
            'id' => $id
        ]);
    }
}
