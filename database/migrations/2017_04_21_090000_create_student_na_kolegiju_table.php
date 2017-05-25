<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentNaKolegijuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_na_kolegiju', function (Blueprint $table) {
            $table->increments('sifra_studenta_na_kolegiju',10)->unsigned();
            $table->integer('sifra_kolegija')->unsigned();
            $table->integer('sifra_korisnika')->unsigned();
            $table->timestamps();



            $table->foreign('sifra_kolegija')
                ->references('sifra_kolegija')
                ->on('kolegij')
                ->onDelete('cascade');

            $table->foreign('sifra_korisnika')
                ->references('sifra_korisnika')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_na_kolegiju');
    }
}
