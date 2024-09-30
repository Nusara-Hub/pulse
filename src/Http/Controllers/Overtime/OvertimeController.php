<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Overtime;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OvertimeController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Overtime/Index' Inertia page.
     *
     * This action is responsible for rendering the main Overtime listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Overtime/Index');
    }

    /**
     * Renders the 'pulse::Overtime/Input' Inertia page.
     *
     * This action is responsible for rendering the Overtime input page, which is used to create a new Overtime.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Overtime/Input');
    }

    /**
     * Renders the 'pulse::Overtime/Input' Inertia page with the specified Overtime ID.
     *
     * This action is responsible for rendering the Overtime input page, which is used to edit an existing Overtime.
     *
     * @param string $id The ID of the Overtime to edit.
     * @return \Inertia\Response The Inertia response containing the Overtime input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Overtime/Input', [
            'id' => $id
        ]);
    }
}
