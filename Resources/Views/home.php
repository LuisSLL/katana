<?php layout('main'); ?>

<?php section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 text-center">
            <img src="https://img.icons8.com/ios-filled/100/000000/samurai-helmet.png" alt="Katana Logo" class="mb-4" style="width:100px;">
            <h1 class="display-4 fw-bold mb-3">Katana PHP Framework ⚔️</h1>
            <p class="lead mb-4">
                Un micro-framework PHP rápido, minimalista y modular.<br>
                Inspirado en Laravel, pero ligero y flexible para proyectos modernos.
            </p>
            <a href="https://github.com/tuusuario/katana" class="btn btn-primary btn-lg me-2" target="_blank">
                <i class="bi bi-github"></i> GitHub
            </a>
            <a href="admin" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-book"></i> Documentación
            </a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">🚀 Rápido y Minimalista</h5>
                    <p class="card-text">Carga ultra rápida, sin dependencias innecesarias. Ideal para APIs, microservicios y proyectos modernos.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">🧩 Modular y Extensible</h5>
                    <p class="card-text">Organiza tu código en controladores, modelos, middlewares y helpers. Fácil de extender y mantener.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">🔒 Seguro y Moderno</h5>
                    <p class="card-text">Incluye autenticación, ORM simple, middlewares y protección CSRF. Compatible con PHP 8.1+.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endSection(); ?>

