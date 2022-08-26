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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner')->nullable();
            $table->string('presentation');
            $table->integer('prims');
            $table->integer('remaining_house_prims');
            $table->string('date_start_rent')->nullable();
            $table->string('date_end_rent')->nullable();
            $table->timestamps();

            $table->foreignId('tenant_id')->nullable();
            $table->foreignId('land_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
};
