@extends('admin.layouts.layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Show Users</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> New User</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @include('admin.users._row')
                @endforeach
                </tbody>
            </table>
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
            $('#users-table').DataTable({
                "language": {
                    //"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    "url": "http://cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                },
                "paging": true,
                "lengthChange": false,
                "searching": true,
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
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
