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

            <form class="login-form" action="login" method="POST">
                @csrf

                <input type="email" name="correo" placeholder="Correo electronico" />
                <input type="password" name="clave" placeholder="Contraseña" />
                <button>login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>


                @if (isset($usuario))

                <script>
                    setTimeout(() => {
                        const msg = @json($usuario);
                        alert(msg);

                    }, 0.05);
                </script>


                @endif


            </form>
        </div>
    </div>





</body>

</html>