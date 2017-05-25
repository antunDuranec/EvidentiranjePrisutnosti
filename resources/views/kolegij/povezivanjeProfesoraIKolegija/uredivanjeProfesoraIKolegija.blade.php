@extends('layouts.Osnovno')

@section('content')

    <div class="col-lg-6 col-lg-offset-3" style="margin-top: 50px;">

        {!! Form::model($kolegij, ['method'=> 'PATCH', 'action' => ['KolegijController@update', $kolegij->sifra_kolegija]]) !!}


        <div class="row">

            <div class="col-md-10">

                <h1>Uređivanje "{{ $kolegij->naziv }}"</h1>

            </div>

        </div>

        <p class="lead">Uredi i spremi Kolegij, ili <a href="{{ url('admin/kolegij') }}">povratak na prikaz svih kolegija.</a></p>
        <hr>

        <div class="row">

            <div class="col-md-9">

                @include('errors.session_error_poruke')
                @include('errors.session_poruke')

            </div>

        </div>

        <div class="row">

            <div class="col-md-9 form-group {{ $errors->has('naziv') ? 'has-error' : ''  }}">


                {!! Form::text('naziv', null, ['class' => 'form-control','placeholder'=>'Naziv kolegija']) !!}

                @if ($errors->has('naziv'))

                    <span class="help-block">

                        <strong>{{ $errors->first('naziv') }}</strong>

                    </span>

                @endif

            </div>

        </div>

        <div class="row">

            <div class="col-md-9 form-group {{ $errors->has('sifra_korisnika') ? 'has-error' : ''  }}">



                <select class="form-control" name="sifra_korisnika" id="sifra_korisnika">

                    @foreach($profesori as $profesor)

                        <option value="{{$profesor->sifra_korisnika}}">{{$profesor->ime}} {{$profesor->prezime}}</option>

                    @endforeach

                        <option value="0">--Odaberite nositelja kolegija--</option>
                        <option value="{{$kolegij->sifra_profesora}}" selected="selected">{{ $nazivProfesora->ime }} {{ $nazivProfesora->prezime }}</option>

                </select>

                @if ($errors->has('sifra_korisnika'))

                    <span class="help-block">

                        <strong>{{ $errors->first('sifra_korisnika') }}</strong>

                    </span>

                @endif

            </div>

        </div>

        <br><br>

        <div class="row">

            <div class="col-md-9">

                {!! Form::submit('Ažuriraj kolegij', ['class' => 'btn btn-primary form-control'] ) !!}

            </div>

        </div>

        {!! Form::close() !!}


    </div>


@endsection