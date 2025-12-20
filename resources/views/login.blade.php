<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
</head>

<body>

    <div class="login-page">
    <div class="form">
        <form class="login-form" action="{{ url('/login') }}" method="POST">
            @csrf

            <input type="email" name="email" placeholder="Correo electrónico" required />
            <input type="password" name="password" placeholder="Contraseña" required />
            <button>Login</button>

            @if (session('error'))
                <div class="alert alert-danger mt-2">
                    {{ session('error') }}
                </div>
            @endif

        </form>
    </div>
</div>





</body>

</html>