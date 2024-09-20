<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EducationInstituteController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::EducationInstitute/Index' Inertia page.
     *
     * This action is responsible for rendering the main education institute listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::EducationInstitute/Index');
    }

    /**
     * Renders the 'pulse::EducationInstitute/Input' Inertia page.
     *
     * This action is responsible for rendering the education institute input page, which is used to create a new education institute.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::EducationInstitute/Input');
    }

    /**
     * Renders the 'pulse::EducationInstitute/Input' Inertia page with the specified education institute ID.
     *
     * This action is responsible for rendering the education institute input page, which is used to edit an existing education institute.
     *
     * @param string $id The ID of the education institute to edit.
     * @return \Inertia\Response The Inertia response containing the education institute input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::EducationInstitute/Input', [
            'id' => $id
        ]);
    }
}
