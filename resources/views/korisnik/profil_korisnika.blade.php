@extends('layouts.Osnovno')

@section('content')

    <div class="container padding-t-50">
        <div class="row ">
            <div class=" padding-t-50 col-md-4 col-md-offset-4">

                <div class="panel panel-default panel-login-register">

                    <div class="panel-heading text-center ">Podatci o korisniku

                        @if(!Auth::guest() && (Auth::user()->sifra_korisnika == $user->sifra_korisnika || Auth::user()->razina_prava == 1))

                            <a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit') }}">- uredite profil</a>

                        @endif<br/>

                    </div>

                    <div class="panel-body">


                        {!! Form::label('ime', 'Ime: ')  !!}
                        {{ $user->ime }}<br/>

                        {!! Form::label('prezime', 'Prezime: ')  !!}
                        {{ $user->prezime }}<br/>

                        {!! Form::label('email', 'Email: ')  !!}
                        {{ $user->email }}<br/>



                    </div>

                </div>

            </div>

        </div>

    </div>




@endsection