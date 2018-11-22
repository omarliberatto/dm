@extends('layouts.front')
@section('title', 'Teléfonos')

@section('content')

    <table class="table table-striped dt-responsive hover">
        <thead>
        <tr>
            <th>#Número</th>
            <th>Asignado a</th>
            <th>Ubicación</th>
        </tr>
        </thead>
    </table>


@endsection

@push('scripts')
    @include('layouts.partials.datatables')
    <script>
        $(document).ready(function() {
            table = $('.table').DataTable({
                stateSave: true, //SOLO FUNCIONA DESACTIVANDO SERVERSIDE
                autoWidth: false,
                processing: true,
                serverSide: false,
                pageLenght: 10,
                limit: 10,
                searchDelay: 200,
                bLengthChange : false,
                mark: true,
                language: {
                    url: '{{ asset('plugins/datatables/SpanishFront.json') }}',
                    searchPlaceholder: "Buscar..."
                },
                ajax: {
                    url: '{{ url('datatable/telefonos') }}',
                    error: function(reason) {
                        if(reason.status==401){
                            window.location.replace('{{ url('login') }}');
                        }
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'alias'},
                    {
                        data: 'ubicacion',
                        name: 'ubicaciones.name'
                    }
                ],
                drawCallback: function( settings ) {

                    frontLoaded();

                },

            });

            /* Hightlights */
            $('.table tbody')
                .on( 'mouseenter', 'td', function () {
                    var colIdx = table.cell(this).index().row;
                    $( table.row( colIdx ).nodes() ).addClass( 'highlight' );
                });
            $('.table tbody')
                .on( 'mouseout', 'td', function () {
                    $( table.rows().nodes() ).removeClass( 'highlight' );
                });
        });
    </script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111452264-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-111452264-1');
    </script>

@endpush