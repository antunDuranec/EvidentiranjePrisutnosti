@extends('layouts.Osnovno')

@section('content')

    <div class="col-lg-6 col-lg-offset-3" style="margin-top: 50px;">

        {!! Form::model($razine_prava, ['method'=> 'PATCH', 'action' => ['RazinaPravaController@update', $razine_prava->sifra_razine]]) !!}


        <div class="row">

            <div class="col-md-10">

                <h1>Uređivanje "{{ $razine_prava->opis }}"</h1>

            </div>

        </div>

        <p class="lead">Uredi i spremi Razinu, ili <a href="{{ url('admin/razina-prava') }}">povratak na prikaz svih razina.</a></p>
        <hr>

        <div class="row">

            <div class="col-md-9">

                @include('errors.session_error_poruke')
                @include('errors.session_poruke')

            </div>

        </div>

        <div class="row">

            <div class="col-md-9 form-group {{ $errors->has('opis') ? 'has-error' : ''  }}">


                {!! Form::text('opis', null, ['class' => 'form-control','placeholder'=>'Opis razine']) !!}

                @if ($errors->has('opis'))

                    <span class="help-block">

                        <strong>{{ $errors->first('opis') }}</strong>

                    </span>

                @endif

            </div>

        </div>

        <div class="row">

            <div class="col-md-9">

                {!! Form::submit('Ažuriraj razinu', ['class' => 'btn btn-primary form-control'] ) !!}

            </div>

        </div>

        {!! Form::close() !!}


    </div>


@endsection