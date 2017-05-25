@extends('layouts.Osnovno')

@section('content')

<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<div class="row" >

    <div class="col-md-2"></div>

    <div  class="col-md-4 col-md-offset-2" style="margin-top: 50px;">

        @include('errors.session_error_poruke')
        @include('errors.session_poruke')

        <h3 class="text-center">{{ $razine_prava->opis }}</h3>

        <div class="row">

            <div class="col-md-4">

                <a href="{{ url('admin/razina-prava') }}" class="btn btn-info"><i class="fa fa-eye"></i>Prikaz svih razina</a>

            </div>

            <div class="col-md-4">

                <a href="{{ url('admin/razina-prava/'.$razine_prava->sifra_razine.'/edit/') }}" class="btn btn-primary"><i class="fa fa-edit"></i>Uređivanje razine</a>

            </div>

            <!-- Modal Dialog -->
        @include('layouts.delete_confirm')
        <!-- END Modal Dialog -->

            <div class="col-md-4" style="margin-left: -2px">

              {!!  Form::open(['method' => 'DELETE','action' => ['RazinaPravaController@destroy', $razine_prava->sifra_razine]]) !!}

              {{ Form::button('Obrišite razinu', ['type' => 'button', 'class' => 'btn btn-danger btn-delete',' data-toggle'=>'modal','data-target'=>'#confirmDelete','data-title'=>'Brisanje razine','data-message'=>'Da li ste sigurni da želite obrisati razinu: '.$razine_prava->opis.''] )  }}

              {!! Form::close() !!}
            </div>

            <!-- Script -->
            <script type="text/javascript">

                $('#confirmDelete').on('show.bs.modal', function (e) {

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
                $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){

                    $(this).data('form').submit();

                });

            </script>
            <!-- End script -->
        </div>

        <hr>


        <div class="row">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-info">
                    <th>#</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>E-mail</th>
                    <th colspan="3">Akcije</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; ?>
                <?php $brojac=0; ?>

                @foreach($users as $korisnik)

                    <?php $i++; ?>

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
                        <td>{{ $i }}</td>
                        <td>{{ $korisnik->ime }}</td>
                        <td>{{ $korisnik->prezime }}</td>
                        <td>{{ $korisnik->email }}</td>
                        <td><a href="{{url('korisnik',$korisnik->sifra_korisnika)}}" class="btn btn-primary">Prikaz</a></td>
                        <td><a href="{{route('korisnik.edit',$korisnik->sifra_korisnika)}}" class="btn btn-warning">Uređivanje</a></td>
                        <td>
                            <!-- Form::open(['method' => 'DELETE','action' => ['UsersController@destroy', $korisnik->sifra_korisnika]]) !!}

                            <!-- Form::button('Obriši', ['type' => 'button', 'class' => 'btn btn-danger ',' data-toggle'=>'modal','data-target'=>'#confirmDelete'.$brojac.'','data-title'=>'Brisanje korisnika','data-message'=>'Da li ste sigurni da želite obrisati korisnika: '.$korisnik->ime.' '.$korisnik->prezime.' '] )  }}

                            <!-- Form::close() !!}-->
                        </td>
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

                @endforeach
                </tbody>

            </table>


        </div>

    </div>

</div>

@endsection