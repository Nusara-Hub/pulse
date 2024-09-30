<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SalaryBenefitController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::SalaryBenefit/Index' Inertia page.
     *
     * This action is responsible for rendering the main Salary Benefit listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::SalaryBenefit/Index');
    }

    /**
     * Renders the 'pulse::SalaryBenefit/Input' Inertia page.
     *
     * This action is responsible for rendering the Salary Benefit input page, which is used to create a new Salary Benefit.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::SalaryBenefit/Input');
    }

    /**
     * Renders the 'pulse::SalaryBenefit/Input' Inertia page with the specified Salary Benefit ID.
     *
     * This action is responsible for rendering the Salary Benefit input page, which is used to edit an existing Salary Benefit.
     *
     * @param string $id The ID of the Salary Benefit to edit.
     * @return \Inertia\Response The Inertia response containing the Salary Benefit input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::SalaryBenefit/Input', [
            'id' => $id
        ]);
    }
}
