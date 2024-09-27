<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\SalaryBenefitHistory;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalaryBenefitHistoryExport implements FromCollection
{
    public function collection()
    {
        return SalaryBenefitHistory::all();
    }
}
