<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Attendance;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AbsentReasonController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::AbsentReason/Index' Inertia page.
     *
     * This action is responsible for rendering the main Absent Reason listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::AbsentReason/Index');
    }

    /**
     * Renders the 'pulse::AbsentReason/Input' Inertia page.
     *
     * This action is responsible for rendering the Absent Reason input page, which is used to create a new Absent Reason.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::AbsentReason/Input');
    }

    /**
     * Renders the 'pulse::AbsentReason/Input' Inertia page with the specified Absent Reason ID.
     *
     * This action is responsible for rendering the Absent Reason input page, which is used to edit an existing Absent Reason.
     *
     * @param string $id The ID of the Absent Reason to edit.
     * @return \Inertia\Response The Inertia response containing the Absent Reason input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::AbsentReason/Input', [
            'id' => $id
        ]);
    }
}
