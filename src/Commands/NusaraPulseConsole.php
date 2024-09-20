<?php

declare(strict_types=1);

namespace Nusara\Pulse\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Nusara\Pulse\Database\Seeders\PulseDatabaseSeeder;

final class NusaraPulseConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nusara:pulse-exec {--seed : Run the nusara pulse seeder} {--migration= : Create a new migration file} {--model= : Create a new model file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed data from Nusara Pulse package';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected Filesystem $files;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

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
        } elseif ($migrationName = $this->option('migration')) {
            $this->createMigration($migrationName);
        } elseif ($modelName = $this->option('model')) {
            $this->createModel($modelName);
        } else {
            $this->info('No action specified. Use --seed to run the seeder or --migration to create a migration.');
        }

        return 0;
    }

    /**
     * Create a new migration file.
     *
     * @param string $migrationName
     * @return void
     */
    protected function createMigration(string $migrationName): void
    {
        $stubPath = __DIR__ . '/../../stubs/migrations.stub';
        $migrationPath = __DIR__ . '/../Database/Migrations/'. now()->format('Y_m_d_His') . '_' . Str::snake($migrationName) . '.php';

        if (!$this->files->exists($stubPath)) {
            $this->error('Migration stub file not found at ' . $stubPath);
            return;
        }

        $stubContent = $this->files->get($stubPath);
        $migrationContent = str_replace('DummyTable', getTableNameFromMigration($migrationName), $stubContent);

        $this->files->put($migrationPath, $migrationContent);

        $this->info('Migration created successfully: ' . $migrationPath);
    }

    /**
     * Create a new model file.
     *
     * @param string $modelName
     * @return void
     */
    protected function createModel(string $modelName): void
    {
        $stubPath = __DIR__ . '/../../stubs/models.stub';
        $modelPath = __DIR__ . "/../Models/{$modelName}.php";

        if ($this->files->exists($modelPath)) {
            $this->error("Model {$modelName} already exists.");
            return;
        }

        $stubContent = $this->files->get($stubPath);
        $modelContent = str_replace(['DummyClass', 'DummyTable'], [$modelName, Str::plural(Str::snake(Str::lower($modelName)))], $stubContent);

        $this->files->put($modelPath, $modelContent);

        $this->info("Model {$modelName} created successfully at {$modelPath}");
    }

    /**
     * Display help information.
     *
     * @return void
     */
    protected function showHelp(): void
    {
        $this->info("Command: nusara:pulse-exec");
        $this->info("Description: Seed data or create a migration from Nusara Pulse package.");
        $this->info("\nOptions:");
        $this->info("--seed\t\tRun the nusara pulse seeder to seed dummy data.");
        $this->info("--migration\tCreate a new migration file with the given name.");
        $this->info("--model\t\tCreate a new model file with the given name.");
        $this->info("--help\t\tDisplay this help message.");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return array_merge(parent::getOptions(), [
            ['help', null, null, 'Display this help message', null],
        ]);
    }

    /**
     * Handle the --help option to display command usage.
     *
     * @return mixed
     */
    public function handleHelp()
    {
        if ($this->option('help')) {
            $this->showHelp();
            return 0;
        }

        return parent::handleHelp();
    }
}
