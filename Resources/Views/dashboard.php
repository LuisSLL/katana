<?php layout('main'); ?>
<?php section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-3">Bienvenido, <span class="text-primary"><?= htmlspecialchars($user) ?></span>!</h2>
                    <p class="lead">Has accedido correctamente al panel protegido de Katana Framework.</p>
                    <a href="#" class="btn btn-success mt-3">Botón de ejemplo</a>
                    <a href="/logout" class="btn btn-outline-danger mt-3 ms-2">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endSection(); ?>