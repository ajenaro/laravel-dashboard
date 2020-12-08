@extends('admin.layouts.layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Equipos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Equipos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Equipos</h3>
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> Añadir Equipo</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @if ($teams->isNotEmpty())
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('name', 'Name')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            @include('admin.teams._row')
                        @endforeach
                        </tbody>
                    </table>

                    {{ $teams->appends(\Request::except('page'))->render() }}
                    <p>Viendo página {{ $teams->currentPage() }} de {{ $teams->lastPage() }} </p>

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

@endpush

@push('scripts')
    <script>
        document.cookie="pageurl=" + encodeURIComponent(window.location['search']);
    </script>
@endpush
