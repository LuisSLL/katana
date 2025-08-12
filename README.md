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
├── App/           # Controladores, modelos, middlewares de ejemplo  
├── Config/        # Archivos de configuración   
├── Core/          # Núcleo del framework (Router, Controller, App, etc.)    
├── public/        # Punto de entrada público (index.php, assets)   
├── Resources/     # Vistas, layouts, parciales, páginas  
├── Routes/        # Definición de rutas web  
├── Src/           # Componentes, helpers, servicios  
├── Storage/       # Logs, caché  
├── bootstrap/     # Inicialización del sistema  
├── .env.example   # Variables de entorno de ejemplo  
├── .htaccess      # Reescritura de URLs  
├── setup.php      # Configurador inicial  
├── tests/         # Pruebas automáticas  
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
3. **Copia y configura tu entorno:**
   ```bash
   cp .env.example .env
   # Edita .env según tu entorno
   ```
4. **Asegúrate de tener los archivos `.htaccess` correctos** (ver sección más abajo).
5. **Accede a** `http://katana.local` **o** `http://localhost/katana/public`.

---

## 🛠️ Ejemplo de uso: Rutas y Controladores

```php
// routes/web.php
$router = app()->getRouter();
$router->get('/', [HomeController::class, 'index']);
$router->get('/user/{id}', [UserController::class, 'showProfile']);
$router->get('/dashboard', [DashboardController::class, 'index'], ['auth']);
```

```php
 namespace App\Http\Controllers;

   class HomeController
   {
       /**
        * Muestra la página de inicio.
        */
       public function index()
       {
           // Aquí podrías cargar datos dinámicos si lo necesitas
           return view('home');
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

// Crear usuario
$nuevo = User::create(['name' => 'Juan', 'email' => 'juan@mail.com', 'password' => 'secreto']);

// Validar contraseña
$user->validatePassword('secreto');
```

---

## 🔒 Ejemplo de uso: Autenticación y Middlewares

- El middleware `AuthMiddleware` protege rutas como `/dashboard`.
- Ejemplo de login fijo:

```php
if ($user === 'katanaframework' && $pass === 'admin123') {
    $_SESSION['user'] = ['username' => $user];
    header('Location: /dashboard');
    exit;
}
```

---

## ⚙️ Configuración de .env

Copia `.env.example` a `.env` y edítalo según tu entorno:

```
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/katana
DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=katana_db
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
```

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

## 🧪 Pruebas automáticas

- Los tests de ejemplo están en `/tests` y usan PHPUnit.
- Para correr los tests:
  ```bash
  ./vendor/bin/phpunit tests
  ```

---

## 📚 Enlaces útiles
- [Documentación oficial (en desarrollo)](https://github.com/tuusuario/katana-docs)
- [Repositorio GitHub](https://github.com/tuusuario/katana)

---

¡Gracias por usar Katana! ⚔️


