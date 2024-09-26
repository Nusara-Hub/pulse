<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Holiday;
use Maatwebsite\Excel\Concerns\FromCollection;

class HolidayExport implements FromCollection
{
    public function collection()
    {
        return Holiday::all();
    }
}
