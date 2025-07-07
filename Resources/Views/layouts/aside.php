<!DOCTYPE html>
<html>
<head>
    <title>Panel administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .logo-img {
            height: 30px; /* Ajusta según necesites */
            object-fit: contain;
        }
        .collapsed .logo-img {
            width: 30px; /* Cuando el sidebar está colapsado */
            margin-left: 5px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex vh-100">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-dark text-white d-flex flex-column" style="width: 250px; transition: all 0.3s;">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <!-- Reemplaza con tu imagen de logo -->
                        <img src="ruta/a/tu/logo.png" alt="Logo" class="logo-img me-2 sidebar-logo">
                        <h4 class="mb-0 sidebar-text">BE ONLINE</h4>
                    </div>
                    <button id="toggleSidebar" class="btn btn-link text-white p-0">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </div>
                
                <!-- User Info -->
                <div class="d-flex align-items-center p-2 bg-dark bg-opacity-25 rounded">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                    <div class="sidebar-text">
                        <div class="fw-bold">Usuario</div>
                        <small class="text-white-50">Admin</small>
                    </div>
                </div>
            </div>

            <!-- Resto del código permanece igual -->
            <!-- Menu -->
            <ul class="nav nav-pills flex-column mb-auto px-3">
                <li class="nav-item mb-1">
                    <a class="nav-link text-white active bg-opacity-25 bg-primary" href="/dashboard">
                        <i class="bi bi-house-door me-2"></i>
                        <span class="sidebar-text">Inicio</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white" href="/profile">
                        <i class="bi bi-person me-2"></i>
                        <span class="sidebar-text">Usuarios</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white" href="/profile">
                        <i class="bi bi-person me-2"></i>
                        <span class="sidebar-text">Clientes</span>
                    </a>
                </li>
                
                <!-- Menú desplegable -->
                <li class="nav-item mb-1 has-treeview">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#reportesCollapse" role="button">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        <span class="sidebar-text">Reportes</span>
                        <i class="bi bi-chevron-down float-end sidebar-text"></i>
                    </a>
                    <div class="collapse" id="reportesCollapse">
                        <ul class="nav nav-treeview flex-column ps-4 py-2">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/reportes/ventas">
                                    <i class="bi bi-graph-up me-2"></i>
                                    <span class="sidebar-text">Ventas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/reportes/inventario">
                                    <i class="bi bi-box-seam me-2"></i>
                                    <span class="sidebar-text">Inventario</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/reportes/clientes">
                                    <i class="bi bi-people me-2"></i>
                                    <span class="sidebar-text">Clientes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item mb-1">
                    <a class="nav-link text-white" href="/settings">
                        <i class="bi bi-gear me-2"></i>
                        <span class="sidebar-text">Configuración</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white" href="/notifications">
                        <i class="bi bi-bell me-2"></i>
                        <span class="sidebar-text">Notificaciones</span>
                        <span class="badge bg-danger float-end sidebar-text">3</span>
                    </a>
                </li>
            </ul>

            <!-- Footer Menu -->
            <div class="mt-auto p-3 border-top border-secondary">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= url('logout') ?>">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            <span class="sidebar-text">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="p-4 flex-grow-1 overflow-auto">
            <button id="mobileToggle" class="btn btn-dark mb-3 d-lg-none">
                <i class="bi bi-list"></i>
            </button>
            <?php yieldSection('content'); ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const mobileToggle = document.getElementById('mobileToggle');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            const sidebarLogo = document.querySelector('.sidebar-logo');
            
            // Función para alternar el sidebar
            function toggleSidebar() {
                const isCollapsed = sidebar.style.width === '80px';
                
                if(isCollapsed) {
                    sidebar.style.width = '250px';
                    toggleBtn.innerHTML = '<i class="bi bi-chevron-left"></i>';
                } else {
                    sidebar.style.width = '80px';
                    toggleBtn.innerHTML = '<i class="bi bi-chevron-right"></i>';
                }
                
                // Alternar visibilidad del texto
                sidebarTexts.forEach(text => {
                    text.style.display = isCollapsed ? 'inline' : 'none';
                });
                
                // Alternar clase para el logo
                if(isCollapsed) {
                    sidebarLogo.classList.remove('collapsed');
                } else {
                    sidebarLogo.classList.add('collapsed');
                }
                
                // Alternar padding para el menú colapsado
                const menuItems = document.querySelectorAll('.nav-link, .p-3');
                menuItems.forEach(item => {
                    if(isCollapsed) {
                        item.classList.remove('px-2');
                        item.classList.add('px-3');
                    } else {
                        item.classList.remove('px-3');
                        item.classList.add('px-2');
                    }
                });
            }
            
            // Función para alternar en móviles
            function toggleMobileSidebar() {
                const isHidden = sidebar.style.marginLeft === '-250px';
                sidebar.style.marginLeft = isHidden ? '0' : '-250px';
            }
            
            // Event listeners
            toggleBtn.addEventListener('click', toggleSidebar);
            mobileToggle.addEventListener('click', toggleMobileSidebar);
            
            // Ajustar para móviles al cargar
            if(window.innerWidth < 992) {
                sidebar.style.marginLeft = '-250px';
                sidebar.style.position = 'absolute';
                sidebar.style.zIndex = '1000';
                sidebar.style.height = '100vh';
            }
            
            // Manejar redimensionamiento
            window.addEventListener('resize', function() {
                if(window.innerWidth >= 992) {
                    sidebar.style.marginLeft = '0';
                    sidebar.style.position = 'relative';
                } else {
                    sidebar.style.marginLeft = '-250px';
                    sidebar.style.position = 'absolute';
                }
            });
        });
    </script>
</body>
</html>