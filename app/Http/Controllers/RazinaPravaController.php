<?php

namespace App\Http\Controllers;

use App\RazinaPrava;
use Illuminate\Http\Request;
use Session;
use DB;

class RazinaPravaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $razine = DB::table('razina_prava')->orderBy('opis', 'asc')->get();

        return view('razina_prava.index',compact('razine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('razina_prava.unos');
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
            'opis' => 'required',

        ],[
            //Custom Error poruke
            'opis.required' => 'Niste unijeli opis razine prava!',

        ]);

        $razina = new RazinaPrava(array(

            'opis' => $request->get('opis'),
        ));

        if($razina->save()){

            Session::flash('flash_message', 'Uspješan unos razine: "'.$razina->opis.'" ');

            return redirect()->back();

        }else

            Session::flash('flash_message1', 'Razina nije spremljena!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RazinaPrava  $razinaPrava
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $razine_prava = RazinaPrava::findOrFail($id);

        $users = DB::table('users')
            ->select('users.sifra_korisnika','users.ime','users.prezime','users.razina_prava','users.email')
            ->where('razina_prava','=',$razine_prava->sifra_razine)
            ->orderBy('users.prezime','asc')->get();


        return view('razina_prava.prikaziRazinupoID-u',compact('razine_prava','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RazinaPrava  $razinaPrava
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $razine_prava = RazinaPrava::findOrFail($id);

        return view('razina_prava.uredivanjeRazine',compact('razine_prava'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RazinaPrava  $razinaPrava
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $razine_prava = RazinaPrava::findOrFail($id);

        $this->validate($request,[

            'opis' => 'required',


        ],[
            //Custom Error poruke
            'opis.required' => 'Niste unijeli opis razine prava!',

        ]);
        $input = $request->all();

        $provjeraKoristenjaFKSUsers = DB::table('users')
            ->leftJoin('razina_prava', 'users.razina_prava', '=', 'razina_prava.sifra_razine')
            ->where('users.razina_prava', '=',$id)
            ->count();



        /* if($provjeraPostojanja==1){

             Session::flash('flash_message1', 'Grad s tim nazivom već postoji za tu županiju!');
             return redirect()->back();
         }*/

        if($provjeraKoristenjaFKSUsers !=0){


            Session::flash('flash_message1', 'Razinu "'.$razine_prava->opis.'" ne možete izmijenjiti! Korisnici se nalaze pod tom razinom!!!');

            return redirect()->back();

        }



        if($razine_prava->update($input)){

            Session::flash('flash_message', 'Razina "'.$razine_prava->opis.'" je uspješno ažurirana!');

            return redirect()->back();

        }else{

            Session::flash('flash_message1', 'Razina prava nije ažurirana!');

            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RazinaPrava  $razinaPrava
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $razine_prava = RazinaPrava::findOrFail($id);

        $provjeraKoristenjaFKSUsers = DB::table('users')
            ->leftJoin('razina_prava', 'users.razina_prava', '=', 'razina_prava.sifra_razine')
            ->where('users.razina_prava', '=',$id)
            ->count();


        if($provjeraKoristenjaFKSUsers !=0){


            Session::flash('flash_message1', 'Razinu "'.$razine_prava->opis.'" ne možete obrisati! Korisnici se nalaze pod tom razinom prava!!!');

            return redirect()->back();

        }

        if($razine_prava->delete()){

            Session::flash('flash_message', 'Razina uspješno obrisana!');

            return redirect('admin/razina-prava');

        }else{

            Session::flash('flash_message1', 'Razina nije obrisana!');

            return redirect()->back();

        }
    }
}
