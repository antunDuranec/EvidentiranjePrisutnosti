@extends('layouts.Osnovno')


@section('content')

<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <div class="row">

        <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">

            @include('errors.session_error_poruke')
            @include('errors.session_poruke')
            <?php $brojac=0;$i=0; ?>
            <div class="row">

            <h3 class="text-center">Pregled kolegija</h3>

            <table class="table table-striped table-bordered table-hover ">
                <thead>
                <tr class="bg-info">
                    <th>#</th>
                    <th>Naziv</th>
                    <th colspan="3">Akcije</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($kolegiji as $kolegij)
                        <?php $i++;?>

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
                            <td>{{ $kolegij->naziv }}</td>
                            <td><a href="{{url('kolegij',$kolegij->sifra_kolegija)}}" class="btn btn-primary">Prikaz</a></td>
                            <td><a href="{{route('kolegij.edit',$kolegij->sifra_kolegija)}}" class="btn btn-warning">Uređivanje</a></td>
                            <td>

                                {!! Form::open(['method' => 'DELETE','action' => ['KolegijController@destroy', $kolegij->sifra_kolegija]]) !!}

                                {{ Form::button('Obrišite', ['type' => 'button', 'class' => 'btn btn-danger btn-delete',' data-toggle'=>'modal','data-target'=>'#confirmDelete'.$brojac.'','data-title'=>'Brisanje kolegija','data-message'=>'Da li ste sigurni da želite obrisati kolegij: '.$kolegij->naziv.''] )  }}

                                {!! Form::close() !!}

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