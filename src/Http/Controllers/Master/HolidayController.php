<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HolidayController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Holiday/Index' Inertia page.
     *
     * This action is responsible for rendering the main Holiday listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Holiday/Index');
    }

    /**
     * Renders the 'pulse::Holiday/Input' Inertia page.
     *
     * This action is responsible for rendering the Holiday input page, which is used to create a new Holiday.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Holiday/Input');
    }

    /**
     * Renders the 'pulse::Holiday/Input' Inertia page with the specified Holiday ID.
     *
     * This action is responsible for rendering the Holiday input page, which is used to edit an existing Holiday.
     *
     * @param string $id The ID of the Holiday to edit.
     * @return \Inertia\Response The Inertia response containing the Holiday input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Holiday/Input', [
            'id' => $id
        ]);
    }
}
