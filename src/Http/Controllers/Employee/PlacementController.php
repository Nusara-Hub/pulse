<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Employee;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PlacementController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Placement/Index' Inertia page.
     *
     * This action is responsible for rendering the main Placement listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Placement/Index');
    }

    /**
     * Renders the 'pulse::Placement/Input' Inertia page.
     *
     * This action is responsible for rendering the Placement input page, which is used to create a new Placement.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Placement/Input');
    }

    /**
     * Renders the 'pulse::Placement/Input' Inertia page with the specified Placement ID.
     *
     * This action is responsible for rendering the Placement input page, which is used to edit an existing Placement.
     *
     * @param string $id The ID of the Placement to edit.
     * @return \Inertia\Response The Inertia response containing the Placement input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Placement/Input', [
            'id' => $id
        ]);
    }
}
