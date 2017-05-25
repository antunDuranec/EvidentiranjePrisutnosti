@extends('layouts.Osnovno')


@section('content')
    <div class="container" style="padding-top: 5%">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="panel panel-default panel-login-register">

                    <div class="panel-heading text-center">Registracija</div>

                    <div class="panel-body">

                        <form role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

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

                                <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('kartica') ? ' has-error' : '' }}">

                                    {!! Form::number('kartica', null, ['class' => 'col-md-4 form-control ','placeholder' =>'Broj X-ice']) !!}

                                    @if ($errors->has('kartica'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('kartica') }}</strong>

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

                            <!--LOZINKA-->
                            <div class="row">

                                <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                    {!! Form::password('password', ['class' => 'col-md-4 form-control','placeholder' =>'Lozinka']) !!}

                                    @if ($errors->has('password'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <!--PONOVI LOZINKU-->
                            <div class="row">

                                <div class="col-md-10 col-md-offset-1 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                    {!! Form::password('password_confirmation',['class' => 'col-md-4 form-control','placeholder' =>'Ponovite lozinku']) !!}

                                    @if ($errors->has('password_confirmation'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('password_confirmation') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-10 col-md-offset-1" style="margin-left: 30%">

                                    <button type="submit" value="Submit" class="btn btn-primary">

                                        <i class="fa fa-btn fa-user"></i>Registriraj se

                                    </button>

                                </div>


                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
