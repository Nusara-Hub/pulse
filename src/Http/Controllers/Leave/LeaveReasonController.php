<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Leave;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LeaveReasonController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::LeaveReason/Index' Inertia page.
     *
     * This action is responsible for rendering the main Leave Reason listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::LeaveReason/Index');
    }

    /**
     * Renders the 'pulse::LeaveReason/Input' Inertia page.
     *
     * This action is responsible for rendering the Leave Reason input page, which is used to create a new Leave Reason.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::LeaveReason/Input');
    }

    /**
     * Renders the 'pulse::LeaveReason/Input' Inertia page with the specified Leave Reason ID.
     *
     * This action is responsible for rendering the Leave Reason input page, which is used to edit an existing Leave Reason.
     *
     * @param string $id The ID of the Leave Reason to edit.
     * @return \Inertia\Response The Inertia response containing the Leave Reason input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::LeaveReason/Input', [
            'id' => $id
        ]);
    }
}
