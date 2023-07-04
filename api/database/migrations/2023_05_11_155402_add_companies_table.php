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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('accounting_dept_point_of_contact')->nullable()->comment('Phone');
            $table->string('accounting_dept_email')->nullable()->comment('Email');
            $table->string('accounting_dept_phone_number')->nullable();
            $table->string('estimators')->nullable()->comment('Email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
