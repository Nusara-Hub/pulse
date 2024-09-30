<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Companies;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class JobLevelController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::JobLevel/Index' Inertia page.
     *
     * This action is responsible for rendering the main Job Level listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::JobLevel/Index');
    }

    /**
     * Renders the 'pulse::JobLevel/Input' Inertia page.
     *
     * This action is responsible for rendering the Job Level input page, which is used to create a new Job Level.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::JobLevel/Input');
    }

    /**
     * Renders the 'pulse::JobLevel/Input' Inertia page with the specified Job Level ID.
     *
     * This action is responsible for rendering the Job Level input page, which is used to edit an existing Job Level.
     *
     * @param string $id The ID of the Job Level to edit.
     * @return \Inertia\Response The Inertia response containing the Job Level input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::JobLevel/Input', [
            'id' => $id
        ]);
    }
}
