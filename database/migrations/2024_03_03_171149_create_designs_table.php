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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("csv_file")->nullable();
            $table->string("font_type")->nullable();
            $table->string("font_family")->nullable();
            $table->string("variants")->nullable();
            $table->string("font_size")->nullable();
            $table->string("text_alignment")->nullable();
            $table->string("color")->nullable();
            $table->string("image_current_width")->nullable();
            $table->string("image_current_height")->nullable();
            $table->string("position_x")->nullable();
            $table->string("position_y")->nullable();
            $table->string("ttf_file")->nullable();
            $table->date('date');
            $table->string("design_image")->nullable();
            $table->tinyInteger("design_status")->default(0);
            $table->string("template_id")->nullable();
            $table->string("added_from");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
