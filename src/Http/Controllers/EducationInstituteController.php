<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Controllers;

use Nusara\Pulse\Http\Controllers\NusaraPulseBaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EducationInstituteController extends NusaraPulseBaseController
{
    public function index(): Response
    {
        return Inertia::render('pulse::EducationInstitute/Index');
    }

    public function create(): Response
    {
        return Inertia::render('pulse::EducationInstitute/Input');
    }

    public function edit(string $id): Response
    {
        return Inertia::render('pulse::EducationInstitute/Input', [
            'id' => $id
        ]);
    }
}
