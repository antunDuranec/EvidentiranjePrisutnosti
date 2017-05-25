<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Session;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'sifra_korisnika';
    protected $id = 'sifra_korisnika';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ime', 'prezime', 'password','email','razina_prava','broj_iskaznice','sifra_korisnika',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'lozinka', 'remember_token','sifra_korisnika','broj_iskaznice','razina_prava',
    ];


}
