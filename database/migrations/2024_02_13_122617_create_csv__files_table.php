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
        Schema::create('csv__files', function (Blueprint $table) {
            $table->id();
            $table->string("csv_name");
            $table->string("csv_file");
            $table->string("csv_file_status");
            $table->date('date');
            $table->string("added_from");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv__files');
    }
};
