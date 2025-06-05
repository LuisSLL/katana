<!-- resources/views/auth/login.php -->
<?php layout('auth'); ?> <!-- Usamos layout() en lugar de extend() -->

<?php section('content'); ?> <!-- Definimos la sección 'content' -->

<form action="<?= url('login') ?>" method="POST">

    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Correo" required>
    </div>
    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Entrar</button>
    
</form>

<?php endSection(); ?>