@extends('admin.layouts.login')

@section('content')

<!-- BEGIN LOGIN FORM -->
<form method="POST" action="{{ route('admin.auth.login') }}" class="login-form">
    @csrf
    @method('POST')
    <h3 class="form-title">ADMIN LOGIN</h3>

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Please enter username and password</span>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger custom">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {{ session('message') }}
        </div>
    @endif

    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input id="userName" class="form-control placeholder-no-fix" type="text" autocomplete="off" name="email" autofocus onKeyPress="return checkSubmit(event)" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" name="password" onKeyPress="return checkSubmit(event)" />
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
        <label class="checkbox"><input type="checkbox" name="remember" value="1"/> Remember me </label>
        <input type="submit" id="checking" value="" style="display:none;" />
    </div>
    <div class="forget-password">
        <h4>Forgot your password?</h4>
        <p>
            <a href="{{ route('admin.password.request')  }}">
                Click Here
            </a>
            to retrieve your password.
        </p>
    </div>
</form>
<!-- END LOGIN FORM -->

@stop
