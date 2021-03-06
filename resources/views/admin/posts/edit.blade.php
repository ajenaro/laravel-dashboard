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

    @if($post->photos->count())
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Imágenes</h5>
                    <div class="card-body">
                        <div class="row">
                            @foreach($post->photos->load('post') as $photo)
                                <div class="col-md-2">
                                    <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-xs"
                                                onclick="return confirm('¿Estás seguro/a?')"
                                                style="position: absolute; margin: 5px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <img class="img-fluid" src="{{ url('/storage/' . $photo->url) }}">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input photo_featured"
                                                   id="featured_photo_{{ $photo->id }}"
                                                   data-post="{{ $photo->post->id }}"
                                                   data-value="{{ $photo->id }}"
                                                    {{ $photo->featured ? 'checked' : '' }}>
                                            <label for="featured_photo_{{ $photo->id }}" class="custom-control-label">Imagen destacada</label>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @method("PUT")
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

                        @include('admin.posts._fields_right', ['btnText' => 'Actualizar Post'])

                    </div>
                </div>

            </div>

        </div>
    </form>



@endsection

@push('styles')
    <!-- date picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css">
@endpush

@push('scripts')
    <!-- date-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw==" crossorigin="anonymous"></script>
    <!-- CkEditor -->
    <script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>

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

        let myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/photos',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las imágenes aquí para subirlas',
            paramName: 'photo',
            acceptedFiles: 'image/*',
            maxFilesize: 2
        });

        myDropzone.on('error', function(file, res) {
            let msg = res.errors.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        Dropzone.autoDiscover = false;

        $('.photo_featured').on('click', function(e){
            e.preventDefault();
            let url = "{{ route('admin.photos.update', [':photo_id']) }}";
            url = url.replace(':photo_id',  $(this).data('value'));
            $.ajax({
                type: 'PUT',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'post_id': $(this).data('post'),
                    'checked': $(this).is(':checked') ? 1 : 0
                },
                success: function(data) {
                    if(data.res) {
                        $( '.photo_featured' ).each(function() {
                            $( this ).prop('checked', false);
                        });
                        if(parseInt(data.checked_from_server) === 1) {
                            $('#featured_photo_' + data.photo_id).prop('checked', true);
                        }
                    }
                },
            });
        });
    </script>

@endpush
