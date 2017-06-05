@extends('layouts.Osnovno')


@section('content')

    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <div class="row">

        <div class="col-md-2"></div>


        <div class="col-md-4 col-md-offset-2" style="margin-top: 50px;">

            @include('errors.session_error_poruke')
            @include('errors.session_poruke')


            @foreach($kolegiji as $kolegij)

                <h1 class="text-center"><b><a href="{{ url('admin/kolegij/'.$kolegij->sifra_kolegija.'/') }}">{{$kolegij->naziv}}</a></b></h1>

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="bg-info">
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Broj iskaznice</th>
                        <th>E-mail</th>
                        <th colspan="1">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($korisnici as $korisnik)

                        @foreach($studenti_na_kolegiju as $student)

                            @if($student->sifra_korisnika == $korisnik->sifra_korisnika && $student->sifra_kolegija==$kolegij->sifra_kolegija)



                                <tr>
                                    <td>{{ $korisnik->ime }}</td>
                                    <td>{{ $korisnik->prezime }}</td>
                                    <td>{{ $korisnik->broj_iskaznice }}</td>
                                    <td>{{ $korisnik->email }}</td>
                                    <td><a href="{{url('korisnik',$korisnik->sifra_korisnika)}}" class="btn btn-primary">Prikaz</a></td>

                                </tr>

                            @endif

                        @endforeach

                    @endforeach

                    </tbody>

                </table>

            @endforeach

        </div>

    </div>

@endsection