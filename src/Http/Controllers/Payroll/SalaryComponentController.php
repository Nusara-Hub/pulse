<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SalaryComponentController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::SalaryComponent/Index' Inertia page.
     *
     * This action is responsible for rendering the main Salary Component listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::SalaryComponent/Index');
    }

    /**
     * Renders the 'pulse::SalaryComponent/Input' Inertia page.
     *
     * This action is responsible for rendering the Salary Component input page, which is used to create a new Salary Component.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::SalaryComponent/Input');
    }

    /**
     * Renders the 'pulse::SalaryComponent/Input' Inertia page with the specified Salary Component ID.
     *
     * This action is responsible for rendering the Salary Component input page, which is used to edit an existing Salary Component.
     *
     * @param string $id The ID of the Salary Component to edit.
     * @return \Inertia\Response The Inertia response containing the Salary Component input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::SalaryComponent/Input', [
            'id' => $id
        ]);
    }
}
