<?php

declare(strict_types=1);

namespace Nusara\Pulse\Commands;

use Illuminate\Console\Command;
use Nusara\Pulse\Database\Seeders\PulseDatabaseSeeder;

final class NusaraPulseConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nusara:pulse-exec {--seed : Run the nusara pulse seeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed data from Nusara Pulse package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('seed')) {
            $this->info('Starting to seed Nusara Pulse dummy data...');

            $seeder = new PulseDatabaseSeeder();
            $seeder->run();

            $this->info('Nusara pulse fake data seeded successfully!');
        } else {
            $this->info('No action specified. Use --seed to run the seeder.');
        }

        return 0;
    }
}
