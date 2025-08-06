<?php layout('main'); ?>
<?php section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="mb-4">Ejemplos y Guía de Uso de Katana Framework ⚔️</h1>
            <p class="lead">Esta página te muestra, con ejemplos y explicaciones, cómo crear y conectar vistas, controladores, rutas, usar plantillas, helpers y debuguear en Katana.</p>

            <hr class="my-4">
            <h3>1. Crear una vista</h3>
            <p>Las vistas se guardan en <code>/Resources/Views/</code>. Por ejemplo, para una página de bienvenida:</p>
            <pre><code class="language-php">&lt;!-- Resources/Views/bienvenida.php --&gt;
&lt;?php layout('main'); ?&gt;
&lt;?php section('content'); ?&gt;
&lt;h1&gt;¡Hola Katana!&lt;/h1&gt;
&lt;?php endSection(); ?&gt;
</code></pre>

            <hr class="my-4">
            <h3>2. Crear un controlador</h3>
            <p>Los controladores van en <code>/App/Http/Controllers/</code> y devuelven vistas:</p>
            <pre><code class="language-php">namespace App\Http\Controllers;
class BienvenidaController {
    public function index() {
        return view('bienvenida');
    }
}
</code></pre>

            <hr class="my-4">
            <h3>3. Definir una ruta</h3>
            <p>Las rutas se definen en <code>/routes/web.php</code>:</p>
            <pre><code class="language-php">$router->get('/bienvenida', [BienvenidaController::class, 'index']);
</code></pre>

            <hr class="my-4">
            <h3>4. Usar layouts y secciones (Blade-like)</h3>
            <p>Katana soporta layouts y secciones para reutilizar estructura HTML:</p>
            <pre><code class="language-php">&lt;!-- Resources/Views/layouts/main.php --&gt;
&lt;?php partial('header'); ?&gt;
&lt;main&gt;
    &lt;?php yieldSection('content'); ?&gt;
&lt;/main&gt;
&lt;?php partial('footer'); ?&gt;
</code></pre>
            <p>En tu vista:</p>
            <pre><code class="language-php">&lt;?php layout('main'); ?&gt;
&lt;?php section('content'); ?&gt;
Contenido aquí
&lt;?php endSection(); ?&gt;
</code></pre>

            <hr class="my-4">
            <h3>5. Debug y herramientas de desarrollo</h3>
            <p>Katana incluye helpers para debuguear fácilmente:</p>
            <pre><code class="language-php">debug($variable); // Muestra la variable si APP_DEBUG=true en .env
</code></pre>
            <p>Si ocurre un error y <code>APP_DEBUG=true</code>, verás detalles del error en pantalla. Si está en <code>false</code>, solo verás mensajes genéricos.</p>

            <hr class="my-4">
            <h3>6. Helpers útiles</h3>
            <ul>
                <li><code>url('ruta')</code>: Genera una URL absoluta.</li>
                <li><code>redirect('ruta')</code>: Redirige a otra página.</li>
                <li><code>asset('archivo')</code>: Ruta a archivos públicos (CSS, JS, imágenes).</li>
                <li><code>env('CLAVE')</code>: Obtiene variables de entorno.</li>
            </ul>

            <hr class="my-4">
            <h3>7. Middlewares</h3>
            <p>Para proteger rutas, usa middlewares. Ejemplo de ruta protegida:</p>
            <pre><code class="language-php">$router->get('/dashboard', [DashboardController::class, 'index'], ['auth']);
</code></pre>
            <p>El middleware <code>AuthMiddleware</code> verifica si el usuario está logueado.</p>

            <hr class="my-4">
            <h3>8. Ejemplo de modelo y ORM</h3>
            <pre><code class="language-php">use App\Models\User;
$user = User::find(1);
$usuarios = User::all();
</code></pre>

            <hr class="my-4">
            <h3>9. ¿Qué hacer si algo falla?</h3>
            <ul>
                <li>Activa <code>APP_DEBUG=true</code> en <code>.env</code> para ver detalles de errores.</li>
                <li>Usa <code>debug($variable)</code> para inspeccionar datos.</li>
                <li>Revisa los logs en <code>/storage/logs/</code> si tienes errores 500.</li>
                <li>Verifica que tus rutas y controladores estén bien escritos y registrados.</li>
            </ul>

            <hr class="my-4">
            <h3>10. Más ejemplos y recursos</h3>
            <ul>
                <li><a href="https://github.com/tuusuario/katana" target="_blank">Repositorio en GitHub</a></li>
                <li><a href="/dashboard">Volver al dashboard</a></li>
            </ul>
        </div>
    </div>
</div>
<?php endSection(); ?>