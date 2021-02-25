<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="{{ asset('css/front/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/front/app.js') }}"></script>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <select class="changeLang">
            @foreach(config('app.languages') as $key => $value)
                <option value="{{ $key }}" {{ session()->get('locale') == $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        <a href="{{ url('/') }}">{{ __('messages.home_page_title') }}</a>
        <a href="{{ url('/news') }}">{{ __('messages.page_news_title') }}</a>
        @if (Route::has('login'))

            @auth
                <a href="{{ url('/admin') }}">Admin</a>
            @else
                <a href="{{ route('login') }}">{{ __('messages.register_page_login') }}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('messages.register_page_title') }}</a>
                @endif
            @endauth

        @endif
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });

</script>
</html>
