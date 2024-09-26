<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;

class DepartmentExport implements FromCollection
{
    public function collection()
    {
        return Department::all();
    }
}
