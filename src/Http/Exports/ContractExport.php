<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Contract;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContractExport implements FromCollection
{
    public function collection()
    {
        return Contract::all();
    }
}
