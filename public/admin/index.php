<?php
session_start();
if ($_SESSION['tip_usu']==2||!isset($_SESSION['tip_usu'])){
header('Location: ../login.php?error='.urlencode('Acceso no autorizado'));
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Fuente Montserrat -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="body">
    <style>
            @media (min-width: 760px) {
            #menuLateral .nav-link {
                color: #fff !important;
                margin-bottom: 0;
            }

            #menuLateral .nav-link:hover {
                color: #A3B2BF !important;
            }
           
        }
    </style>
        <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center align-self-center" href="#">
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
                        <a class="nav-link fw-semibold d-flex align-items-center" href="#">
                        <i class="bi bi-heart-pulse-fill me-2 fs-5"></i> Gestionar médicos
                        </a>
                    </li>

                    <li class="nav-item m-3">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="#">
                        <i class="bi bi-lightbulb-fill me-2 fs-5"></i> Visualizar sugerencia
                        </a>
                    </li>

                    <li class="nav-item m-3">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="#">
                        <i class="bi bi-bullseye me-2 fs-5"></i> Gestionar objetivos
                        </a>
                    </li>
        
    </ul>
</div>
            </div>

        </div>
    </nav>
    <section>
        <img src="assets/img/Redfit.png" class="logo" alt="">
    </section>
    <section class="container">
        <h1 class="mt-4">Bienvenido al panel de medico</h1>
        <p>Desde aquí puedes gestionar tus citas, ver tus recetas y comunicarte con tus clientes.</p>
    </section>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>