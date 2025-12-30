<div class="modal fade" id="forgotPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="forgotPasswordModalLabel">Recuperacion de contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="email" class="form-control" name="email" placeholder="Correo" required>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Enviar enlace</button>
                </div>

            </form>
        </div>
    </div>
</div>