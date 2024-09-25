<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EducationTitleController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::EducationTitle/Index' Inertia page.
     *
     * This action is responsible for rendering the main Education Title listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::EducationTitle/Index');
    }

    /**
     * Renders the 'pulse::EducationTitle/Input' Inertia page.
     *
     * This action is responsible for rendering the Education Title input page, which is used to create a new Education Title.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::EducationTitle/Input');
    }

    /**
     * Renders the 'pulse::EducationTitle/Input' Inertia page with the specified Education Title ID.
     *
     * This action is responsible for rendering the Education Title input page, which is used to edit an existing Education Title.
     *
     * @param string $id The ID of the Education Title to edit.
     * @return \Inertia\Response The Inertia response containing the Education Title input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::EducationTitle/Input', [
            'id' => $id
        ]);
    }
}
