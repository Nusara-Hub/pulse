<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Placement;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlacementExport implements FromCollection
{
    public function collection()
    {
        return Placement::all();
    }
}
