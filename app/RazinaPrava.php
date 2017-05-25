<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class RazinaPrava extends Model
{
    public $table = "razina_prava";
    use Notifiable;
    protected $primaryKey = 'sifra_razine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'opis',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sifra_razine',
    ];
}
