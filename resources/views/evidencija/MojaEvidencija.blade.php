@extends('layouts.Osnovno')


@section('content')

    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <div class="container" style="margin-top: 70px;">

        <div class="row">

            <div class="col-md-4 col-md-offset-4" >

                @include('errors.session_error_poruke')
                @include('errors.session_poruke')


                @foreach($kolegiji as $kolegij)
                    <h1 class="text-center"><b><a href="{{ url('kolegij/'.$kolegij->sifra_kolegija.'/') }}">{{$kolegij->naziv}}</a></b></h1>
                    <table class="table table-striped table-bordered table-hover">

                        <thead>
                        <tr class="bg-info">
                            <th>Termin</th>
                            <th>Vrsta predavanja</th>
                            <th>Prisutan</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($termini as $termin)

                            @if($termin->sifra_kolegija==$kolegij->sifra_kolegija)

                                <?php
                                $originalDateCREATED = ''.$termin->datum.'';
                                $datumCREATED = Datetime::createFromFormat('Y-m-d',$originalDateCREATED);
                                $datum = $datumCREATED->format('d.m.Y');?>

                                <tr>
                                    <td>{{$datum}}</td>

                                @forelse ($evidencije as $evidencija)

                                        @if($evidencija->datum_evidentiranja==$termin->datum)

                                            @if($evidencija->vrsta_predavanja=='P')
                                                <td>Predavanje</td>
                                            @endif

                                            @if($evidencija->prisutnost==1)
                                                <td>DA</td>
                                            @else
                                                <td>NE</td>
                                            @endif


                                        @endif

                                @empty
                                        <td>Predavanje</td>
                                        <td>NE</td>
                                @endforelse

                                    </tr>

                            @endif

                        @endforeach

                        </tbody>

                    </table>
                @endforeach
            </div>

        </div>

    </div>

@endsection