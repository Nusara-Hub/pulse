<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Leave;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeaveExport implements FromCollection
{
    public function collection()
    {
        return Leave::all();
    }
}
