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
        Schema::create('module_content_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_content_id')->constrained("module_content")->onDelete('cascade');
            $table->string("name");
            $table->string("path");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_content_files');
    }
};
