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

katana/    
├── App/ # Controladores, modelos, middlewares  
├── Config/ # Archivos de configuración   
├── Core/ # Núcleo del framework (Router, Controller, App, etc.)    
├── public/ # Punto de entrada público (index.php, assets)   
├── Resources/  
│ └── Views/ # Vistas (layouts, parciales, páginas)  
├── Routes/ # Definición de rutas web  
├── Src/ # Componentes, helpers, servicios  
├── Storage/ # Logs, caché  
├── bootstrap/ # Inicialización del sistema  
├── .env # Variables de entorno  
├── .htaccess # Reescritura de URLs  
├── setup.php # Configurador inicial  
└── README.md                                                


---

## 🌐 Configuración del entorno local con `katana.local`

### 1️⃣ Agregar entrada en el archivo `hosts`

Editá el archivo `C:\Windows\System32\drivers\etc\hosts` como **administrador** y agregá:

---
127.0.0.1 katana.local


> 🛠️ Tip: Abrí **Bloc de notas como administrador**, luego `Archivo > Abrir` y navegá hasta esa ruta para editarlo.

---

### 2️⃣ Crear VirtualHost en Apache

Editá el archivo `C:\xampp\apache\conf\extra\httpd-vhosts.conf` y agregá al final:

```apache
<VirtualHost *:80>
    ServerName katana.local
    DocumentRoot "C:/xampp/htdocs/katana/public"

    <Directory "C:/xampp/htdocs/katana/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

📌 Reiniciá Apache desde el panel de XAMPP después de guardar los cambios.

###3️⃣ Activar módulo mod_rewrite
Asegurate de que la siguiente línea esté descomentada en httpd.conf

LoadModule rewrite_module modules/mod_rewrite.so

Además, asegurate de permitir AllowOverride All

```
<Directory "C:/xampp/htdocs">
    AllowOverride All
</Directory>
```

###✅ Acceder al proyecto
Abrí en tu navegador:

http://katana.local

Si todo está bien, verás:
Bienvenid@ a Katana Framework

###⚠️ Errores comunes
404 en localhost/katana/public/: Este framework está pensado para funcionar bajo katana.local. Usar rutas relativas puede causar errores.

HTTPS tachado o advertencia de sitio inseguro: Es normal en localhost sin certificado SSL. Podés ignorarlo o instalar un certificado auto-firmado.

No se puede editar hosts: Abrí Bloc de notas como administrador y abrilo desde ahí.

###📚 Enlaces útiles
Documentación oficial (en desarrollo)

Repositorio GitHub ← próximamente

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


