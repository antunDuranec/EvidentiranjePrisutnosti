<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Termin extends Model
{
    use Notifiable;
    public $table = "termin";
    protected $primaryKey = 'sifra_termina';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sifra_termina','datum','sifra_kolegija','vrijeme_pocetka','vrijeme_kraja',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sifra_termina',
    ];
}
