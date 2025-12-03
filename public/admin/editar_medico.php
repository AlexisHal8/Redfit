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
    <title>Agregar producto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <?php require_once __DIR__. '/nav.php' ?>
    <!-- CONTENIDO -->
    <main class="d-flex">
        <div id="admin-main" class="p-4">
            <h1>Modificar medicos</h1>
            <a href=./medicos.php class="btn btn-primary"><i class="bi bi-arrow-return-left me-2 fs-5"></i></a>
            
            
    <?php 
        if(!isset($_GET['id_usr'])){
            echo '<div class="alert alert-danger">Error: No se proporcionó un ID de usuario.</div>';

        }else{
            require_once __DIR__.'/../../config/db.php';
            $id_usr=(int)$_GET['id_usr'];
            $sql = "SELECT * FROM medico WHERE id_usr = ?";
            $select_preparado=mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($select_preparado,'i',$id_usr);
            mysqli_stmt_execute($select_preparado);
            $resultado=mysqli_stmt_get_result($select_preparado);
            if(!$resultado||mysqli_num_rows($resultado)!=1){
                echo '<div class="alert alert-danger">Error: El médico no existe o no se encontró.</div>';

            }
            else{
                $fila_db=mysqli_fetch_assoc($resultado);
                mysqli_stmt_close($select_preparado);
                //llenar el formulario
                ?>
                <form id="productsForm" class="need-caliadtion border rounded p-3 bg-white" novalidate>
                    <input type="hidden" name="id_usr" value="<?= $fila_db['id_usr'] ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="form-label">Nombre del medico</label>
                    <input type="text"id="nom_usr" name="nom_usr" class="form-control" placeholder="Ej. Juan Alfredo" minlength="2" maxlength="100" value="<?=htmlspecialchars($fila_db['nom_usr'])?>" required>
                    <div class="valid-feedback">Nombre valido.</div>
                    <div class="invalid-feedback">Nombre no valido usa 2-100 caracteres.</div>
                </div>
                <div class="col-md-3">
                <label class="form-label">Telefono</label>
                <input type="text" name="numero" id="numero" class="form-control"  placeholder="El. 422" value="<?=htmlspecialchars($fila_db['numero'])?>" required>
                <div class="valid-feedback">numero valido.</div>
                    <div class="invalid-feedback">Ingresa un numero valido.</div>

            </div>
            </div>
            <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Imagen (URL)</label>
            <input id="img" name="img" type="url" class="form-control" placeholder="https://sitio/img/smb3.jpg" minlength="1" maxlength="500" pattern="^https?://\S+\.(jpg|jpej|png)$" value="<?=htmlspecialchars($fila_db['img'])?>" required>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Proporciona una ruta URL correcto de maximo 500 caracteres.</div>
                </div>
            <div class="col-md-3">
                <label class="form-label">Estatus</label>
                <select name="estatus" id="estatus" class="form-select" required>
                    <option value="1" <?= $fila_db['estatus'] ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= !$fila_db['estatus'] ? 'selected' : '' ?>>Inactivo</option>
                </select>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Selecciona un estatus.</div>
            </div>
            </div>
            
                

            <div class="col-12">
                <label class="form-label">Direccion</label>
                <textarea name="dir" id="dir" rows="4" class="form-control" minlenght="10" maxlength="50" placeholder="Describe el producto..." required><?=htmlspecialchars($fila_db['dir_usr'])?></textarea>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Escribe entre 10 y 50 caracteres.</div>
                <div class="col-12 mt-3">
                    <button class="btn btn-primary" type="submit" name="accion" value="editar">Modificar</button>
                    
                </div>

            </div>
            </form>
                <?php
            }
        }

             ?>
                    
                </div>

            </div>
            </form>
    
        </div>
    </main>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
        var form=document.getElementById('productsForm');
        var controls=form.querySelectorAll('.form-control, .form-select');

        // envio(solo demo: no navega; muestra mensaje si todo es valido)
        form.addEventListener('submit',function(e){
            
            if (!form.checkValidity()){
                e.preventDefault();
                e.stopPropagation();
            }else{
                form.action='../../lib/gestor_medico.php';
                form.method='post';
            }
            form.classList.add('was-validated');
        });
    </script>
</body>

</html>