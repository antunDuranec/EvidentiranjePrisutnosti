<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentNaKolegiju extends Model
{
    use Notifiable;
    public $table = "student_na_kolegiju";
    protected $primaryKey = 'sifra_studenta_na_kolegiju';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sifra_kolegija','sifra_studenta_na_kolegiju','sifra_korisnika',
];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'sifra_kolegija','sifra_studenta_na_kolegiju','sifra_korisnika',
];
}
