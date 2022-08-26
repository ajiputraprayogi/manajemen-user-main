@extends('layouts.empty')
@section('title', 'Login')
@section('class', 'login-page')

@section('stylesheets')
<style type="text/css">
.login-page, .register-page {
    background: #d2d6de url("/adminlte/images/background.png");
}
</style>
@endsection
@section('content')
<div class="login-box">
    <div class="login-box-body">
        <div class="login-logo">
            <a href="#"><img src="{{asset(config('configs.app_logo'))}}" class="img-responsive"></a>
        </div> 
        <form action="{{route('login.post')}}" method="post" autocomplete="off">
            @csrf
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="{{ __('Email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('email', '<p class="help-block"><small>:message</small></p>') !!}
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('password', '<p class="help-block"><small>:message</small></p>') !!}
            </div>
            <div class="form-group">
                <button type="submit" class="submit btn btn-primary btn-block btn-flat">Login</button>
            </div>
        </form>
    </div>
  </div>
@endsection
