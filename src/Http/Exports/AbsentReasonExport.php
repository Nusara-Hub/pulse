<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\AbsentReason;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsentReasonExport implements FromCollection
{
    public function collection()
    {
        return AbsentReason::all();
    }
}
