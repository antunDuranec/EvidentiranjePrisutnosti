@extends('layouts.Osnovno')


@section('content')

    <div class="container padding-t-50" >

        <div class="row">

            <div class="col-md-3"></div>

            <div class="col-md-6 padding-t-50">
                <div class="row  text-center" style="font-size: 28px;">
                    Ažuriranje profila
                </div>

                <div class="row padding-t-50">
                    {!! Form::model($user, ['method'=> 'PATCH', 'action' => ['UsersController@update', $user->sifra_korisnika]]) !!}

                    {!! csrf_field() !!}


                    <div class="row ">

                        @include('errors.session_error_poruke')
                        @include('errors.session_poruke')
                    </div>

                    <!--IME-->
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('ime') ? ' has-error' : '' }}">

                            {!! Form::text('ime', null, ['class' => 'col-md-4 form-control','placeholder' =>'Ime']) !!}

                            @if ($errors->has('ime'))

                                <span class="help-block">

                                        <strong>{{ $errors->first('ime') }}</strong>

                                    </span>

                            @endif

                        </div>

                    </div>

                    <!--PREZIME-->
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('prezime') ? ' has-error' : '' }}">

                            {!! Form::text('prezime', null, ['class' => 'col-md-4 form-control','placeholder' =>'Prezime']) !!}

                            @if ($errors->has('prezime'))

                                <span class="help-block">

                                        <strong>{{ $errors->first('prezime') }}</strong>

                                    </span>

                            @endif

                        </div>

                    </div>

                    <!--BROJ X-ICE-->
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('broj_iskaznice') ? ' has-error' : '' }}">

                            {!! Form::number('broj_iskaznice', null, ['class' => 'col-md-4 form-control ','placeholder' =>'Broj X-ice']) !!}

                            @if ($errors->has('broj_iskaznice'))

                                <span class="help-block">

                                        <strong>{{ $errors->first('broj_iskaznice') }}</strong>

                                    </span>

                            @endif

                        </div>

                    </div>

                    <!--E-MAIL-->
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            {!! Form::email('email', null, ['class' => 'col-md-4 form-control','placeholder' =>'E-mail']) !!}

                            @if ($errors->has('email'))

                                <span class="help-block">

                                    <strong>{{ $errors->first('email') }}</strong>

                                </span>

                            @endif

                        </div>

                    </div>

                    <!--RAZINA PRAVA-->
                    @if(Auth::user()->razina_prava==1)
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('razina_prava') ? ' has-error' : '' }}">

                            {{ Form::select('razina_prava', ['1' => 'Administrator','2' => 'Profesor','3' => 'Student'], $user->razina_prava, ['class' => 'col-md-4 form-control']) }}


                            @if ($errors->has('razina_prava'))

                                <span class="help-block">

                                        <strong>{{ $errors->first('razina_prava') }}</strong>

                                    </span>

                            @endif

                        </div>

                    </div>
                    @endif


                    <div class="row padding-t-15">

                        <div class="col-md-10 col-md-offset-1">

                            {!! Form::submit('Ažuriraj profil korisnika', ['class' => 'btn-azuriraj-profil'] ) !!}

                        </div>

                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <div class="col-md-3"></div>

        </div>

    </div>

@endsection
