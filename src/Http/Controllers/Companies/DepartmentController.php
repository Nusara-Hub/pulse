<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Companies;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DepartmentController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Department/Index' Inertia page.
     *
     * This action is responsible for rendering the main Department listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Department/Index');
    }

    /**
     * Renders the 'pulse::Department/Input' Inertia page.
     *
     * This action is responsible for rendering the Department input page, which is used to create a new Department.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Department/Input');
    }

    /**
     * Renders the 'pulse::Department/Input' Inertia page with the specified Department ID.
     *
     * This action is responsible for rendering the Department input page, which is used to edit an existing Department.
     *
     * @param string $id The ID of the Department to edit.
     * @return \Inertia\Response The Inertia response containing the Department input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Department/Input', [
            'id' => $id
        ]);
    }
}
