
    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-1">
        <div class="container">
            <div class="text-center">
               <p>&copy; <?php echo date('Y'); ?> Katana Framework</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Dark Mode Script -->
    <script>
        // Dark Mode Toggle
        const darkModeSwitch = document.getElementById('darkModeSwitch');
        
        // Verificar preferencia del sistema o guardada
        if (localStorage.getItem('darkMode') === 'enabled' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
            darkModeSwitch.checked = true;
        }
        
        // Escuchar cambios en el switch
        darkModeSwitch.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    </script>
</body>
</html>