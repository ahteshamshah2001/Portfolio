@extends('admin.layouts.login')

@section('content')
    <h3 class="form-title">RESET PASSWORD</h3>
    <p>Please enter your email address to request a password reset link.</p>

    @include('admin.partials.errors')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<form method="post" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
    @csrf
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Please enter email..</span>
    </div>

    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address.." required>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.auth.login')  }}" class="btn btn-default"><i class="m-icon-swapleft"></i> Back </a>
        <button type="submit" class="btn green pull-right">Reset Password</button>
    </div>
</form>

@endsection