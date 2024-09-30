<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers\Master;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContractController extends NusaraPulseBaseController
{
    /**
     * Renders the 'pulse::Contract/Index' Inertia page.
     *
     * This action is responsible for rendering the main Contract listing page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('pulse::Contract/Index');
    }

    /**
     * Renders the 'pulse::Contract/Input' Inertia page.
     *
     * This action is responsible for rendering the Contract input page, which is used to create a new Contract.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('pulse::Contract/Input');
    }

    /**
     * Renders the 'pulse::Contract/Input' Inertia page with the specified Contract ID.
     *
     * This action is responsible for rendering the Contract input page, which is used to edit an existing Contract.
     *
     * @param string $id The ID of the Contract to edit.
     * @return \Inertia\Response The Inertia response containing the Contract input page.
     */
    public function edit(string $id): Response
    {
        return Inertia::render('pulse::Contract/Input', [
            'id' => $id
        ]);
    }
}
