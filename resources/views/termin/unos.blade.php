@extends('layouts.Osnovno')

@section('content')

<div class="col-lg-6 col-lg-offset-3" style="margin-top: 50px;">

   {!!  Form::open(['action' => 'TerminController@store']) !!}

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9">

            @include('errors.session_error_poruke')
            @include('errors.session_poruke')

            <h2 class="text-center">Dobrodošli u sučelje za unos termina</h2>

        </div>

    </div>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('sifra_kolegija') ? 'has-error' : ''  }}">



            <select class="form-control" name="sifra_kolegija" id="sifra_kolegija">


                @foreach($kolegiji as $kolegij)

                    <option value="{{$kolegij->sifra_kolegija}}" selected="0">{{$kolegij->naziv}}</option>

                @endforeach


                <option value="0" selected="selected">--Odaberite kolegij--</option>

            </select>

            @if ($errors->has('sifra_kolegija'))

                <span class="help-block">

                        <strong>{{ $errors->first('sifra_kolegija') }}</strong>

                    </span>

            @endif

        </div>

    </div>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('datum') ? 'has-error' : ''  }}">



            {!! Form::date('datum', date('Y-m-d'), ['class' => 'form-control']) !!}

            @if ($errors->has('datum'))

                <span class="help-block">

                        <strong>{{ $errors->first('datum') }}</strong>

                 </span>

            @endif

        </div>

    </div>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('vrijeme_pocetka') ? 'has-error' : ''  }}">


          <div class="row">

              <div class="col-md-4">
                  {{ Form::label('vrijeme_pocetka', 'Vrijeme početka') }}
              </div>

              <div class="col-md-8">
                  {!! Form::time('vrijeme_pocetka') !!}
              </div>

          </div>

            @if ($errors->has('vrijeme_pocetka'))

                <span class="help-block">

                        <strong>{{ $errors->first('vrijeme_pocetka') }}</strong>

                 </span>

            @endif

        </div>

    </div>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('vrijeme_kraja') ? 'has-error' : ''  }}">

            <div class="row">

                <div class="col-md-4">
                    {{ Form::label('vrijeme_kraja', 'Vrijeme kraja') }}
                </div>

                <div class="col-md-8">
                    {!! Form::time('vrijeme_kraja') !!}
                </div>

            </div>

            @if ($errors->has('vrijeme_kraja'))

                <span class="help-block">

                        <strong>{{ $errors->first('vrijeme_kraja') }}</strong>

                 </span>

            @endif

        </div>

    </div>

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9">

            {!! Form::submit('Unesi termin', ['class' => 'btn btn-primary form-control'] ) !!}

        </div>

    </div>

    {!! Form::close() !!}

</div>

@endsection