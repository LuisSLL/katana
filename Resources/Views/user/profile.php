<?php layout('main'); ?>
<?php section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-3">Perfil de usuario</h2>
                    <?php if (!empty($user)): ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($user->id) ?></li>
                            <li class="list-group-item"><strong>Nombre:</strong> <?= htmlspecialchars($user->name ?? 'N/A') ?></li>
                            <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user->email ?? 'N/A') ?></li>
                        </ul>
                    <?php else: ?>
                        <div class="alert alert-warning">Usuario no encontrado.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endSection(); ?>