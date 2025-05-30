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

        // Check if the default database connection is SQLite
        if (config('database.default') === 'sqlite') {
            // Check existence of SQLite database file
            $sqlitePath = database_path('database.sqlite');
            if (!file_exists($sqlitePath)) {
                touch($sqlitePath);
                $this->info("SQLite database file created at: {$sqlitePath}");
            } else {
                $this->info("Using existing SQLite database file at: {$sqlitePath}");
            }

            return;
        }

        // Field for database connection setup
        $database = $this->ask('Please enter the database name');
        $username = $this->ask('Please enter the database username');
        $password = $this->secret('Please enter the database password');
        $host = $this->ask('Please enter the database host', 'localhost');
        $port = $this->ask('Please enter the database port', '3306');

        // Here you would typically set the database connection in your environment file
        $this->info("Database connection set to: {$host}:{$port}/{$database} with user {$username}");

        // Set the environment variables in the .env file
        $envFile = base_path('.env');
        $envContent = file_get_contents($envFile);
        $envContent = preg_replace('/^DB_DATABASE=.*/m', "DB_DATABASE={$database}", $envContent);
        $envContent = preg_replace('/^DB_USERNAME=.*/m', "DB_USERNAME={$username}", $envContent);
        $envContent = preg_replace('/^DB_PASSWORD=.*/m', "DB_PASSWORD={$password}", $envContent);
        $envContent = preg_replace('/^DB_HOST=.*/m', "DB_HOST={$host}", $envContent);
        $envContent = preg_replace('/^DB_PORT=.*/m', "DB_PORT={$port}", $envContent);
        file_put_contents($envFile, $envContent);
        $this->info('Database connection details have been updated in the .env file.');

        // You might want to validate the connection here, but for simplicity, we will skip that step
        $this->info('Database connection setup completed successfully.');
    }
}
