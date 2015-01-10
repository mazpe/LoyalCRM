<!-- app/views/login.blade.php -->

<!doctype html>
<html>
<head>
    <title>Loyal Driver - CRM</title>
</head>
<body>

    {{ Form::open(array('url' => 'login')) }}
        <h1>Login - Loyal Driver CRM</h1>

        <!-- if there are login errors, show them here -->
        <p>
            {{ $errors->first('email') }}
            {{ $errors->first('password') }}
        </p>

        <p>
            {{ Form::label('email', 'Email Address') }}
            {{ Form::text('email', Input::old('email'), array('placeholder' => 'email@loyaldriver.com')) }}
        </p>

        <p>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
        </p>

        <p>{{ Form::submit('Submit!') }}</p>
    {{ Form::close() }}

</body>
</html>
