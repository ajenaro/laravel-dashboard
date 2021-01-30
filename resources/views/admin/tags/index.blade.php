@extends('admin.layouts.layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Etiquetas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Etiquetas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Listado de Etiquetas</h3>
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> Añadir Etiqueta</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

            @if ($tags->isNotEmpty())
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('name', 'Name')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            @include('admin.tags._row')
                        @endforeach
                        </tbody>
                    </table>

                    {{ $tags->appends(\Request::except('page'))->render() }}
                    <p>Viendo página {{ $tags->currentPage() }} de {{ $tags->lastPage() }} </p>

                </div>
            @else
                <p>No existe ninguna etiqueta.</p>
            @endif
        </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@push('styles')

@endpush

@push('scripts')
    <script>
        document.cookie="pageurl=" + encodeURIComponent(window.location['search']);
    </script>
@endpush
