<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Attendance;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AttendanceController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Attendance/Index' Inertia page.
     *
     * This action is responsible for rendering the main Attendance listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Attendance/Index');
    }

    /**
     * Renders the 'pulse::Attendance/Input' Inertia page.
     *
     * This action is responsible for rendering the Attendance input page, which is used to create a new Attendance.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Attendance/Input');
    }

    /**
     * Renders the 'pulse::Attendance/Input' Inertia page with the specified Attendance ID.
     *
     * This action is responsible for rendering the Attendance input page, which is used to edit an existing Attendance.
     *
     * @param string $id The ID of the Attendance to edit.
     * @return \Inertia\Response The Inertia response containing the Attendance input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Attendance/Input', [
            'id' => $id
        ]);
    }
}
