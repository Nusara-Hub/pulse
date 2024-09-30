<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Employee;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Employee/Index' Inertia page.
     *
     * This action is responsible for rendering the main Employee listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Employee/Index');
    }

    /**
     * Renders the 'pulse::Employee/Input' Inertia page.
     *
     * This action is responsible for rendering the Employee input page, which is used to create a new Employee.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Employee/Input');
    }

    /**
     * Renders the 'pulse::Employee/Input' Inertia page with the specified Employee ID.
     *
     * This action is responsible for rendering the Employee input page, which is used to edit an existing Employee.
     *
     * @param string $id The ID of the Employee to edit.
     * @return \Inertia\Response The Inertia response containing the Employee input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Employee/Input', [
            'id' => $id
        ]);
    }
}
