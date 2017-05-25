<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidencijaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencija', function (Blueprint $table) {
            $table->increments('sifra_evidencije',10)->unsigned();
            $table->char('vrsta_predavanja',1);
            $table->timestamp('datum_evidentiranja');
            $table->tinyInteger('prisutnost');
            $table->integer('sifra_studenta_na_kolegiju')->unsigned();
            $table->timestamps();

            $table->foreign('sifra_studenta_na_kolegiju')
                    ->references('sifra_studenta_na_kolegiju')
                    ->on('student_na_kolegiju')
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
        Schema::dropIfExists('evidencija');
    }
}
