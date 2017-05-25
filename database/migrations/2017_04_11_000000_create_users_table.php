<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('sifra_korisnika')->unsigned();
            $table->string('broj_iskaznice',19)->unique();
            $table->string('ime',45);
            $table->string('prezime',45);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('razina_prava')->unsigned();
            $table->timestamps();

            $table->foreign('razina_prava')->references('sifra_razine')->on('razina_prava')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *$table->primary(['first', 'last']);
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
