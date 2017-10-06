<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Akademska_godina extends Model
{
    use Notifiable;
    public $table = "akademska_godina";
    protected $primaryKey = 'sifra_godine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sifra_godine','broj','sifra_studija',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sifra_godine','sifra_studija',
    ];
}
