<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\EducationInstitute;
use Maatwebsite\Excel\Concerns\FromCollection;

class EducationInstituteExport implements FromCollection
{
    public function collection()
    {
        return EducationInstitute::all();
    }
}
