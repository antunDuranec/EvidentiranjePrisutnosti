<?php

namespace App\Http\Controllers;

use App\RazinaPrava;
use App\User;
use Illuminate\Http\Request;
use Hash;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $korisnici = User::all();
        $razine = RazinaPrava::all();


        return view('korisnik.index',compact('korisnici','razine'));
    }

    public function indexAdmin()
    {
        $korisnici = User::all();
        $razine = RazinaPrava::all();


        return view('korisnik.index',compact('korisnici','razine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('korisnik.unos');
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
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'kartica' => 'required|numeric',
            'razina_prava' =>'required|not_in:0'

        ],[
//Custom error poruke
            'ime.required' => 'Niste unijeli ime!',
            'ime.max' => 'Ime može imati maksimalno 255 znakova!',
            'ime.string' => 'Ime mora biti u tekstualnom obliku!',
            'prezime.required' => 'Niste unijeli prezime!',
            'prezime.max' => 'Prezime može imati maksimalno 255 znakova!',
            'prezime.string' => 'Prezime mora biti u tekstualnom obliku!',
            'email.required' => 'Niste unijeli e-mail!',
            'email.email' => 'Molimo unesite valjanju e-mail adresu!',
            'email.max' => 'E-mail može imati maximalno 255 znakova!',
            'email.unique' => 'Postoji korisnik u sustav s takvom e-mail adresom!',
            'password.required' => 'Niste unijeli lozinku!',
            'password.min' => 'Lozinka mora imati minimalno 6 znakova!',
            'password.confirmed' => 'Lozinke se ne podudaraju!',
            'kartica.required' => 'Niste unijeli broj X-ice!',
            'kartica.numeric' => 'Broj X-ice mora biti u brojčanom formatu!',
            'razina_prava.required' => 'Niste odabrali razinu prava!',
            'razina_prava.not_in' => 'Niste odabrali razinu prava!',
        ]);

            $korisnik = new User(array(
                'ime' => $request->get('ime'),
                'prezime' =>$request->get('prezime'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'broj_iskaznice' => $request->get('kartica'),
                'razina_prava' => $request->get('razina_prava'),

            ));



                if($korisnik->save()){

                Session::flash('flash_message', 'Uspješan unos korisnika: "'.$korisnik->ime.' '.$korisnik->prezime.'" ');

                return redirect()->back();

                }else

                    Session::flash('flash_message1', 'Korisnik nije unesen!');

                    return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('korisnik.profil_korisnika',compact('user'));



        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if($user->sifra_korisnika == Auth::user()->sifra_korisnika || Auth::user()->razina_prava == 1){

            return view('korisnik.uredivanje_profila',compact('user'));

        }
    }

    public function edit_password($id)
    {
        $user = User::findOrFail($id);

        if($user->id == Auth::user()->id || Auth::user()->legenda == 1){

            return view('korisnik.izmjena_lozinke',compact('user'));

        }

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($sifra_korisnika, Request $request)
    {
        $user = User::findOrFail($sifra_korisnika);


        $this->validate($request,[

            'ime' => 'required|max:255',
            'prezime' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$sifra_korisnika.',sifra_korisnika',
            'broj_iskaznice' => 'required|numeric|unique:users,broj_iskaznice,'.$sifra_korisnika.',sifra_korisnika',
            //'razina_prava' =>'required|not_in:0'

        ],[
            //Custom error poruke
            'ime.required' => 'Niste unijeli ime!',
            'ime.max' => 'Ime može imati maksimalno 255 znakova!',
            'prezime.required' => 'Niste unijeli prezime!',
            'prezime.max' => 'Prezime može imati maksimalno 255 znakova!',
            'email.required' => 'Niste unijeli e-mail!',
            'email.email' => 'Molimo unesite valjanju e-mail adresu!',
            'email.max' => 'E-mail može imati maximalno 255 znakova!',
            'email.unique' => 'Željeni e-mail već postoji, Molimo pokušajte s drugim email-om!',
            'broj_iskaznice.required' => 'Niste unijeli broj iskaznice!',
            'broj_iskaznice.numeric' => 'Broj iskaznice mora biti u brojčanom formatu!',
            'broj_iskaznice.unique' => 'Broj unesene iskaznice već postoji, Molimo unesite svoj broj iskaznice!',
            //'razina_prava.required' => 'Niste odabrali razinu prava!',
            //'razina_prava.not_in' => 'Niste odabrali razinu prava!',

        ]);

        if($user->sifra_korisnika == Auth::user()->sifra_korisnika || Auth::user()->razina_prava == 1){

            $user->update($request->all());

            Session::flash('flash_message', 'Profil usješno ažuriran!');

            return redirect()->back();
        }else


        return redirect()->back();
    }

    public function update_password($sifra_korisnika, Request $request)
    {

        $this->validate($request, [

            'old_password' => 'required',
            'password' => 'required|min:6|confirmed|different:old_password',

        ], [
            //Custom error poruke
            'password.required' => 'Niste unijeli lozinku!',
            'password.min' => 'Lozinka mora imati minimalno 6 znakova!',
            'password.confirmed' => 'Lozinke se ne podudaraju!',
            'password.different' => 'Unijeli ste netočno staru lozinku!',
            'old_password.required' => 'Niste unijeli lozinku!',

        ]);


        $user = User::find(Auth::user()->sifra_korisnika);

        $old_password = Input::get('old_password');
        $password = Input::get('password');

        // test input password against the existing one
        if (Hash::check($old_password, $user->getAuthPassword())) {
            $user->password = Hash::make($password);

            // save the new password
            if ($user->save()) {

                Session::flash('flash_message', 'Lozinka uspješno izmjenjena!');

                return redirect()->back();

            }

        } else {// ovo je slučaj ako nema different koji se nalazi u validatoru

            Session::flash('flash_message1', 'Unijeli ste netočno staru lozinku!');

            return redirect()->back();
        }

        /* fall back */
        Session::flash('flash_message1', 'Vaša lozinka nije izmjenjena!');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kolegij  $kolegij
     * @return \Illuminate\Http\Response
     */
    public function destroy1(Request $request,$id)
    {
        $korisnik = User::findOrFail($id);

        // $kolegij = Kolegij::findOrFail($id);
        $sortBy = 0;

        $sifraStudentaNaKolegiju = DB::table('student_na_kolegiju')
            ->where('student_na_kolegiju.sifra_korisnika','=', $korisnik->sifra_korisnika)
            ->where('student_na_kolegiju.sifra_kolegija', '=',$request->get('termin'))
            ->first();

        $izbrisiPrisutnostZaKorinika = DB::table('evidencija')
            ->where('evidencija.sifra_studenta_na_kolegiju','=', $sifraStudentaNaKolegiju->sifra_studenta_na_kolegiju)
            ->where('evidencija.datum_evidentiranja', '=',$request->get('datum'))
            ->update(['evidencija.prisutnost' => $sortBy]);

        $profesor = DB::table('users')
            ->select('users.sifra_korisnika','users.ime','users.prezime')
            ->where('sifra_korisnika','=',$korisnik->sifra_korisnika)
            ->first();


        if($izbrisiPrisutnostZaKorinika){

            Session::flash('flash_message', 'Student uspješno obrisan sa termina predavnja "'.$profesor->ime.' '.$profesor->prezime.'"!');

            return redirect()->back();

        }else{

            Session::flash('flash_message1', 'Student nije obrisan s predavnja!');

            return redirect()->back();

        }
    }
}
