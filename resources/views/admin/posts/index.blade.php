@extends('admin.layouts.layout')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Todos los Posts</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Todos los Posts</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary float-lg-right"><i class="fa fa-plus"></i> Nuevo Post</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @if ($posts->isNotEmpty())
                <div class="table-responsive-lg">
                    <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@sortablelink('published_at', 'Published At')</th>
                    <th>@sortablelink('title', 'Title')</th>
                    <th>@sortablelink('excerpt', 'Excerpt')</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    @include('admin.posts._row')
                @endforeach
                </tbody>

            </table>

                    {{ $posts->appends(\Request::except('page'))->render() }}
                    <p>Viendo página {{ $posts->currentPage() }} de {{ $posts->lastPage() }} </p>
                </div>
            @else
                <p>No hay posts todavía.</p>
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
