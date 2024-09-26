<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\JobTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class JobTitleExport implements FromCollection
{
    public function collection()
    {
        return JobTitle::all();
    }
}
