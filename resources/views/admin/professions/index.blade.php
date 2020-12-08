@extends('admin.layouts.layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profesiones</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Profesiones</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Profesiones</h3>
            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> Añadir Profesión</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @if ($professions->isNotEmpty())
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('name', 'Name')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($professions as $profession)
                            @include('admin.professions._row')
                        @endforeach
                        </tbody>
                    </table>

                    {{ $professions->appends(\Request::except('page'))->render() }}
                    <p>Viendo página {{ $professions->currentPage() }} de {{ $professions->lastPage() }} </p>

                </div>
            @else
                <p>No existe ninguna profesión.</p>
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
