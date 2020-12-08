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
            <h3 class="card-title">Listado de Usuarios</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> Añadir Usuario</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @include('admin.users._filters')

            @if ($users->isNotEmpty())
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('created_at', 'Created At')</th>
                            <th>@sortablelink('team.name', 'Team')</th>
                            <th>@sortablelink('name', 'Name')</th>
                            <th>@sortablelink('email', 'Email')</th>
                            <th>Profession</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @include('admin.users._row')
                        @endforeach
                        </tbody>
                    </table>

                    {{ $users->appends(\Request::except('page'))->render() }}
                    <p>Viendo página {{ $users->currentPage() }} de {{ $users->lastPage() }} </p>
                </div>
            @else
                <p>No hay usuarios registrados.</p>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@push('styles')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endpush

@push('scripts')
    <script>
        document.cookie="pageurl=" + encodeURIComponent(window.location['search']);
    </script>
    <script>
        $(function () {
            $('.status_check').on('click', function () {

                let active = $(this).is(':checked');
                console.log(active);
            });
        });
    </script>
@endpush
