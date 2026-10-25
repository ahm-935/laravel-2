<h1>Hi {{ $name }}</h1>
<h2> Welcome to {{ config('app.name') }}</h2>

<p>
    Please click the link below to verify your email address.
</p>
<br>
    <b> Your Name: </b> {{ $name }} <br>
    <b> Your Email: </b> {{ $email }}
<p>
    <a>Verify Email</a>
</p>

<p>
    Thank you,<br>
    {{ config('app.name') }}
</p>