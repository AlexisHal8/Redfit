<?php
session_start();
if ($_SESSION['tip_usu']==2||!isset($_SESSION['tip_usu'])){
    header('Location: ../login.php?error='.urlencode('Acceso no autorizado'));
    exit();
}
$error=isset($_GET['error']) ? $_GET['error'] : '';
$mensaje=isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Objetivo</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
     <?php require_once __DIR__. '/nav.php' ?>
    <main class="d-flex">
        <div id="admin-main" class="p-4 w-100">
            <h1>Agregar Objetivo</h1>
            <?php if ($mensaje) {?>
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <?= htmlspecialchars($mensaje) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"> </button>
                </div>
            <?php } ?>
            <?php if ($error) {?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <?= htmlspecialchars($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"> </button>
                </div>
            <?php } ?>
            
            <div>
                <form id="objetivosForm" class="needs-validation border rounded p-3 bg-white" novalidate>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Nombre del Objetivo</label>
                            <input type="text" id="nom_obj" name="nom_obj" class="form-control" placeholder="Ej. Bajar de peso" minlength="2" maxlength="255" required>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Ingresa un nombre válido (2-255 caracteres).</div>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="desc_obj" id="desc_obj" rows="4" class="form-control" minlength="5" placeholder="Describe el objetivo..." required></textarea>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Escribe una descripción.</div>
                    </div>

                    <div class="col-12 mt-4">
                        <button class="btn btn-primary" type="submit" name="accion" value="agregar">Agregar</button>
                        <a href="objetivos.php" class="btn btn-dark float-end">Consultar Objetivos</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        var form=document.getElementById('objetivosForm');
        form.addEventListener('submit',function(e){
            if (!form.checkValidity()){
                e.preventDefault();
                e.stopPropagation();
            }else{
                form.action='../../lib/gestor_objetivos.php';
                form.method='post';
            }
            form.classList.add('was-validated');
        });
    </script>
</body>
</html>