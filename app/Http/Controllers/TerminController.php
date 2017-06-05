<?php

namespace App\Http\Controllers;

use App\Termin;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
use Session;

class TerminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->razina_prava == 2) {

            $termini = DB::table('termin')->orderBy('datum', 'asc')->get();

            $kolegiji = DB::table('kolegij')
                ->where('kolegij.sifra_profesora', '=', Auth::user()->sifra_korisnika)
                ->get();

            return view('termin.index', compact('kolegiji', 'termini'));

        } elseif (Auth::user()->razina_prava == 1) {

            $termini = DB::table('termin')->orderBy('datum', 'asc')->get();
            $kolegiji = DB::table('kolegij')->orderBy('naziv', 'asc')->get();

            return view('termin.index', compact('kolegiji', 'termini'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kolegiji = DB::table('kolegij')->get();

        if (Auth::user()->razina_prava == 2) {

            $kolegiji = DB::table('kolegij')
                ->where('kolegij.sifra_profesora', '=', Auth::user()->sifra_korisnika)
                ->get();

            return view('termin.unos', compact('kolegiji'));

        }elseif (Auth::user()->razina_prava == 1){

        return view('termin.unos', compact('kolegiji'));}

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'datum' => 'required|date',
            'sifra_kolegija' => 'required|not_in:0',
            'vrijeme_pocetka' => 'required',
            'vrijeme_kraja' => 'required',

        ], [
            //Custom Error poruke
            'datum.required' => 'Niste unijeli datum terima!',
            'datum.date' => 'Niste unijeli ispravan datum!',
            'vrijeme_pocetka.required' => 'Niste unijeli vrijeme početka termina!',
            //'vrijeme_pocetka.time' => 'Niste unijeli ispravano vrijeme!',
            'vrijeme_kraja.required' => 'Niste unijeli vrijeme kraja termina!',
           // 'vrijeme_kraja.time' => 'Niste unijeli ispravano vrijeme!',
            'sifra_kolegija.required' => 'Niste odabrali kolegij!',
            'sifra_kolegija.not_in' => 'Niste odabrali kolegij!',

        ]);

        $termin = new Termin(array(

            'datum' => $request->get('datum'),
            'sifra_kolegija' => $request->get('sifra_kolegija'),
            'vrijeme_pocetka' => $request->get('vrijeme_pocetka'),
            'vrijeme_kraja' => $request->get('vrijeme_kraja'),
        ));

        if($request->get('vrijeme_pocetka')>$request->get('vrijeme_kraja')){

            Session::flash('flash_message1', 'Vrijeme početka termina ne može biti poslije vremena kraja termina!!Ispravite grešku!!!');

            return redirect()->back();

        }

        $provjeraTermina = DB::table('termin')
            ->where('datum', '=', $request->get('datum'))
            ->where('sifra_kolegija', '=', $request->get('sifra_kolegija'))
            ->count();

        if ($provjeraTermina != 0) {

            Session::flash('flash_message1', 'Željeni termin već postoji za taj kolegij');

            return redirect()->back();

        }

        if ($termin->save()) {

            Session::flash('flash_message', 'Uspješan unos termina: "' . $termin->datum . '" ');

            return redirect()->back();

        } else

            Session::flash('flash_message1', 'Termin nije spremljen!');

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $termin = Termin::findOrFail($id);

        $users = DB::table('users')
            ->leftJoin('student_na_kolegiju', 'student_na_kolegiju.sifra_korisnika', '=', 'users.sifra_korisnika')
            ->leftJoin('evidencija', 'student_na_kolegiju.sifra_studenta_na_kolegiju', '=', 'evidencija.sifra_studenta_na_kolegiju')
            ->where('evidencija.datum_evidentiranja', '=', $termin->datum)
            ->where('evidencija.prisutnost', '=', 1)
            ->where('student_na_kolegiju.sifra_kolegija', '=', $termin->sifra_kolegija)
            ->orderBy('users.prezime','asc')->get();


        return view('termin.prikaziTerminpoID-u', compact('termin', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $termin = Termin::findOrFail($id);


        $provjeraKoristenjaFK = DB::table('termin')
            ->leftJoin('kolegij', 'termin.sifra_kolegija', '=', 'kolegij.sifra_kolegija')
            ->leftJoin('student_na_kolegiju', 'student_na_kolegiju.sifra_kolegija', '=', 'kolegij.sifra_kolegija')
            ->leftJoin('evidencija', 'student_na_kolegiju.sifra_studenta_na_kolegiju', '=', 'evidencija.sifra_studenta_na_kolegiju')
            ->where('evidencija.datum_evidentiranja', '=', $termin->datum)
            ->count();


        if ($provjeraKoristenjaFK != 0) {


            Session::flash('flash_message1', 'Termin "' . $termin->datum . '" ne možete obrisati! Studenti su prijavljeni za prisutnost za taj termin!!!');

            return redirect()->back();

        }

        if ($termin->delete()) {

            Session::flash('flash_message', 'Termin uspješno obrisan!');

            return redirect('termin');

        } else {

            Session::flash('flash_message1', 'Termin nije obrisan!');

            return redirect()->back();

        }
    }


}
