<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Evidencija extends Model
{
    use Notifiable;
    public $table = "evidencija";
    protected $primaryKey = 'sifra_evidencije';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sifra_evidencije','vrsta_predavanja','datum_evidentiranja','prisutnost','sifra_studenta_na_kolegiju',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sifra_evidencije','sifra_studenta_na_kolegiju',
    ];
}
