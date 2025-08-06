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
            <hr class="my-4">
            <h3>11. ¿Cómo limpiar el proyecto para tu propio uso?</h3>
            <p>Cuando quieras empezar tu propio proyecto y no necesites algunos ejemplos (como el dashboard, login, o el usuario de ejemplo), sigue estos pasos para limpiar el código de forma segura:</p>
            <ol>
                <li><strong>Elimina las rutas que no usarás</strong> en <code>routes/web.php</code>.<br>
                    <span class="text-muted">Por ejemplo, si no quieres dashboard ni login, borra o comenta estas líneas:</span>
                    <pre><code class="language-php">// $router->get('/dashboard', [DashboardController::class, 'index'], ['auth']);
// $router->get('/login', [LoginController::class, 'showLogin']);
// ...
</code></pre>
                </li>
                <li><strong>Elimina los controladores que no necesitas</strong> en <code>/App/Http/Controllers/</code>.<br>
                    <span class="text-muted">Por ejemplo, borra <code>DashboardController.php</code> y <code>LoginController.php</code> si no los usarás.</span>
                </li>
                <li><strong>Elimina las vistas asociadas</strong> en <code>/Resources/Views/</code>.<br>
                    <span class="text-muted">Por ejemplo, borra <code>dashboard.php</code> y <code>auth/login.php</code> si no los necesitas.</span>
                </li>
                <li><strong>Revisa los layouts y menús</strong>.<br>
                    <span class="text-muted">Quita enlaces a dashboard o login del <code>header.php</code> si ya no existen.</span>
                </li>
                <li><strong>¿Ves un error 404 o "Clase no existe"?</strong><br>
                    <span class="text-danger">¡No te asustes!</span> Es porque alguna ruta apunta a un controlador que ya no existe. Simplemente revisa <code>routes/web.php</code> y elimina o corrige esa ruta.</li>
                <li><strong>¿Ves un error de vista?</strong><br>
                    <span class="text-danger">¡No te asustes!</span> Es porque algún controlador intenta cargar una vista que ya no existe. Revisa el método y corrige el nombre de la vista o crea una nueva.</li>
            </ol>
            <p class="alert alert-info mt-3">Siempre elimina primero las rutas, luego los controladores y finalmente las vistas. Así evitarás errores inesperados.</p>
            <p>Si tienes dudas, puedes dejar solo la ruta de inicio y la vista <code>home.php</code> y construir tu proyecto desde ahí.</p>

            <hr class="my-4">
            <h2 class="mb-4">Categorías avanzadas y despliegue</h2>

            <h4>🟢 Despliegue en Render.com (o similar)</h4>
            <p>Para desplegar Katana en <a href="https://render.com/" target="_blank">Render</a> o cualquier servicio similar:</p>
            <ol>
                <li>Asegúrate de tener un <code>public/</code> como root y <code>composer.json</code> en la raíz.</li>
                <li>Sube tu código a GitHub.</li>
                <li>En Render, crea un nuevo servicio web y conecta tu repo.</li>
                <li>Configura el build command:<br><code>composer install --no-dev --optimize-autoloader</code></li>
                <li>Configura el start command:<br><code>php -S 0.0.0.0:10000 -t public</code></li>
                <li>En "Root Directory" pon <code>public</code> si Render lo pide.</li>
                <li>Agrega variables de entorno desde tu <code>.env</code> (no subas <code>.env</code> real al repo).</li>
            </ol>
            <p class="alert alert-info">Recuerda: Render y otros servicios suelen requerir que el entrypoint sea <code>public/index.php</code>.</p>

            <hr class="my-4">
            <h4>🟢 Migraciones y base de datos</h4>
            <p>Katana no incluye un sistema de migraciones propio, pero puedes usar <a href="https://laravel.com/docs/10.x/migrations" target="_blank">Phinx</a> o <a href="https://laravel.com/docs/10.x/migrations" target="_blank">Laravel Migrations</a> si lo deseas.</p>
            <p>Ejemplo usando <strong>Phinx</strong>:</p>
            <pre><code class="language-bash">composer require robmorgan/phinx --dev
vendor/bin/phinx init
# Edita phinx.php y configura tu base de datos
vendor/bin/phinx create CreateUsersTable
vendor/bin/phinx migrate
</code></pre>
            <p>Esto te permite crear y versionar tus tablas fácilmente.</p>

            <hr class="my-4">
            <h4>🟢 Pruebas automáticas</h4>
            <p>Katana soporta PHPUnit. Los tests van en <code>/tests</code>:</p>
            <pre><code class="language-php">// tests/ExampleTest.php
use PHPUnit\Framework\TestCase;
class ExampleTest extends TestCase {
    public function testHomeController() {
        $controller = new HomeController();
        $result = $controller->index();
        $this->assertStringContainsString('Katana', $result);
    }
}
</code></pre>
            <p>Para correr los tests:</p>
            <pre><code class="language-bash">./vendor/bin/phpunit tests
</code></pre>

            <hr class="my-4">
            <h4>🟢 Advertencias y tips extra</h4>
            <ul>
                <li>Si cambias la estructura de carpetas, actualiza las rutas y los <code>require_once</code> en <code>public/index.php</code> y <code>bootstrap/app.php</code>.</li>
                <li>Si usas <code>APP_URL</code> en <code>.env</code>, asegúrate de que coincida con tu dominio real en producción.</li>
                <li>Para debug avanzado, puedes usar <a href="https://xdebug.org/" target="_blank">Xdebug</a> en local.</li>
                <li>Para logs, revisa <code>/storage/logs/</code> y asegúrate de que el servidor tenga permisos de escritura.</li>
                <li>Si usas assets personalizados, ponlos en <code>/public</code> y usa <code>asset('archivo')</code> para referenciarlos.</li>
                <li>Si tienes dudas, revisa el <code>README.md</code> o abre un issue en el repo.</li>
            </ul>
            <hr class="my-4">
            <h4>🟢 Integración con Firebase (API REST)</h4>
            <p>Puedes consumir servicios de Firebase (o cualquier API REST) usando <code>file_get_contents</code>, <code>curl</code> o librerías como <code>guzzlehttp/guzzle</code>:</p>
            <pre><code class="language-php">// Ejemplo simple con file_get_contents
$url = 'https://your-firebase.firebaseio.com/usuarios.json';
$json = file_get_contents($url);
$data = json_decode($json, true);
</code></pre>
            <pre><code class="language-php">// Ejemplo con Guzzle
// composer require guzzlehttp/guzzle
use GuzzleHttp\Client;
$client = new Client();
$response = $client->get('https://your-firebase.firebaseio.com/usuarios.json');
$data = json_decode($response->getBody(), true);
</code></pre>
            <p>Recuerda nunca exponer claves privadas en el frontend ni en el repo.</p>

            <hr class="my-4">
            <h4>🟢 Consumo de APIs externas</h4>
            <p>Para consumir cualquier API externa (REST, GraphQL, etc.):</p>
            <pre><code class="language-php">$json = file_get_contents('https://api.publicapis.org/entries');
$apis = json_decode($json, true);
</code></pre>
            <p>O usando Guzzle para peticiones más avanzadas:</p>
            <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$res = $client->request('GET', 'https://api.publicapis.org/entries');
$data = json_decode($res->getBody(), true);
</code></pre>

            <hr class="my-4">
            <h4>🟢 Despliegue en otros servidores</h4>
            <ul>
                <li><strong>Heroku:</strong>
                    <ol>
                        <li>Agrega un <code>Procfile</code> con:<br><code>web: php -S 0.0.0.0:$PORT -t public</code></li>
                        <li>Sube tu repo y haz <code>git push heroku main</code></li>
                        <li>Configura variables de entorno en el dashboard de Heroku.</li>
                    </ol>
                </li>
                <li><strong>Vercel:</strong>
                    <ol>
                        <li>Usa <a href="https://vercel.com/docs/concepts/functions/serverless-functions" target="_blank">Serverless Functions</a> o sube como proyecto PHP estático.</li>
                        <li>Configura <code>public/</code> como root.</li>
                    </ol>
                </li>
                <li><strong>cPanel/Hosting compartido:</strong>
                    <ol>
                        <li>Sube todo el contenido de <code>public/</code> a <code>public_html/</code>.</li>
                        <li>El resto del framework puede ir fuera de <code>public_html</code> por seguridad.</li>
                        <li>Configura <code>.htaccess</code> para enrutar todo a <code>index.php</code>.</li>
                    </ol>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php endSection(); ?>