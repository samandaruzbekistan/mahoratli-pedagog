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
        Schema::create('dicts', function (Blueprint $table) {
            $table->id();
            $table->text('english');
            $table->text('uzbek');
            $table->unsignedBigInteger('dict_section_id');
            $table->foreign('dict_section_id')->references('id')->on('dict_sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dicts');
    }
};
