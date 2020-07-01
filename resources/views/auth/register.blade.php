@extends('auth.layouts.layout')

@section('content')
    <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group mb-3">
                <input id="name" type="text" class="form-control
                        @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}"
                        autocomplete="name"
                        autofocus
                        placeholder="Full name">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control
                        @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="Email">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control
                        @error('password') is-invalid @enderror"
                        name="password"
                        autocomplete="new-password"
                       placeholder="Password">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password-confirm" type="password"
                       class="form-control"
                       name="password_confirmation"
                       autocomplete="new-password"
                       placeholder="Retype password">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                            I agree to the <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac vehicula mi. Aliquam eu bibendum nibh. Morbi eleifend euismod arcu ac eleifend. Quisque sit amet sollicitudin mauris, quis mattis sem. In tempus scelerisque varius. Cras nec tempus justo. Donec sed nisi aliquet, ullamcorper dui eu, dignissim felis. Vivamus pellentesque mattis nisi vitae finibus. Mauris ac lorem ut enim efficitur eleifend sit amet at arcu. Morbi tincidunt mollis purus, sit amet porttitor ligula finibus a. Vivamus volutpat urna at blandit venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam non risus eu nulla tempor tincidunt eget sed risus. Nunc luctus interdum quam pellentesque eleifend. Pellentesque ipsum ante, porttitor id tempor vel, varius ut sem. Nam at auctor est, non fringilla nisl.
                    </p>

                    <p>
                        Praesent cursus lorem a dolor mollis, sit amet convallis odio placerat. Pellentesque id malesuada orci, vitae tristique orci. Nullam sollicitudin purus vel ligula finibus, a varius turpis tristique. Vivamus pretium luctus neque sit amet commodo. Praesent tempor efficitur diam eu varius. Aenean ullamcorper accumsan porttitor. Nam laoreet magna ut pretium elementum. Integer lacinia nec lorem sed facilisis. Mauris eget semper ex. Fusce iaculis congue velit eget cursus. Sed convallis massa ante, vel cursus odio pharetra ac. Donec congue rutrum ipsum ac placerat. Vivamus dapibus elit vitae fermentum ultrices.
                    </p>

                    <p>
                        Nulla at blandit nisi, ac dignissim erat. Sed feugiat nisl sed maximus convallis. Sed ornare lectus sed mattis ultrices. Donec aliquam felis arcu, congue accumsan elit ultrices et. Cras eget est metus. Phasellus rhoncus iaculis diam ut convallis. Praesent porttitor ante nec lacus convallis scelerisque.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
