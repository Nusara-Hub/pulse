<?php

declare(strict_types=1);

namespace Nusara\Pulse\Database\Seeders;

use Illuminate\Database\Seeder;

final class PulseDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EducationInstituteSeeder::class);
    }
}
