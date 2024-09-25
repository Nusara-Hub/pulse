<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Exports;

use Nusara\Pulse\Models\Skill;
use Maatwebsite\Excel\Concerns\FromCollection;

class SkillExport implements FromCollection
{
    public function collection()
    {
        return Skill::all();
    }
}
