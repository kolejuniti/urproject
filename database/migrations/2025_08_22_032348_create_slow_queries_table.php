<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slow_queries', function (Blueprint $table) {
            $table->id();
            $table->text('sql');
            $table->text('bindings')->nullable();
            $table->float('execution_time'); // in seconds
            $table->string('connection')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slow_queries');
    }
};

