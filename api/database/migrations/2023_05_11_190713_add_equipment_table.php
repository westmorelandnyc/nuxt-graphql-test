<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('asset_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('include_in_job_type_default')->nullable();
            $table->string('default_notes')->nullable();
            // $table->unsignedBigInteger('equipment_type');
            $table->boolean('out_of_service')->nullable()->comment('Out of Service?');
            $table->unsignedBigInteger('default_foreman')->nullable();

            // $table->foreign('equipment_type')->references('id')->on('equipment_types');
            $table->foreign('default_foreman')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
};
