@extends('admin.layouts.layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Habilidades</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Habilidades</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Habilidades</h3>
            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> Añadir Habilidad</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @if ($skills->isNotEmpty())
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('name', 'Name')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skills as $skill)
                            @include('admin.skills._row')
                        @endforeach
                        </tbody>
                    </table>

                    {{ $skills->appends(\Request::except('page'))->render() }}
                    <p>Viendo página {{ $skills->currentPage() }} de {{ $skills->lastPage() }} </p>

                </div>
            @else
                <p>No existe ninguna habilidad.</p>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@push('scripts')
    <!-- DataTables -->
        <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script>
            // allow sorting by date in DD/MM/YYYY format
            jQuery.extend( jQuery.fn.dataTableExt.oSort, {
                "date-es-pre": function ( a ) {
                    let esDatea = a.split('/');
                    return (esDatea[2] + esDatea[1] + esDatea[0]) * 1;
                },

                "date-es-asc": function ( a, b ) {
                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },

                "date-es-desc": function ( a, b ) {
                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
            } );
            $(function () {
                $('#skills-table').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    },
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        {
                            "targets": 0,
                            "type": 'date-es',
                        },
                        {
                            "targets": -1,
                            "searchable": false,
                            "orderable": false,
                        }
                    ],
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
@endpush

@push('scripts')
    <script>
        document.cookie="pageurl=" + encodeURIComponent(window.location['search']);
    </script>
@endpush
