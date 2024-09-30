<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Leave;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LeaveController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Leave/Index' Inertia page.
     *
     * This action is responsible for rendering the main Leave listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Leave/Index');
    }

    /**
     * Renders the 'pulse::Leave/Input' Inertia page.
     *
     * This action is responsible for rendering the Leave input page, which is used to create a new Leave.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Leave/Input');
    }

    /**
     * Renders the 'pulse::Leave/Input' Inertia page with the specified Leave ID.
     *
     * This action is responsible for rendering the Leave input page, which is used to edit an existing Leave.
     *
     * @param string $id The ID of the Leave to edit.
     * @return \Inertia\Response The Inertia response containing the Leave input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Leave/Input', [
            'id' => $id
        ]);
    }
}
