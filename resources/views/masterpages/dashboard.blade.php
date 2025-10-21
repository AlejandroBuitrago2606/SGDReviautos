<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDA Sistema</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styleDashboard.css') }}">
</head>

<body>

    <form>
        @csrf

        <!-- Top Header -->
        <div class="top-header">
            <div class="user-info">
                <div>
                    <div class="greeting">Buenas tardes</div>
                    <div class="user-name">Lina Maria Ayala</div>
                </div>
                <div class="user-avatar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">

                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-container">
                <img src="{{ asset('/images/logoReviautos.png') }}" alt="CDA logo" style="width: 290px; height: 80px; ml-5">
            </div>

            @if (!isset($procesos) )
            <script>
                setTimeout(() => {
                    const msg = "No se han cargado los datos";
                    alert(msg);

                }, 0.05);
            </script>

            @endif


            @foreach ($procesos as $proceso)
            <div class="menu-item">
                <div class="menu-header">

                    <span>{{ $proceso->nombreProceso.' ('.$proceso->prefijo.')'}}</span>
                    <!-- <span class="chevron">∨</span> -->

                </div>
            </div>

            @endforeach


            <div style="justify-content: center;">
                <!-- <div class="add-button-container"> -->
                <button class="btn-add">
                    <span style="font-size: 20px; font-weight: bold;">+</span>
                    Agregar
                </button>
                <!-- </div> -->
            </div>
        </div>

  

    </form>


    <!-- Main Content -->
    <div class="main-content">
      
        @yield('content')
     


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle menu items (opcional para futura funcionalidad)
        document.querySelectorAll('.menu-header').forEach(header => {
            header.addEventListener('click', function() {
                const chevron = this.querySelector('.chevron');
                chevron.classList.toggle('active');
            });
        });
    </script>
</body>

</html>