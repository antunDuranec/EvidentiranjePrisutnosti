<?php

namespace App\Http\Controllers;

use App\Kolegij;
use App\StudentNaKolegiju;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class StudentNaKolegijuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kolegiji = Kolegij::all();

        $korisnici = DB::table('users')->where('razina_prava','=',3)->get();

        $studenti_na_kolegiju = StudentNaKolegiju::all();


        return view('student_na_kolegiju.index',compact('kolegiji','korisnici','studenti_na_kolegiju'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kolegiji = DB::table('kolegij')->orderBy('naziv','asc')->get();
        $profesori = DB::table('users')->where('razina_prava','=',3)->orderBy('ime', 'asc')->get();

        return view('student_na_kolegiju.unos',compact('profesori','kolegiji'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'sifra_kolegija' => 'required|not_in:0',
            'sifra_korisnika' => 'required|not_in:0',

        ],[
            //Custom Error poruke
            'sifra_kolegija.required' => 'Niste odabrali kolegij!',
            'sifra_kolegija.not_in' => 'Niste odabrali kolegij!',
            'sifra_korisnika.required' => 'Niste odabrali studenta!',
            'sifra_korisnika.not_in' => 'Niste odabrali studenta!',

        ]);

        $student_na_kolegiju = new StudentNaKolegiju(array(

            'sifra_kolegija' => $request->get('sifra_kolegija'),
            'sifra_korisnika' => $request->get('sifra_korisnika'),
        ));


        $provjeraPostojanja = DB::table('student_na_kolegiju')
        ->where('student_na_kolegiju.sifra_kolegija', '=', $request['sifra_kolegija'])
        ->where('student_na_kolegiju.sifra_korisnika', '=', $request['sifra_korisnika'])
        ->count();


        $profesor = DB::table('users')
            ->select('users.sifra_korisnika','users.ime','users.prezime')
            ->where('sifra_korisnika','=',$request->sifra_korisnika)
            ->first();

        $nazivKolegija = DB::table('kolegij')
            ->select('kolegij.sifra_kolegija','kolegij.naziv')
            ->where('sifra_kolegija','=',$request->sifra_kolegija)
            ->first();

        if($provjeraPostojanja==1){

            Session::flash('flash_message1', 'Student je već upisan na taj kolegij!');
            return redirect()->back();
        }

        if($student_na_kolegiju->save()){

            Session::flash('flash_message', 'Uspješan unos studenta: "'.$profesor->ime.' '.$profesor->prezime.'" na koelgij "'.$nazivKolegija->naziv.'" ');

            return redirect()->back();

        }else

            Session::flash('flash_message1', 'Povezivanje studenta s kolegijom nije uspješno!');

            return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentNaKolegiju  $studentNaKolegiju
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentNaKolegiju  $studentNaKolegiju
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = StudentNaKolegiju::findOrFail($id);
        $kolegiji = Kolegij::all();


        $nazivStudenta = DB::table('users')
            ->select('users.ime','users.prezime','users.sifra_korisnika')
            ->join('student_na_kolegiju', 'users.sifra_korisnika', '=', 'student_na_kolegiju.sifra_korisnika')
            ->where('users.sifra_korisnika', '=', $student->sifra_korisnika)
            ->first();

        $nazivKolegija = DB::table('kolegij')
            ->select('kolegij.naziv')
            ->join('student_na_kolegiju', 'kolegij.sifra_kolegija', '=', 'student_na_kolegiju.sifra_kolegija')
            ->where('kolegij.sifra_kolegija', '=', $student->sifra_kolegija)
            ->first();

        return view('student_na_kolegiju.uredivanjeStudentaIKolegija',compact('kolegiji','student','nazivKolegija','nazivStudenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentNaKolegiju  $studentNaKolegiju
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentNaKolegiju $studentNaKolegiju)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentNaKolegiju  $studentNaKolegiju
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = StudentNaKolegiju::findOrFail($id);


        if($student->delete()){

            Session::flash('flash_message', 'Student uspješno obrisan sa kolegija!');

            return redirect('admin/student-kolegij');

        }else{

            Session::flash('flash_message1', 'Student nije obrisan sa kolegija. Greška sustava!');

            return redirect()->back();

        }
    }

    public function index1()
    {
        $kolegiji = DB::table('kolegij')
            ->where('kolegij.sifra_profesora', '=', Auth::user()->sifra_korisnika)
            ->get();

        $korisnici = DB::table('users')->where('razina_prava','=',3)->get();

        $studenti_na_kolegiju = StudentNaKolegiju::all();


        return view('student_na_kolegiju.index1',compact('kolegiji','korisnici','studenti_na_kolegiju'));
    }
}
