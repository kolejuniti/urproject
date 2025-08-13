<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            $table->enum('type', ['image', 'video', 'link', 'text', 'pdf']);

            // For either file upload or external link
            $table->string('file_path')->nullable();        // local storage path
            $table->string('external_link')->nullable();    // e.g. YouTube/Vimeo/etc

            $table->string('tags')->nullable();             // simple comma-separated tag string
            $table->json('platform')->nullable();           // store target platforms as array

            $table->boolean('is_published')->default(false);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
