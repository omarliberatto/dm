@extends('layouts.app')
@section('title', 'Tipo de Teléfonos')
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')
    @include('flash::message')
    <a class="btn btn-info btn-sm" href="{{  route('telefonostipos.create') }}">Crear Tipo de Teléfonos</a>
    <div class="pull-right">{{ $telefonostipos->firstItem() }} a {{ $telefonostipos->lastItem() }} de {{ $telefonostipos->total() }}</div>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-sm-1">#ID</th>
            <th class="col-md-9">Nombre</th>
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
                    url: '{{ url('admin/datatable/telefonostipos') }}',
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
                    {
                        data: function (data) {
                            // funcion JS que trae los botones de acciones
                            return actionButtons(
                                data,
                                '{{ url('admin/telefonostipos') }}',
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