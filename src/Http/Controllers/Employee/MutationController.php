<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Employee;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MutationController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Mutation/Index' Inertia page.
     *
     * This action is responsible for rendering the main Mutation listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Mutation/Index');
    }

    /**
     * Renders the 'pulse::Mutation/Input' Inertia page.
     *
     * This action is responsible for rendering the Mutation input page, which is used to create a new Mutation.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Mutation/Input');
    }

    /**
     * Renders the 'pulse::Mutation/Input' Inertia page with the specified Mutation ID.
     *
     * This action is responsible for rendering the Mutation input page, which is used to edit an existing Mutation.
     *
     * @param string $id The ID of the Mutation to edit.
     * @return \Inertia\Response The Inertia response containing the Mutation input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Mutation/Input', [
            'id' => $id
        ]);
    }
}
