<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\JobLevel;
use Maatwebsite\Excel\Concerns\FromCollection;

class JobLevelExport implements FromCollection
{
    public function collection()
    {
        return JobLevel::all();
    }
}
