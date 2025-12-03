<?php
session_start();
if ($_SESSION['tip_usu']==2||!isset($_SESSION['tip_usu'])){
    header('Location: ../login.php?error='.urlencode('Acceso no autorizado'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Objetivo</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <?php require_once __DIR__. '/nav.php' ?>
    <main class="d-flex">
        <div id="admin-main" class="p-4 w-100">
            <h1>Modificar Objetivo</h1>
            <a href="./objetivos.php" class="btn btn-primary mb-3"><i class="bi bi-arrow-return-left me-2 fs-5"></i> Regresar</a>
            
    <?php 
        if(!isset($_GET['id_obj'])){
            echo '<div class="alert alert-danger">Error: No se proporcionó un ID de objetivo.</div>';
        } else {
            require_once __DIR__.'/../../config/db.php';
            $id_obj = (int)$_GET['id_obj'];
            $sql = "SELECT * FROM objetivos WHERE id_obj = ?";
            $select_preparado = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($select_preparado,'i', $id_obj);
            mysqli_stmt_execute($select_preparado);
            $resultado = mysqli_stmt_get_result($select_preparado);

            if(!$resultado || mysqli_num_rows($resultado) != 1){
                echo '<div class="alert alert-danger">Error: El objetivo no existe.</div>';
            } else {
                $fila_db = mysqli_fetch_assoc($resultado);
                mysqli_stmt_close($select_preparado);
                ?>
                <form id="objetivosForm" class="needs-validation border rounded p-3 bg-white" novalidate>
                    <input type="hidden" name="id_obj" value="<?= $fila_db['id_obj'] ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-9">
                            <label class="form-label">Nombre del Objetivo</label>
                            <input type="text" id="nom_obj" name="nom_obj" class="form-control" placeholder="Ej. Bajar de peso" minlength="2" maxlength="255" value="<?=htmlspecialchars($fila_db['nom_obj'])?>" required>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Nombre inválido.</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estatus</label>
                            <select name="estatus" id="estatus" class="form-select" required>
                                <option value="1" <?= $fila_db['estatus'] ? 'selected' : '' ?>>Activo</option>
                                <option value="0" <?= !$fila_db['estatus'] ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                            <div class="valid-feedback">Ok.</div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="desc_obj" id="desc_obj" rows="4" class="form-control" minlength="5" placeholder="Descripción..." required><?=htmlspecialchars($fila_db['desc_obj'])?></textarea>
                        <div class="valid-feedback">Ok.</div>
                        <div class="invalid-feedback">Escribe una descripción válida.</div>
                        
                        <div class="col-12 mt-4">
                            <button class="btn btn-primary" type="submit" name="accion" value="editar">Modificar</button>
                        </div>
                    </div>
                </form>
                <?php
            }
        }
    ?>
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