# Katana PHP Framework ⚔️

Bienvenido a **Katana**, un micro-framework PHP rápido, minimalista y modular. Inspirado en la arquitectura de Laravel, pero ligero y flexible para adaptarse a todo tipo de proyectos PHP modernos.

---

## 🚀 Requisitos del sistema

- PHP 8.1 o superior
- Apache con `mod_rewrite` habilitado
- XAMPP / WAMP / Laragon / Valet / etc.
- Editor de código recomendado: VS Code

---

## 📦 Estructura del proyecto

```
katana/    
├── App/           # Controladores, modelos, middlewares  
├── Config/        # Archivos de configuración   
├── Core/          # Núcleo del framework (Router, Controller, App, etc.)    
├── public/        # Punto de entrada público (index.php, assets)   
├── Resources/     # Vistas, layouts, parciales, páginas  
├── Routes/        # Definición de rutas web  
├── Src/           # Componentes, helpers, servicios  
├── Storage/       # Logs, caché  
├── bootstrap/     # Inicialización del sistema  
├── .env           # Variables de entorno  
├── .htaccess      # Reescritura de URLs  
├── setup.php      # Configurador inicial  
└── README.md      # Documentación principal
```

---

## ⚡ Guía rápida de inicio

1. **Clona el repositorio y entra al directorio:**
   ```bash
   git clone ...
   cd katana
   ```
2. **Instala dependencias:**
   ```bash
   composer install
   ```
3. **Configura tu entorno local:**
   - Copia `.env.example` a `.env` y ajusta tus variables.
   - Configura tu VirtualHost o usa la estructura de carpetas (`localhost/katana/`).
4. **Asegúrate de tener los archivos `.htaccess` correctos** (ver sección más abajo).
5. **Accede a** `http://katana.local` **o** `http://localhost/katana/public`.

---

## 🛠️ Ejemplo de uso: Rutas y Controladores

```php
// routes/web.php
$router = app()->getRouter();
$router->get('/', [HomeController::class, 'index']);
$router->get('/user/{id}', [UserController::class, 'showProfile']);
$router->post('/login', [AuthController::class, 'login']);
```

```php
// App/Http/Controllers/HomeController.php
namespace App\Http\Controllers;
class HomeController {
    public function index() {
        return view('home', ['mensaje' => 'Bienvenido a Katana']);
    }
}
```

---

## 🗄️ Ejemplo de uso: ORM y Modelos

```php
// App/Models/User.php
namespace App\Models;
use Src\Core\Model;
class User extends Model {
    protected string $table = 'users';
}

// Obtener todos los usuarios
$usuarios = User::all();

// Buscar usuario por ID
$user = User::find(1);

// Buscar por columna
$activos = User::where('activo', 1);

// Crear usuario
$nuevo = User::create(['nombre' => 'Juan', 'email' => 'juan@mail.com']);

// Actualizar usuario
$user->update(['nombre' => 'Juan Actualizado']);

// Eliminar usuario
$user->delete();
```

### Relaciones
```php
// hasMany
$posts = $user->hasMany(Post::class, 'user_id');
// belongsTo
$post = Post::find(1);
$autor = $post->belongsTo(User::class, 'user_id');
```

---

## 🔒 Ejemplo de uso: Autenticación

```php
use Src\Core\Auth;

// Login
if (Auth::attempt($email, $password)) {
    redirect('/dashboard');
} else {
    echo 'Credenciales incorrectas';
}

// Verificar usuario logueado
auth()->check(); // true/false

// Obtener usuario autenticado
$user = Auth::user();
```

---

## ⚙️ Configuración de .htaccess

El framework requiere dos archivos `.htaccess` para funcionar correctamente:

- **Raíz del proyecto (`.htaccess`)**: Redirige todas las peticiones a la carpeta `/public` si no usas un VirtualHost dedicado.
- **Carpeta `/public` (`public/.htaccess`)**: Redirige todas las rutas amigables a `index.php` para el enrutamiento interno.

Ejemplo de `.htaccess` en la raíz:

```apache
Options -Indexes
RedirectMatch 403 ^/$
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /public/$1 [L,QSA]
```

Ejemplo de `.htaccess` en `/public`:

```apache
Options -Indexes
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L]
```

Asegúrate de tener ambos archivos para que las rutas funcionen tanto en `katana.local` como en `localhost/katana/`.

---

## 🧑‍💻 Contribuir

1. Haz un fork del repositorio.
2. Crea una rama para tu feature/fix: `git checkout -b mi-feature`
3. Haz tus cambios y commitea: `git commit -am 'Agrega mi feature'`
4. Haz push a tu fork: `git push origin mi-feature`
5. Abre un Pull Request.

---

## ❓ Troubleshooting y Preguntas Frecuentes

- **404 en rutas amigables:**
  - Verifica que `.htaccess` esté bien configurado y que Apache tenga `mod_rewrite` activo.
- **Redirecciones incorrectas:**
  - Asegúrate de definir correctamente `APP_URL` en `.env` si usas subcarpetas o dominios personalizados.
- **Error 500:**
  - Activa `APP_DEBUG=true` en `.env` para ver detalles.
- **Sesiones no funcionan:**
  - Verifica permisos de la carpeta `storage/`.

---

## 📚 Enlaces útiles
- [Documentación oficial (en desarrollo)](https://github.com/tuusuario/katana-docs)
- [Repositorio GitHub](https://github.com/tuusuario/katana)

---

¡Gracias por usar Katana! ⚔️


