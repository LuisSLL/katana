<?php layout('auth'); ?> <!-- Usamos layout() en lugar de extend() -->

<?php section('content'); ?> <!-- Definimos la sección 'content' -->

<form action="/register" method="POST">
    <h2 class="text-center mb-4">Registrarse</h2>
    <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nombre" required>
    </div>
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Correo" required>
    </div>
    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Crear cuenta</button>
    <p class="mt-3 text-center">
        ¿Ya tienes cuenta? <a href="/login">Inicia sesión</a>
    </p>
</form>

<?php endSection(); ?>