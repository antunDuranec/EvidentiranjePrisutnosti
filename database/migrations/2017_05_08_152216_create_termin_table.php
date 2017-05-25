<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termin', function(Blueprint $table){
            $table->increments('sifra_termina')->unsigned();
            $table->date('datum', 70);
            $table->integer('sifra_kolegija')->unsigned();
            $table->timestamps();


            $table->foreign('sifra_kolegija')->references('sifra_kolegija')->on('kolegij');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('termin');
    }
}
