<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Attendance;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ShiftmentController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Shiftment/Index' Inertia page.
     *
     * This action is responsible for rendering the main Shiftment listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Shiftment/Index');
    }

    /**
     * Renders the 'pulse::Shiftment/Input' Inertia page.
     *
     * This action is responsible for rendering the Shiftment input page, which is used to create a new Shiftment.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Shiftment/Input');
    }

    /**
     * Renders the 'pulse::Shiftment/Input' Inertia page with the specified Shiftment ID.
     *
     * This action is responsible for rendering the Shiftment input page, which is used to edit an existing Shiftment.
     *
     * @param string $id The ID of the Shiftment to edit.
     * @return \Inertia\Response The Inertia response containing the Shiftment input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Shiftment/Input', [
            'id' => $id
        ]);
    }
}
