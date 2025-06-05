<?php
// App/Http/Middleware/MaintenanceMiddleware.php
namespace App\Http\Middleware;

class MaintenanceMiddleware {
    public function handle(callable $next) {

        
        if (env('APP_MAINTENANCE') === 'true') {
            die("🔧 Sitio en mantenimiento");
        }

        return $next();
       
    }
}