<!-- Resources/Views/auth/register.php -->
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-end mb-2">
            <a href="/" class="btn btn-outline-secondary btn-sm">Salir</a>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Registrarse</h4>
            </div>
            <div class="card-body">
                <form action="/register" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>
