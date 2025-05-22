<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de documentacion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 20vw;
            --sidebar-collapsed-width: 70px;
            --primary-color: #4f46e5;
        }

        body {
            overflow-x: hidden;
            transition: all 0.3s;
            user-select: none;
        }

        .sidebar {
            width: var(--sidebar-collapsed-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--bs-dark-bg-subtle);
            color: var(--bs-dark-text-emphasis);
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.expanded {
            width: var(--sidebar-width);
        }

        .main-content {
            margin-left: var(--sidebar-collapsed-width);
            transition: all 0.3s;
            min-height: 100vh;
            background-color: var(--bs-body-bg);
            padding: 40px;
            cursor: default;
            
        }

        .main-content.expanded {
            margin-left: var(--sidebar-width);
            width: 100%;
        }

        .sidebar-logo {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid var(--bs-border-color);
        }

        .sidebar-logo img {
            width: 40px;
            height: 40px;
        }

        .sidebar-logo-text {
            display: none;
            margin-left: 10px;
            font-weight: bold;
        }

        .sidebar.expanded .sidebar-logo-text {
            display: inline-block;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 0.75rem 1rem;
            cursor: pointer;
            white-space: nowrap;
            position: relative;
        }

        .sidebar-menu li:hover {
            background-color: var(--bs-tertiary-bg);
        }

        .sidebar-menu li i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .sidebar-menu li span {
            display: none;
        }

        .sidebar.expanded .sidebar-menu li span {
            display: inline;
        }

        .submenu {
            list-style: none;
            padding-left: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: var(--bs-tertiary-bg);
        }

        .sidebar.expanded .submenu.show {
            max-height: 500px;
        }

        .submenu li {
            padding-left: 2rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 1rem;
            border-top: 1px solid var(--bs-border-color);
            text-align: center;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .admin-info {
            display: none;
            margin-left: 10px;
        }

        .sidebar.expanded .admin-info {
            display: inline-block;
        }

        .toggle-btn {
            position: fixed;
            left: var(--sidebar-collapsed-width);
            top: 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001;
            transform: translateX(-50%);
            transition: all 0.3s;
        }

        .sidebar.expanded + .toggle-btn {
            left: var(--sidebar-width);
        }

        .dark-mode-switch {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
            cursor: pointer;
        }

        .dark-mode-switch span {
            display: none;
        }

        .sidebar.expanded .dark-mode-switch span {
            display: inline;
            margin-left: 10px;
        }

        .menu-arrow {
            position: absolute;
            right: 1rem;
            transition: transform 0.3s;
            display: none;
        }

        .sidebar.expanded .menu-arrow {
            display: inline-block;
        }

        .menu-item.open .menu-arrow {
            transform: rotate(90deg);
        }

        .divider {
            border-top: 1px solid var(--bs-border-color);
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo d-flex align-items-center justify-content-center">
            <img src="https://scontent.ffma1-1.fna.fbcdn.net/v/t39.30808-6/493904408_1380236283116093_3607442348204201427_n.jpg?stp=dst-jpg_s206x206_tt6&_nc_cat=103&ccb=1-7&_nc_sid=50ad20&_nc_ohc=YV0L7RWeGekQ7kNvwEurvIj&_nc_oc=Adn7wOclqRKFa_kZZ29uJrEXdlCzyXGLjKfmxuZ5oJG1k9UuYDvNWJSaipGqcYGzoWc&_nc_zt=23&_nc_ht=scontent.ffma1-1.fna&_nc_gid=liRiGUjqCkqULxzMrHhBgg&oh=00_AfKGDcNzrdSEPTVxjcVGBhVYRQncUZIKPj2E_Nf0dKB0KA&oe=68337F07" alt="Logo">
            <span class="sidebar-logo-text">katana</span>
        </div>

        <div class="divider"></div>

        <ul class="sidebar-menu">
            <li>
                <i class="bi bi-house"></i>
                <span>Inicio</span>
            </li>
            <li class="menu-item" id="docsMenu">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-files"></i>
                        <span>Documentación</span>
                    </div>
                    <i class="bi bi-chevron-right menu-arrow"></i>
                </div>
                <ul class="submenu">
                    <li><i class="bi bi-file-earmark-text"></i> <span>Paradigma</span></li>
                    <li><i class="bi bi-file-earmark-text"></i> <span>Entorno de desarrollo</span></li>
                    <li><i class="bi bi-file-earmark-text"></i> <span>Ejemplos</span></li>
                    <li><i class="bi bi-file-earmark-text"></i> <span>.....</span></li>
                </ul>
            </li>
            <li>
                <a href="home">
                <i class="bi bi-escape"></i>
                <span>Salir</span>
                </a>
            </li>
        </ul>

        <div class="divider"></div>

        <div class="sidebar-footer">
            <div class="dark-mode-switch" id="darkModeSwitch">
                <i class="bi bi-moon"></i>
                <span>Modo Oscuro</span>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-3">
                <img src="https://scontent.ffma1-1.fna.fbcdn.net/v/t1.6435-9/94461830_256574922148907_6155238921774039040_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=2DthkKoRJDwQ7kNvwFpgkju&_nc_oc=AdkaFXjT285J8XR_H6sGmCw7_GvhwLDdhDE8jXmCd9zQ18FxyyGAg53USCwcSP9zWUM&_nc_zt=23&_nc_ht=scontent.ffma1-1.fna&_nc_gid=0WdLeURgHl8OvRVsTF3N8Q&oh=00_AfL03_ZnXIKFWE_4W1zgeMk-cAB5Nrd7ybGVE6cAhSKBtQ&oe=68552E54" alt="Admin" class="admin-avatar">
                <div class="admin-info">
                    <div class="fw-bold">Admin</div>
                    <small>Administrador</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de toggle -->
    <button class="toggle-btn" id="toggleSidebar">
        <i class="bi bi-chevron-right" id="toggleIcon"></i>
    </button>

    <!-- Contenido Principal -->
    

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleIcon = document.getElementById('toggleIcon');

            sidebar.classList.toggle('expanded');
            mainContent.classList.toggle('expanded');

            toggleIcon.classList.toggle('bi-chevron-right');
            toggleIcon.classList.toggle('bi-chevron-left');

            if (!sidebar.classList.contains('expanded')) {
                document.querySelectorAll('.submenu').forEach(menu => menu.classList.remove('show'));
                document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('open'));
            }
        });

        document.getElementById('docsMenu').addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar.classList.contains('expanded')) return;

            if (e.target.tagName === 'I' || e.target.tagName === 'SPAN') return;

            this.classList.toggle('open');
            const submenu = this.querySelector('.submenu');
            submenu.classList.toggle('show');
        });

        document.getElementById('darkModeSwitch').addEventListener('click', function() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-bs-theme', newTheme);

            const icon = this.querySelector('i');
            const label = this.querySelector('span');
            icon.classList.toggle('bi-moon');
            icon.classList.toggle('bi-sun');
            label.textContent = newTheme === 'dark' ? 'Modo Claro' : 'Modo Oscuro';

            localStorage.setItem('theme', newTheme);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);

            const darkModeSwitch = document.getElementById('darkModeSwitch');
            const icon = darkModeSwitch.querySelector('i');
            const label = darkModeSwitch.querySelector('span');
            if (savedTheme === 'dark') {
                icon.classList.replace('bi-moon', 'bi-sun');
                label.textContent = 'Modo Claro';
            }
        });
    </script>
</body>
</html>
