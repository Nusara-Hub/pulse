<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\SalaryBenefit;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalaryBenefitExport implements FromCollection
{
    public function collection()
    {
        return SalaryBenefit::all();
    }
}
