<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;

class CityExport implements FromCollection
{
    public function collection()
    {
        return City::all();
    }
}
