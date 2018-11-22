@extends('layouts.app')
@section('title', 'Ubicaciones')

@section('content')
    @include('flash::message')
    <a class="btn btn-info btn-sm" href="{{  route('ubicaciones.create') }}">Crear Ubicación</a>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-sm-1">#ID</th>
            <th class="col-md-3">Nombre</th>
            <th>Rango inicial</th>
            <th>Rango final</th>
            <th class="col-md-3">Descripción</th>
            <th class="col-md-2">Acción</th>
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
                    "url": "{{ asset('plugins/datatables/Spanish.json') }}"
                },
                ajax: {
                    url: '{{ url('admin/datatable/ubicaciones') }}',
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
                    {data: 'name'},
                    {data: 'ini_range'},
                    {data: 'end_range'},
                    {data: 'description'},
                    {
                        data: function (data) {

                            // funcion JS que trae los botones de acciones
                            return actionButtons(
                                data,
                                '{{ url('admin/ubicaciones') }}',
                                '{{ csrf_field() }}',
                                [ 'edit', 'delete' ]
                            );

                        },
                        orderable: false,
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