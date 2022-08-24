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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner');
            $table->date('date_party');

            $table->integer('dj_id')->nullable();
            $table->integer('dj1_id')->nullable();
            $table->integer('dancer_id')->nullable();
            $table->integer('dancer1_id')->nullable();
            $table->integer('dancer2_id')->nullable();
            $table->integer('dancer3_id')->nullable();
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
        Schema::dropIfExists('parties');
    }
};
