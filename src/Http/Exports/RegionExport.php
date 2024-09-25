<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Region;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegionExport implements FromCollection
{
    public function collection()
    {
        return Region::all();
    }
}
