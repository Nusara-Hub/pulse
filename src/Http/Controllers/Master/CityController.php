<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CityController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::City/Index' Inertia page.
     *
     * This action is responsible for rendering the main City listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::City/Index');
    }

    /**
     * Renders the 'pulse::City/Input' Inertia page.
     *
     * This action is responsible for rendering the City input page, which is used to create a new City.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::City/Input');
    }

    /**
     * Renders the 'pulse::City/Input' Inertia page with the specified City ID.
     *
     * This action is responsible for rendering the City input page, which is used to edit an existing City.
     *
     * @param string $id The ID of the City to edit.
     * @return \Inertia\Response The Inertia response containing the City input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::City/Input', [
            'id' => $id
        ]);
    }
}
