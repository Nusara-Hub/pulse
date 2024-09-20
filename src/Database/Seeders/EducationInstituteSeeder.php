<?php

declare(strict_types=1);

namespace Nusara\Pulse\Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Nusara\Pulse\Models\EducationInstitute;

final class EducationInstituteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::all()->runForEach(function ($tenant) {
            if ($tenant->id == 'daycode') {
                for ($i = 0; $i <= 10000; $i++) {
                    EducationInstitute::create([
                        'name' => fake()->company()
                    ]);
                }
            }
        });
    }
}
