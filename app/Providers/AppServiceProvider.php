<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // <-- Import Log facade

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Path to SQL file
        $sqlPath = database_path('sql/schema.sql');

        // Check if the file exists before executing
        if (File::exists($sqlPath)) {
            try {
                DB::unprepared(File::get($sqlPath));
                Log::info("SQL schema executed successfully."); // <-- Corrected Log usage
            } catch (\Exception $e) {
                Log::error("Error executing SQL schema: " . $e->getMessage()); // <-- Corrected Log usage
            }
        } else {
            Log::warning("SQL file not found at: " . $sqlPath);
        }
    }
}
