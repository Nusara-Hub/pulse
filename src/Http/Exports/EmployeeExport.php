<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    public function collection()
    {
        return Employee::all();
    }
}
