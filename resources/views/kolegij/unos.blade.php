@extends('layouts.Osnovno')

@section('content')

<div class="col-lg-6 col-lg-offset-3" style="margin-top: 50px;">

   {!!  Form::open(['action' => 'KolegijController@store']) !!}

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9">

            @include('errors.session_error_poruke')
            @include('errors.session_poruke')

            <h2 class="text-center">Dobrodošli u sučelje za unos kolegija</h2>

        </div>

    </div>


    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('naziv') ? 'has-error' : ''  }}">



            {!! Form::text('naziv', null, ['class' => 'form-control','placeholder'=>'Naziv kolegija']) !!}

            @if ($errors->has('naziv'))

                <span class="help-block">

                        <strong>{{ $errors->first('naziv') }}</strong>

                    </span>

            @endif

        </div>

    </div>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('sifra_korisnika') ? 'has-error' : ''  }}">



            <select class="form-control" name="sifra_korisnika" id="sifra_korisnika">

                @foreach($profesori as $profesor)

                    <option value="{{$profesor->sifra_korisnika}}" selected="0">{{$profesor->ime}} {{$profesor->prezime}}</option>

                @endforeach

                <option value="0" selected="selected">--Odaberite nositelja kolegija--</option>

            </select>

            @if ($errors->has('sifra_korisnika'))

                <span class="help-block">

                        <strong>{{ $errors->first('sifra_korisnika') }}</strong>

                    </span>

            @endif

        </div>

    </div>

    <br><br>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9">

            {!! Form::submit('Unesi kolegij', ['class' => 'btn btn-primary form-control'] ) !!}

        </div>

    </div>

    {!! Form::close() !!}

</div>

@endsection