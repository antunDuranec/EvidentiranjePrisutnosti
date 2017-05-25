@extends('layouts.Osnovno')


@section('content')

    <div class="container-fluid" >

        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <div class="panel panel-default panel-login-register" style="margin-top: 10vh">

                    <div class="panel-heading text-center">Izmjena lozinke</div>

                    <div class="panel-body">

                        {!! Form::model($user, ['method'=> 'POST', 'action' => ['UsersController@update_password', $user->sifra_korisnika]]) !!}

                        {!! csrf_field() !!}

                        <div class="row">

                            @include('errors.session_poruke')
                            @include('errors.session_error_poruke')

                            <div class="col-md-10 col-md-offset-1">

                                {!! Form::label('old_password', 'Stara lozinka',['class' => 'control-label boja-slova']) !!}

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">

                                {!! Form::password('old_password', ['class' => 'col-md-4 form-control']) !!}

                                @if ($errors->has('old_password'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('old_password') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                {!! Form::label('password', 'Nova lozinka',['class' => 'control-label boja-slova']) !!}

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                {!! Form::password('password', ['class' => 'col-md-4 form-control']) !!}

                                @if ($errors->has('password'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                {!! Form::label('password_confirmation', 'Ponovite lozinku',['class' => 'control-label boja-slova']) !!}

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                {!! Form::password('password_confirmation',['class' => 'col-md-4 form-control']) !!}

                                @if ($errors->has('password_confirmation'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password_confirmation') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                {!! Form::submit('Izmjeni lozinku', ['class' => 'btn btn-primary fa fa-btn fa-user form-control'] ) !!}

                            </div>

                        </div>

                        {!! Form::close() !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
