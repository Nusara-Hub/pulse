<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RegionController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Region/Index' Inertia page.
     *
     * This action is responsible for rendering the main Region listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Region/Index');
    }

    /**
     * Renders the 'pulse::Region/Input' Inertia page.
     *
     * This action is responsible for rendering the Region input page, which is used to create a new Region.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Region/Input');
    }

    /**
     * Renders the 'pulse::Region/Input' Inertia page with the specified Region ID.
     *
     * This action is responsible for rendering the Region input page, which is used to edit an existing Region.
     *
     * @param string $id The ID of the Region to edit.
     * @return \Inertia\Response The Inertia response containing the Region input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Region/Input', [
            'id' => $id
        ]);
    }
}
