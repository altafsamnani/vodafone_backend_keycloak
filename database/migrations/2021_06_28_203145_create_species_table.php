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
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planet_id');
            $table->string('name');
            $table->string('classification')->nullable();;
            $table->string('designation')->nullable();;
            $table->string('average_height')->nullable();;
            $table->string('average_lifespan')->nullable();;
            $table->string('eye_colors')->nullable();;
            $table->string('hair_colors')->nullable();;
            $table->string('skin_colors')->nullable();;
            $table->string('language')->nullable();;
            $table->foreign('planet_id')->references('id')->on('planets');
            $table->softDeletes();
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
        Schema::dropIfExists('species');
    }
};
