<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Kolegij extends Model
{
    use Notifiable;
    public $table = "kolegij";
    protected $primaryKey = 'sifra_kolegija';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sifra_kolegija','naziv','sifra_profesora',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sifra_kolegija',
    ];
}
