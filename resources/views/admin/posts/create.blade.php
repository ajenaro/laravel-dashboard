@extends('admin.layouts.layout')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Crear Post</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Images</h5>
                <div class="card-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-body">

                        @include('admin.posts._fields_left')

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">
                    <div class="card-body">

                        @include('admin.posts._fields_right', ['btnText' => 'Crear Post'])

                    </div>
                </div>

            </div>

        </div>
    </form>



@endsection

@push('styles')
    <!-- date picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- CkEditor -->
    <script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('scripts')
    <!-- date-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw==" crossorigin="anonymous"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <script>
        //Date range picker
        $('#published_at').datepicker({
            zIndexOffset: 10000,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
            language: 'es',
            autoclose: true
        })

        CKEDITOR.replace( 'body', {
            language: 'es',
            height: 500,
            codeSnippet_theme: 'monokai_sublime',
        });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            tags: false
        })
    </script>

@endpush
