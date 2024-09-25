<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\SkillGroup;
use Maatwebsite\Excel\Concerns\FromCollection;

class SkillGroupExport implements FromCollection
{
    public function collection()
    {
        return SkillGroup::all();
    }
}
