<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\SalaryAllowance;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalaryAllowanceExport implements FromCollection
{
    public function collection()
    {
        return SalaryAllowance::all();
    }
}
