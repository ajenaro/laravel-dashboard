<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name"
            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            value="{{ old('name', $user->name) }}"
            placeholder="Name">
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email"
            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
            value="{{ old('email', $user->email) }}"
            placeholder="Email">
    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="website">Website</label>
    <input type="text" name="website"
           class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
           value="{{ old('website', $user->profile->website) }}"
           placeholder="Website">
    {!! $errors->first('website', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number"
           class="form-control"
           value="{{ old('phone_number', $user->profile->phone_number) }}"
           placeholder="Phone Number">
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password"
            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
            value="{{ old('password') }}"
            placeholder="Password">
    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="password_confirmation">Password Confirm</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirm">
</div>

<button class="btn btn-primary">{{ $btnText }}</button>
@if(isset($_COOKIE['pageurl']))
<a href="{{ url('/admin/users'.$_COOKIE['pageurl']) }}" class="btn btn-secondary">Volver</a>
@endif
