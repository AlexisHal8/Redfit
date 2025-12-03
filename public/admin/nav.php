        <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center align-self-center" href="index.php">
                <img src="../assets/img/miniredfit.png" alt="Logo" class="icon-nav" style="height:60px;">
            </a>

            <!-- Botón hamburguesa -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral"
                aria-controls="menuLateral">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú colapsable -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="menuLateral">
                <div class="offcanvas-header bg-black">
                    <h5 class="offcanvas-title text-white">Menú</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body bg-black">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        
                    <li class="nav-item m-3">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="alta_medicos.php">
                        <i class="bi bi-heart-pulse-fill me-2 fs-5"></i> Gestionar médicos
                        </a>
                    </li>

                    <li class="nav-item m-3">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="comentarios.php">
                        <i class="bi bi-lightbulb-fill me-2 fs-5"></i> Visualizar sugerencia
                        </a>
                    </li>

                    <li class="nav-item m-3">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="alta_objetivos.php">
                        <i class="bi bi-bullseye me-2 fs-5"></i> Gestionar objetivos
                        </a>
                    </li>
        
    </ul>
</div>
            </div>

        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>