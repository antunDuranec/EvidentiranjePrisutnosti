@extends('layouts.Osnovno')


@section('content')

<!--<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
-->

    <div class="container" style="margin-top: 70px;">

        <div class="row">

                <div class="col-md-6 col-md-offset-3" >

                    @include('errors.session_error_poruke')
                    @include('errors.session_poruke')
                    <?php $i=0; ?>
                    <h3 class="text-center">Prijava prisutnosti na nastavi</h3>

                    <table class="table table-striped table-bordered table-hover ">
                        <thead>
                        <tr class="bg-info">
                            <th>#</th>
                            <th>Naziv kolegija</th>
                            <th colspan="1">Akcija</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($studenti as $student)
                                <?php $i++;?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $student->naziv }}</td>
                                    <td>
                                        {!! Form::open(['method' => 'POST','action' => ['EvidencijaController@store', $student->sifra_studenta_na_kolegiju]]) !!}

                                        {{ Form::submit( 'Prijavi prisutnost', [ 'class' => 'btn btn-success','name'=>'sifra_studenta_na_kolegiju','placeholder'=>'Naziv kolegija'] )  }}

                                        {{ Form::hidden('student', $student->sifra_studenta_na_kolegiju) }}

                                        {{ Form::hidden('sifra_termina', $student->sifra_termina) }}


                                        {!! Form::close() !!}

                                    </td>
                                </tr>

                            @endforeach
                        </tbody>

                    </table>

                </div>

        </div>

    </div>

@endsection