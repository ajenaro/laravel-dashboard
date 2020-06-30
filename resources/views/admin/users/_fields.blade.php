<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $user->name) }}">
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $user->email) }}">
    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}">
    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="password_confirm">Password Confirm</label>
    <input type="password" name="password_confirm" class="form-control">
</div>
