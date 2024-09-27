<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\SalaryComponent;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalaryComponentExport implements FromCollection
{
    public function collection()
    {
        return SalaryComponent::all();
    }
}
