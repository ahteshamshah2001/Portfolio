<p><b>Hi {{ $data['name'] }},</b></p>
<p>Your account was created at <a href="{{ route('admin.auth.login') }}">{{ route('admin.auth.login') }}</a>, please follow the link below to access it:</p>

<p>
    <b>Account Type:</b> Admin
    <br /><br />
    <b>Link:</b> <a href="{{ route('admin.auth.login') }}">{{ route('admin.auth.login') }}</a>
    <br />
    <b>Email Address:</b> {{ $data['email'] }}
    <br />
    <b>Password:</b> {{ $data['password'] }}
</p>

<p>Thanks,</p>

<p>
    <b>Best Regards,</b>
    <br />
    {{ config('app.site_title') }}
</p>