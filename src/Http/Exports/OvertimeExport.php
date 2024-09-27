<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Overtime;
use Maatwebsite\Excel\Concerns\FromCollection;

class OvertimeExport implements FromCollection
{
    public function collection()
    {
        return Overtime::all();
    }
}
