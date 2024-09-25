<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SkillController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Skill/Index' Inertia page.
     *
     * This action is responsible for rendering the main Skill listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Skill/Index');
    }

    /**
     * Renders the 'pulse::Skill/Input' Inertia page.
     *
     * This action is responsible for rendering the Skill input page, which is used to create a new Skill.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Skill/Input');
    }

    /**
     * Renders the 'pulse::Skill/Input' Inertia page with the specified Skill ID.
     *
     * This action is responsible for rendering the Skill input page, which is used to edit an existing Skill.
     *
     * @param string $id The ID of the Skill to edit.
     * @return \Inertia\Response The Inertia response containing the Skill input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Skill/Input', [
            'id' => $id
        ]);
    }
}
