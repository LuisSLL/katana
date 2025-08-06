<?php layout('main'); ?>
<?php section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Iniciar sesión</h2>
                    <?php if (!empty(
$error)): ?>
                        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post" action="/login">
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="user" name="user" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Acceder</button>
                    </form>
                    <div class="mt-3 text-muted small text-center">
                        <strong>Usuario:</strong> katanaframework<br>
                        <strong>Contraseña:</strong> admin123
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endSection(); ?>