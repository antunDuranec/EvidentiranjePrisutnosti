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
