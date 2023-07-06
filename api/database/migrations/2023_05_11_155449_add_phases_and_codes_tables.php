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
        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->string('phase_number')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('cost_codes', function (Blueprint $table) {
            $table->id();
            $table->string('cost_code_number')->nullable();
            $table->string('description')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('internal_id')->unique()->nullable();
            $table->string('special_spec')->nullable();
            $table->boolean('has_special_spec')->default(false);
            $table->string('spec_filename')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
        Schema::dropIfExists('cost_codes');
    }
};
