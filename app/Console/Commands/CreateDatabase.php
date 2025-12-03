<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabase extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create database if it does not exist (PostgreSQL)';

    public function handle()
    {
        $dbName = config('database.connections.pgsql.database');
        $admin  = DB::connection('admin');

        // Check if database already exists
        $exists = $admin->select(
            "SELECT 1 FROM pg_database WHERE datname = ?", 
            [$dbName]
        );

        if (!empty($exists)) {
            $this->info("Database '$dbName' already exists ✔️");
            return;
        }

        // Create database
        try {
            $admin->statement("CREATE DATABASE \"$dbName\";");

            $this->info("Database '$dbName' created successfully 🎉");

        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }
}
