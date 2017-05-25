@extends('layouts.Osnovno')

@section('content')

    <div class="col-lg-6 col-lg-offset-3" style="margin-top: 50px;">

        {!! Form::model($student, ['method'=> 'PATCH', 'action' => ['StudentNaKolegijuController@update', $student->sifra_studenta_kolegiju]]) !!}


        <div class="row">

            <div class="col-md-10">

                <h1>Uređivanje studenta "{{ $nazivStudenta->ime }} {{ $nazivStudenta->prezime }}" i kolegija "{{$nazivKolegija->naziv}}"</h1>

            </div>

        </div>

        <p class="lead">Uredi i spremi Studenta i kolegij, ili <a href="{{ url('admin/student-kolegij') }}">povratak na prikaz svih studenata na kolegija.</a></p>
        <hr>

        <div class="row">

            <div class="col-md-9">

                @include('errors.session_error_poruke')
                @include('errors.session_poruke')

            </div>

        </div>

        <div class="row">

            <div class="col-md-9 form-group {{ $errors->has('sifra_korisnika') ? 'has-error' : ''  }}">


                <select class="form-control" name="sifra_korisnika" id="sifra_korisnika">

                    <option value="0">--Odaberite studenta--</option>
                    <option value="{{$nazivStudenta->sifra_korisnika}}" selected="selected">{{ $nazivStudenta->ime }} {{ $nazivStudenta->prezime }}</option>

                </select>

                @if ($errors->has('sifra_korisnika'))

                    <span class="help-block">

                        <strong>{{ $errors->first('sifra_korisnika') }}</strong>

                    </span>

                @endif

            </div>

        </div>

        <div class="row">

            <div class="col-md-9 form-group {{ $errors->has('sifra_korisnika') ? 'has-error' : ''  }}">



                <select class="form-control" name="sifra_kolegija" id="sifra_kolegija">

                    @foreach($kolegiji as $kolegij)

                        <option value="{{$kolegij->sifra_kolegija}}">{{$kolegij->naziv}}</option>

                    @endforeach

                        <option value="0">--Odaberite nositelja kolegija--</option>
                        <option value="{{$kolegij->sifra_kolegija}}" selected="selected">{{ $nazivKolegija->naziv }}</option>

                </select>

                @if ($errors->has('sifra_kolegija'))

                    <span class="help-block">

                        <strong>{{ $errors->first('sifra_kolegija') }}</strong>

                    </span>

                @endif

            </div>

        </div>

        <br><br>

        <div class="row">

            <div class="col-md-9">

                {!! Form::submit('Ažuriraj studenta i kolegij', ['class' => 'btn btn-primary form-control'] ) !!}

            </div>

        </div>

        {!! Form::close() !!}


    </div>


@endsection