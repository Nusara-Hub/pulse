<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Mutation;
use Maatwebsite\Excel\Concerns\FromCollection;

class MutationExport implements FromCollection
{
    public function collection()
    {
        return Mutation::all();
    }
}
