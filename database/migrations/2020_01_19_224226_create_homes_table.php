<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->string('city');
            $table->string('street');
            $table->text('desription');
            $table->integer('room_count');
            $table->integer('sleep_places');
            $table->string('imagePath');      
            $table->string('price');
            $table->timestamp('date_created');
            $table->string('owner');
            $table->timestamps();

            $table->string('wifi')->nullable(true);
            $table->string('boiler')->nullable(true);
            $table->string('ac')->nullable(true);
            $table->string('parking')->nullable(true);
            $table->string('safe')->nullable(true);
            $table->string('washing_machine')->nullable(true);
            $table->string('tv')->nullable(true);
            $table->string('iron')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homes');
    }
}
