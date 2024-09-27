<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Reason;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReasonExport implements FromCollection
{
    public function collection()
    {
        return Reason::all();
    }
}
