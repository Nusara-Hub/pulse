<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Payroll;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SalaryAllowanceController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::SalaryAllowance/Index' Inertia page.
     *
     * This action is responsible for rendering the main Salary Allowance listing page.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        $type = $request->type == "allowance" ? "Allowance" : "Deduction";
        return Inertia::render('pulse::SalaryAllowance/Index', [
            'title' => $type,
            'type' => $request->type ?? 'allowance',
        ]);
    }

    /**
     * Renders the 'pulse::SalaryAllowance/Input' Inertia page.
     *
     * This action is responsible for rendering the Salary Allowance input page, which is used to create a new Salary Allowance.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request): Response
    {
        $type = $request->type == "allowance" ? "Allowance" : "Deduction";
        return Inertia::render('pulse::SalaryAllowance/Input', [
            'title' => $type,
            'type' => $request->type ?? 'allowance',
        ]);
    }

    /**
     * Renders the 'pulse::SalaryAllowance/Input' Inertia page with the specified Salary Allowance ID.
     *
     * This action is responsible for rendering the Salary Allowance input page, which is used to edit an existing Salary Allowance.
     *
     * @param string $id The ID of the Salary Allowance to edit.
     * @return \Inertia\Response The Inertia response containing the Salary Allowance input page.
     */
    public function edit(string $id, Request $request): Response
    {
        $type = $request->type == "allowance" ? "Allowance" : "Deduction";
        return Inertia::render('pulse::SalaryAllowance/Input', [
            'id' => $id,
            'title' => $type,
            'type' => $request->type ?? 'allowance',
        ]);
    }
}
