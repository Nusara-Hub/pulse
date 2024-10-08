<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\EducationTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class EducationTitleExport implements FromCollection
{
    public function collection()
    {
        return EducationTitle::all();
    }
}
