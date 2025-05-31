<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConfigurationDatabaseCommand extends Command
{
    protected $signature = 'db:setup';

    protected $description = 'Set up the database connection for the application in the environment file';

    public function handle(): void
    {
        // Initialize the database connection
        $this->info('Setting up the database connection...');

        $this->info('Setting up the database connection...');

        // Handle SQLite configuration
        if ($this->isSqliteDatabase()) {
            $this->handleSqliteSetup();
            $this->info('SQLite database setup completed successfully.');

            return;
        }

        // Handle other database configurations
        $this->handleDatabaseConfiguration();

        $this->info('Database connection details have been updated in the .env file.');

        // You might want to validate the connection here, but for simplicity, we will skip that step
        $this->info('Database connection setup completed successfully.');
    }

    /**
     * Check if the current database configuration is SQLite
     */
    private function isSqliteDatabase(): bool
    {
        return config('database.default') === 'sqlite';
    }

    /**
     * Handle SQLite database setup
     */
    private function handleSqliteSetup(): void
    {
        $sqlitePath = database_path('database.sqlite');

        if (! file_exists($sqlitePath)) {
            touch($sqlitePath);
            $this->info("SQLite database file created at: {$sqlitePath}");
        } else {
            $this->info("Using existing SQLite database file at: {$sqlitePath}");
        }
    }

    /**
     * Handle database configuration for non-SQLite databases
     */
    private function handleDatabaseConfiguration(): void
    {
        $currentConfig = $this->getCurrentDatabaseConfig();

        // Ask if user wants to modify existing configuration
        if ($this->hasExistingDatabaseConfig($currentConfig)) {
            if (! $this->shouldModifyExistingConfig($currentConfig)) {
                $this->info('Database configuration unchanged.');

                return;
            }
        }

        // Get new database configuration from user
        $newConfig = $this->collectDatabaseCredentials();

        // Update the .env file with new configuration
        $this->updateEnvironmentFile($newConfig);

        $this->info('Database connection setup completed successfully.');
    }

    /**
     * Get current database configuration from environment
     */
    private function getCurrentDatabaseConfig(): array
    {
        return [
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
        ];
    }

    /**
     * Check if there's an existing database configuration
     */
    private function hasExistingDatabaseConfig(array $config): bool
    {
        return ! empty($config['database']) || ! empty($config['username']) || ! empty($config['host']);
    }

    /**
     * Ask user if they want to modify existing configuration
     */
    private function shouldModifyExistingConfig(array $currentConfig): bool
    {
        $this->info('Current database configuration:');
        $this->line("Database: {$currentConfig['database']}");
        $this->line("Username: {$currentConfig['username']}");
        $this->line("Host: {$currentConfig['host']}");
        $this->line("Port: {$currentConfig['port']}");

        return $this->confirm('Do you want to modify the current database configuration?');
    }

    /**
     * Collect database credentials from user input
     */
    private function collectDatabaseCredentials(): array
    {
        return [
            'database' => $this->ask('Please enter the database name'),
            'username' => $this->ask('Please enter the database username'),
            'password' => $this->secret('Please enter the database password'),
            'host' => $this->ask('Please enter the database host', 'localhost'),
            'port' => $this->ask('Please enter the database port', '3306'),
        ];
    }

    /**
     * Update the .env file with new database configuration
     */
    private function updateEnvironmentFile(array $config): void
    {
        $envFile = base_path('.env');

        if (! file_exists($envFile)) {
            $this->error('.env file not found!');

            return;
        }

        $envContent = file_get_contents($envFile);
        $updatedContent = $this->updateEnvironmentVariables($envContent, $config);

        file_put_contents($envFile, $updatedContent);

        $this->info("Database connection set to: {$config['host']}:{$config['port']}/{$config['database']} with user {$config['username']}");
        $this->info('Database connection details have been updated in the .env file.');
    }

    /**
     * Update or add environment variables in the .env content
     */
    private function updateEnvironmentVariables(string $envContent, array $config): string
    {
        $variables = [
            'DB_DATABASE' => $config['database'],
            'DB_USERNAME' => $config['username'],
            'DB_PASSWORD' => $config['password'],
            'DB_HOST' => $config['host'],
            'DB_PORT' => $config['port'],
        ];

        foreach ($variables as $key => $value) {

            if ($key == 'DB_PASSWORD' && empty($value)) {
                // Skip updating the password if it's empty
                continue;
            }

            $envContent = $this->updateOrAddEnvironmentVariable($envContent, $key, $value);
        }

        return $envContent;
    }

    /**
     * Update an existing environment variable or add it if it doesn't exist
     */
    private function updateOrAddEnvironmentVariable(string $envContent, string $key, string $value): string
    {
        $pattern = "/^#?{$key}=.*/m";
        $replacement = "{$key}={$value}";

        // If the variable exists (commented or not), replace it
        if (preg_match($pattern, $envContent)) {
            return preg_replace($pattern, $replacement, $envContent);
        }

        // If the variable doesn't exist, add it at the end
        return $envContent."\n{$replacement}";
    }
}
