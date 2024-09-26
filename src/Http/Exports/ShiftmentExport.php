<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Shiftment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShiftmentExport implements FromCollection
{
    public function collection()
    {
        return Shiftment::all();
    }
}
