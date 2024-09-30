<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SalaryBenefitHistoryController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::SalaryBenefitHistory/Index' Inertia page.
     *
     * This action is responsible for rendering the main Salary Benefit History listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::SalaryBenefitHistory/Index');
    }

    /**
     * Renders the 'pulse::SalaryBenefitHistory/Input' Inertia page.
     *
     * This action is responsible for rendering the Salary Benefit History input page, which is used to create a new Salary Benefit History.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::SalaryBenefitHistory/Input');
    }

    /**
     * Renders the 'pulse::SalaryBenefitHistory/Input' Inertia page with the specified Salary Benefit History ID.
     *
     * This action is responsible for rendering the Salary Benefit History input page, which is used to edit an existing Salary Benefit History.
     *
     * @param string $id The ID of the Salary Benefit History to edit.
     * @return \Inertia\Response The Inertia response containing the Salary Benefit History input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::SalaryBenefitHistory/Input', [
            'id' => $id
        ]);
    }
}
