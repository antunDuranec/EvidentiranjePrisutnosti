<?php

namespace App\Http\Controllers;

use App\Evidencija;
use App\StudentNaKolegiju;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
use Session;
use Carbon\Carbon;

class EvidencijaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $studenti = DB::table('users')
                    ->leftJoin('student_na_kolegiju', 'users.sifra_korisnika', '=', 'student_na_kolegiju.sifra_korisnika')
                    ->leftJoin('kolegij', 'student_na_kolegiju.sifra_kolegija', '=', 'kolegij.sifra_kolegija')
                    ->leftJoin('termin', 'kolegij.sifra_kolegija', '=', 'termin.sifra_kolegija')
                    ->where('users.sifra_korisnika','=',Auth::user()->sifra_korisnika)
                    ->whereDate('termin.datum','=',Carbon::now()->toDateString())
                    //->whereTime('termin.vrijeme_pocetka', '<=', Carbon::now()->toTimeString())
                    //->whereTime('termin.vrijeme_kraja', '>=', Carbon::now()->toTimeString())
                    ->get();


        return view('evidencija.index',compact('studenti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current = Carbon::now()->toDateTimeString();
        $dt = Carbon::now();
        $dt->setTimezone('Europe/Zagreb');
        $time = $dt->toTimeString();
        //$now = new DateTime();

        $evidencija = new Evidencija(array(

            'vrsta_predavanja' => 'P',
            'datum_evidentiranja' => $current,
            'prisutnost' => 1,
            'sifra_studenta_na_kolegiju' => $request->get('student'),
        ));

        $provjeraPrijave = DB::table('evidencija')
            ->where('sifra_studenta_na_kolegiju','=',$request->get('student'))
            ->whereDate('datum_evidentiranja','=',Carbon::now()->toDateString())
            ->count();


        $vrijemePocetka = DB::table('termin')
            ->where('sifra_termina','>=',$request->get('sifra_termina'))
            ->whereTime('termin.vrijeme_pocetka', '>=', $time)
            ->count();

        $vrijemeKraja = DB::table('termin')
            ->where('sifra_termina','>=',$request->get('sifra_termina'))
            ->whereTime('termin.vrijeme_kraja', '<=', $time)
            ->count();


        if ($vrijemePocetka!=0){

            Session::flash('flash_message1', 'Vrijeme početka termina nije još počelo!!!');

            return redirect()->back();
        }

        if ($vrijemeKraja!=0){

            Session::flash('flash_message1', 'Termin je za današnji datum završio. Ne možete se prijaviti. !!!');

            return redirect()->back();
        }


        if ($provjeraPrijave==1){

            Session::flash('flash_message1', 'Prisutnost je već zabilježena za današnji termin');

            return redirect()->back();
        }

        if($evidencija->save()){

            Session::flash('flash_message', 'Prisutnost uspješno zabilježena');

            return redirect()->back();

        }else

            Session::flash('flash_message1', 'Došlo je do pogreške. Niste prijavili prisutnost. Obratite se administrator ili profesoru!');

        return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evidencija  $evidencija
     * @return \Illuminate\Http\Response
     */
    public function show(Evidencija $evidencija)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evidencija  $evidencija
     * @return \Illuminate\Http\Response
     */
    public function edit(Evidencija $evidencija)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evidencija  $evidencija
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evidencija $evidencija)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evidencija  $evidencija
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evidencija $evidencija)
    {
        //
    }

    public function indexPrisutnost()
    {
        $id = Auth::user()->sifra_korisnika;


        $kolegiji = DB::table('kolegij')
            ->leftJoin('student_na_kolegiju', 'kolegij.sifra_kolegija', '=', 'student_na_kolegiju.sifra_kolegija')
            ->select('kolegij.sifra_kolegija','kolegij.naziv','student_na_kolegiju.*')
            ->where('student_na_kolegiju.sifra_korisnika','=',$id)
            ->get();

        $termini = DB::table('termin')
            ->orderBy('datum','asc')
            ->get();

        $evidencije = DB::table('evidencija')
            ->leftJoin('student_na_kolegiju', 'evidencija.sifra_studenta_na_kolegiju', '=', 'student_na_kolegiju.sifra_studenta_na_kolegiju')
            ->where('student_na_kolegiju.sifra_korisnika','=',$id)
            ->select('evidencija.*','student_na_kolegiju.sifra_kolegija','student_na_kolegiju.sifra_studenta_na_kolegiju','student_na_kolegiju.sifra_korisnika')
            ->get();

        return view('evidencija.MojaEvidencija',compact('kolegiji','evidencije','termini'));
    }



}
