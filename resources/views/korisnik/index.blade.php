@extends('layouts.Osnovno')


@section('content')

<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <div class="row">

        <div class="col-md-2"></div>


        <div class="col-md-4 col-md-offset-2" style="margin-top: 50px;">

            @include('errors.session_error_poruke')
            @include('errors.session_poruke')
            <?php $brojac=0; ?>

            @foreach($razine as $razina)

                <h1 class="text-center"><b><a href="{{ url('admin/razina-prava/'.$razina->sifra_razine.'/') }}">{{$razina->opis}}</a></b></h1>

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Broj iskaznice</th>
                            <th>E-mail</th>
                            <th colspan="2">Akcije</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($korisnici as $korisnik)

                             @if($korisnik->razina_prava == $razina->sifra_razine)

                                 <!-- Modal Dialog -->
                                 <div class="modal fade" id="confirmDelete{{$brojac}}" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">

                                     <div class="modal-dialog">

                                         <div class="modal-content">

                                             <div class="modal-header">

                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                                 <h4 class="modal-title"></h4>

                                             </div>

                                             <div class="modal-body">

                                                 <p></p>

                                             </div>

                                             <div class="modal-footer">

                                                 <button type="button" class="btn btn-default" data-dismiss="modal">Natrag</button>
                                                 <button type="button" class="btn btn-danger" id="confirm">Obriši</button>


                                             </div>

                                         </div>

                                     </div>
                                 </div>
                                 <!-- END Modal Dialog -->

                                <tr>
                                    <td>{{ $korisnik->ime }}</td>
                                    <td>{{ $korisnik->prezime }}</td>
                                    <td>{{ $korisnik->broj_iskaznice }}</td>
                                    <td>{{ $korisnik->email }}</td>
                                    <td><a href="{{url('korisnik',$korisnik->sifra_korisnika)}}" class="btn btn-primary">Prikaz</a></td>
                                    <td><a href="{{route('korisnik.edit',$korisnik->sifra_korisnika)}}" class="btn btn-warning">Uređivanje</a></td>

                                </tr>

                                 <!-- Script -->
                                 <script type="text/javascript">

                                     $('#confirmDelete{{$brojac}}').on('show.bs.modal', function (e) {

                                         e.preventDefault();

                                         $message = $(e.relatedTarget).attr('data-message');

                                         $(this).find('.modal-body p').text($message);

                                         $title = $(e.relatedTarget).attr('data-title');

                                         $(this).find('.modal-title').text($title);

                                         // Pass form reference to modal for submission on yes/ok

                                         var form = $(e.relatedTarget).closest('form');

                                         $(this).find('.modal-footer #confirm').data('form', form);

                                     });

                                     <!-- Form confirm (yes/ok) handler, submits form -->
                                     $('#confirmDelete{{$brojac}}').find('.modal-footer #confirm').on('click', function(){

                                         $(this).data('form').submit();

                                     });

                                 </script>
                                 <!-- End script -->
                                 <?php $brojac++; ?>
                             @endif
                            @endforeach

                            </tbody>

                        </table>

                @endforeach

        </div>

    </div>

@endsection