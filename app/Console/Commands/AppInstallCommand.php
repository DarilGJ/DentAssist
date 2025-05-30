<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Configure the application and set up initial settings';

    public function handle(): void
    {
        $this->info('Starting application installation...');

        // Step 1: Set up the database connection
        $this->call('db:setup');

        // Step 2: Run migrations
        $this->call('migrate', ['--force' => true]);

        // Step 2: Seed the database with initial data
        $this->call('db:seed', ['--class' => 'ShieldSeeder']);
        $this->call('db:seed', ['--class' => 'InitProjectDataSeeder']);

        // Step 3: Set permissions and roles
        $this->call('shield:super-admin');

        // Step 3: Check if environment variables are set
        if (config('app.env') === 'production') {
            $this->call('cache:clear');
            $this->call('config:clear');
            $this->call('route:clear');
        }

        $this->info('Application installation completed successfully!');
    }
}
