@extends('layouts.Osnovno')

@section('content')

<div class="col-lg-6 col-lg-offset-3" style="margin-top: 50px;">

    {!!  Form::open(['action' => 'RazinaPravaController@store']) !!}

    <div class="row" style="margin-left: 4%">

        <div class="col-md-9">

            @include('errors.session_error_poruke')
            @include('errors.session_poruke')

            <h2 class="text-center">Dobrodošli u sučelje za unos razine prava</h2>

        </div>

    </div>


    <div class="row" style="margin-left: 4%">

        <div class="col-md-9 form-group {{ $errors->has('opis') ? 'has-error' : ''  }}">



            {!! Form::text('opis', null, ['class' => 'form-control','placeholder'=>'Opis razine']) !!}

            @if ($errors->has('opis'))

                <span class="help-block">

                        <strong>{{ $errors->first('opis') }}</strong>

                    </span>

            @endif

        </div>

    </div>


    <div class="row" style="margin-left: 4%">

        <div class="col-md-9">

            {!! Form::submit('Unesi razinu prava', ['class' => 'btn btn-primary form-control'] ) !!}

        </div>

    </div>

    {!! Form::close() !!}

</div>
@endsection