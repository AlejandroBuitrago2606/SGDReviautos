<div class="modal fade" id="forgotPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px;">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="modal-header border-0 pb-0" style="padding: 24px 24px 0;">
                    <div>
                        <h1 class="modal-title fs-4 fw-bold mb-1" style="color: #1c1d27ff;" id="forgotPasswordModalLabel">Recuperación de contraseña</h1>
                        <p class="text-muted small mb-0">Ingresa tu correo para recibir el enlace</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="padding: 24px;">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                            </svg>
                            Correo Electrónico
                        </label>
                        <input type="email"
                            class="form-control"
                            name="email"
                            id="email"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="ejemplo@correo.com"
                            required />
                    </div>
                </div>

                <div class="modal-footer border-0" style="padding: 0 24px 24px;">
                    <button type="button"
                        class="btn px-4 py-2"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; color: #495057; border-radius: 8px;"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="btn px-4 py-2 d-flex align-items-center gap-2"
                        style="background-color: #10b981; border: none; color: white; border-radius: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="white" d="M2.01 21L23 12L2.01 3L2 10l15 2l-15 2z" />
                        </svg>
                        <span class="fw-semibold">Enviar enlace</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>