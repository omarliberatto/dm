@extends('layouts.app')
@section('title', 'Teléfonos')

@section('content')
    @include('flash::message')

    <!-- Boton Importar -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importar">
        Importar Internos (CSV)
    </button>

    <!-- Modal importar -->
    <div class="modal fade" id="importar" tabindex="-1" role="dialog" aria-labelledby="importarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!!Form::open([
                    'route'=>'telefonos.importar',
                    'method'=>'POST',
                    'files'=>true,
                    'class'=>'form-horizontal'
                ])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="importarLabel">Importar CSV</h4>
                </div>
                <div class="well well-sm">Esto actualizará todos los datos del área o sector</div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('archivo', 'Archivo CSV', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::file('archivo') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    {!! Form::submit('Enviar',['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- End Modal importar -->

    <hr>

    <!-- Tabla de datos -->

    <table class="table table-striped dt-responsive">
        <thead>
            <tr>
                <th>#Número</th>
                <th>Asignado a</th>
                <th>Tipo</th>
                <th>Persona</th>
                <th>Lugar</th>
                <th>Ubicación</th>
                <th>Visible / Editar</th>
            </tr>
        </thead>
    </table>



@endsection

@push('scripts')
    @include('layouts.partials.datatables')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                //stateSave: true, //SOLO FUNCIONA DESACTIVANDO SERVERSIDE
                autoWidth: false,
                processing: true,
                serverSide: true,
                pageLenght: 10,
                limit: 10,
                deferRender: true,
                language: {
                    url: '{{ asset('plugins/datatables/Spanish.json') }}'
                },
                ajax: {
                    url: '{{ url('admin/datatable/telefonos') }}',
                    error: function(reason) {
                        if(reason.status==401){
                            window.location.replace('{{ url('login') }}');
                        }else{
                            alert(reason.responseText);
                        }
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'alias'},
                    {
                        data: 'tipo',
                        name: 'telefonostipos.name'
                    },
                    {
                        data: 'fullname',
                        name: 'personas.full_name'
                    },
                    {
                        data: 'lugar',
                        name: 'lugares.name'
                    },
                    {
                        data: 'ubicacion',
                        name: 'ubicaciones.name'
                    },
                    {
                        data: function (data) {

                            return telefonosButtons(
                                data,
                                '{{ url('admin/telefonos') }}',
                                '{{ csrf_field() }}'
                            );

                        },
                        name: 'telefonoscache.visible',
                        searchable: false
                    }
                ],
                drawCallback: function( settings ) {

                    $('[data-toggle="tooltip"]').tooltip();


                },

            });
        });
    </script>
@endpush
