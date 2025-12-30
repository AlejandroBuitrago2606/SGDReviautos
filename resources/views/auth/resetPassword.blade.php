<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" value="{{ request('email') }}" placeholder="Correo" readonly>
    <input type="password" name="password" placeholder="Nueva contraseña" required>
    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>

    <button type="submit">Restablecer</button>


    
</form>