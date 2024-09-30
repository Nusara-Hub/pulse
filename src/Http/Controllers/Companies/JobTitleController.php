<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Companies;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class JobTitleController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::JobTitle/Index' Inertia page.
     *
     * This action is responsible for rendering the main Job Title listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::JobTitle/Index');
    }

    /**
     * Renders the 'pulse::JobTitle/Input' Inertia page.
     *
     * This action is responsible for rendering the Job Title input page, which is used to create a new Job Title.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::JobTitle/Input');
    }

    /**
     * Renders the 'pulse::JobTitle/Input' Inertia page with the specified Job Title ID.
     *
     * This action is responsible for rendering the Job Title input page, which is used to edit an existing Job Title.
     *
     * @param string $id The ID of the Job Title to edit.
     * @return \Inertia\Response The Inertia response containing the Job Title input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::JobTitle/Input', [
            'id' => $id
        ]);
    }
}
