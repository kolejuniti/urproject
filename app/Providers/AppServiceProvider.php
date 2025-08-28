<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\SlowQuery; // Make sure you have this model

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
        DB::listen(function ($query) {
            $executionTime = $query->time / 1000; // ms → seconds

            if ($executionTime > 1) {
                // Convert bindings into a safe, loggable string
                $bindings = implode(', ', array_map(fn($b) => is_numeric($b) ? $b : "'$b'", $query->bindings));

                // Option 1: Log to Laravel log
                Log::warning("Slow query ({$executionTime}s): {$query->sql} | bindings: {$bindings}");

                // Option 2: Log to database
                if (class_exists(SlowQuery::class)) {
                    SlowQuery::create([
                        'sql'            => (string) $query->sql,   // 👈 force cast to string
                        'bindings'       => $bindings,
                        'execution_time' => $executionTime,
                        'connection'     => $query->connectionName,
                    ]);
                }
            }
        });
    }
}
