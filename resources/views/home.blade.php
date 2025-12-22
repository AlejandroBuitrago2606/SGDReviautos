@extends('masterpages.dashboard')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/home.css') }}">

<div class="dashboard-container">
    <!-- Elementos decorativos -->
    <div class="bg-decoration-1"></div>
    <div class="bg-decoration-2"></div>

    <!-- Contenedor principal -->
    <div class="main-wrapper">

        <!-- Logo y Bienvenida -->
        <div class="welcome-section">


            <h1 class="greeting-title">
                <span id="greeting">¡Qué bueno verte de nuevo!</span>
            </h1>
            <p class="greeting-subtitle">
                Sistema de Gestión Documental
            </p>
        </div>

        <!-- Tarjeta Principal -->
        <div class="main-card">

            <!-- Banner de bienvenida -->
            <div class="welcome-banner">
                <div class="banner-header">
                    <svg class="banner-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                    <h2 class="banner-title">
                        ¡Bienvenido de vuelta!
                    </h2>
                </div>
                <p class="banner-text">
                    Gestiona tus documentos de forma simple y eficiente.<br />
                    Selecciona una acción rápida para comenzar.
                </p>
            </div>

            <!-- Acciones Rápidas -->
            <h3 class="actions-title">
                Acciones Rápidas
            </h3>

            <div class="quick-actions">
                <!-- Agregar Documento -->
                <a href="{{ url('/agregarDocumento') }}" class="action-btn-home action-btn-purple">
                    <div class="action-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 56 56">
                            <path fill="#000" d="M15.555 53.125h24.89c4.852 0 7.266-2.461 7.266-7.336V24.508c0-3.024-.328-4.336-2.203-6.258L32.57 5.102c-1.78-1.829-3.234-2.227-5.882-2.227H15.555c-4.828 0-7.266 2.484-7.266 7.36v35.554c0 4.898 2.438 7.336 7.266 7.336m.187-3.773c-2.414 0-3.68-1.29-3.68-3.633V10.305c0-2.32 1.266-3.657 3.704-3.657h10.406v13.618c0 2.953 1.5 4.406 4.406 4.406h13.36v21.047c0 2.343-1.243 3.633-3.68 3.633ZM31 21.132c-.914 0-1.29-.374-1.29-1.312V7.375l13.5 13.758Zm5.625 9.985h-17.79c-.843 0-1.452.633-1.452 1.43c0 .82.61 1.453 1.453 1.453h17.789a1.43 1.43 0 0 0 1.453-1.453c0-.797-.633-1.43-1.453-1.43m0 8.18h-17.79c-.843 0-1.452.656-1.452 1.476c0 .797.61 1.407 1.453 1.407h17.789c.82 0 1.453-.61 1.453-1.407c0-.82-.633-1.476-1.453-1.476" />
                        </svg>
                    </div>
                    <h4 class="action-label">Agregar Documento</h4>
                </a>

                <!-- Ver Procesos -->
                <button data-bs-toggle="modal" data-bs-target="#gestionarProceso" class="action-btn-home action-btn-green">
                    <div class="action-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd">
                                <path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                <path fill="#000" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6h6a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm7 9V5H5v7z" />
                            </g>
                        </svg>
                    </div>
                    <h4 class="action-label">Ver Procesos</h4>
                </button>

                <!-- Gestionar Usuarios -->
                <a href="{{ url('/usuarios') }}" class="action-btn-home action-btn-red">
                    <div class="action-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 32 32">
                            <path fill="#000" d="M6 30h20v-5a7.01 7.01 0 0 0-7-7h-6a7.01 7.01 0 0 0-7 7zM9 9a7 7 0 1 0 7-7a7 7 0 0 0-7 7" />
                        </svg>
                    </div>
                    <h4 class="action-label">Gestionar Usuarios</h4>
                </a>
            </div>

            <!-- Footer de la tarjeta -->
            <div class="card-footer">
                <p class="tip-text">
                   <- 💡 Tip: Usa el menú lateral para navegar entre secciones
                </p>
                <!-- <button class="manual-btn">
                    Ver Manuales
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />
                    </svg>
                </button> -->
            </div>
        </div>

    </div>
</div>

@endsection