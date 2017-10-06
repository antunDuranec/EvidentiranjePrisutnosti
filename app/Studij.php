<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Studij extends Model
{
    use Notifiable;
    public $table = "studij";
    protected $primaryKey = 'sifra_studija';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sifra_studija','naziv',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sifra_studija',
    ];
}
