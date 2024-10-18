<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = 'blog';
        $charset = 'utf8mb4';
        $collation = 'utf8mb4_unicode_ci';

        config(['database.connections.mysql.database' => null]);

        DB::statement("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET $charset COLLATE $collation;");

        config(['database.connections.mysql.database' => $database]);

        $this->info("Database '$database' created successfully.");
    }
}
