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
</head>

<body>
    <!-- CONTENIDO -->
    <main class="d-flex">
        <?php require_once __DIR__. '/menu-1.php' ?>
        <div id="admin-main" class="p-4">
            
            
    <?php 
        if(!isset($_GET['id_prod'])){

        }else{
            require_once __DIR__.'/../../config/db.php';
            $id_prod=(int)$_GET['id_prod'];
            $sql = "SELECT * FROM catalogo WHERE id_prod = ?";
            $select_preparado=mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($select_preparado,'i',$id_prod);
            mysqli_stmt_execute($select_preparado);
            $resultado=mysqli_stmt_get_result($select_preparado);
            if(!$resultado||mysqli_num_rows($resultado)!=1){

            }
            else{
                $fila_db=mysqli_fetch_assoc($resultado);
                mysqli_stmt_close($select_preparado);
                //llenar el formulario
                ?>
                <form id="productsForm" class="need-caliadtion border rounded p-3 bg-white" novalidate>
                    <input type="hidden" name="id_prod" value="<?= $fila_db['id_prod'] ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="form-label">Nombre del producto</label>
                    <input type="text"id="nom_prod" name="nom_prod" class="form-control" placeholder="Ej. Curso de Front End" minlength="2" maxlength="255" value="<?=htmlspecialchars($fila_db['nom_prod'])?>" required>
                    <div class="valid-feedback">Nombre valido.</div>
                    <div class="invalid-feedback">Nombre no valido usa 2-255 caracteres.</div>
                </div>
                <div class="col-md-3">
                <label class="form-label">Precio</label>
                <input type="number" name="prec" id="prec" class="form-control" min="1" step="0.01" placeholder="El. 499.00" value="<?=htmlspecialchars($fila_db['prec'])?>" required>
                <div class="valid-feedback">Precio valido.</div>
                    <div class="invalid-feedback">Ingresa un precio valido (mayor a 0, con 2 decimales).</div>

            </div>
            <div class="col-md-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" step="1" placeholder="El. 25" value="<?=htmlspecialchars($fila_db['stock'])?>" required>
                <div class="valid-feedback">Stock valido.</div>
                    <div class="invalid-feedback">Ingresa un stock mayor o igual a cero.</div>

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
                <label class="form-label">Descripcion</label>
                <textarea name="desc" id="desc" rows="4" class="form-control" minlenght="20" maxlength="500" placeholder="Describe el producto..." required><?=htmlspecialchars($fila_db['desc'])?></textarea>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Escribe entre 20 y 500 caracteres.</div>
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
                form.action='../../lib/gestor_producto.php';
                form.method='post';
            }
            form.classList.add('was-validated');
        });
    </script>
</body>

</html>