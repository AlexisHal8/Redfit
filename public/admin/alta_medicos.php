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
    <title>Agregar Medico</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <!-- CONTENIDO -->
     <?php require_once __DIR__. '/nav.php' ?>
    <main class="d-flex">
        <div id="admin-main" class="p-4">
            <h1>Agregar Medico</h1>
            <?php if ($mensaje) {?>
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <?= htmlspecialchars($mensaje) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"> </button>


                </div>
            <?php } ?>
            <?php if ($error) {?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <?= htmlspecialchars($mensaje) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"> </button>


                </div>
            <?php } ?>
                <div class="">
            <form id="productsForm" class="need-caliadtion border rounded p-3 bg-white"  novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="form-label">Nombre del medico</label>
                    <input type="text"id="nom_med" name="nom_med" class="form-control" placeholder="Ej. Santiago Guillen" minlength="2" maxlength="255" required>
                    <div class="valid-feedback">Nombre valido.</div>
                    <div class="invalid-feedback">Nombre no valido usa 2-255 caracteres.</div>
                </div>
                <div class="col-md-3">
                <label class="form-label">E-mail</label>
                <input type="text" name="mail" id="mail" class="form-control" placeholder="Ej. usuario@gmail.com" minlength="8" maxlength="20" required>
                <div class="valid-feedback">email valido.</div>
                    <div class="invalid-feedback">Ingresa un email mayor a 8 digitos y menor a 20.</div>

            </div>
            <div class="col-md-3">
                <label class="form-label">Contraseña</label>
                <input type="text" name="pass" id="pass" class="form-control"  placeholder="El. 121324" minlength="8" maxlength="20" required>
                <div class="valid-feedback">contraseña valido.</div>
                    <div class="invalid-feedback">Ingresa una contraseña entre 8 y 20</div>

            </div>
            </div>
            <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Imagen (URL)</label>
            <input id="img" name="img" type="url" class="form-control" placeholder="https://sitio/img/smb3.jpg" minlength="1" maxlength="500" pattern="^https?://\S+\.(jpg|jpej|png)$" required>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Proporciona una ruta URL correcto de maximo 500 caracteres.</div>

            </div>
            <div class="col-md-3">
                <label class="form-label">Numero</label>
            <input id="num" name="num" type="text" class="form-control" placeholder="422.." minlength="1" maxlength="13"  required>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Proporciona una numero de 13 digitos.</div>

            </div>
            <div class="col-md-3">
                <label class="form-label">Cedula</label>
            <input id="cedula" name="cedula" type="text" class="form-control" placeholder="422.." minlength="1" maxlength="13"  required>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Proporciona una cedula de 13 digitos.</div>

            </div>
            </div>
            <div class="col-12 mt-3">
                <label class="form-label">Direccion</label>
                <textarea name="dir" id="dir" rows="4" class="form-control" minlenght="10" maxlength="100" placeholder="Escribe la dirreccion..." required></textarea>
                <div class="valid-feedback">Ok.</div>
                <div class="invalid-feedback">Escribe entre 20 y 500 caracteres.</div>
                <div class="col-12 mt-4">
                    <button class="btn btn-primary" type="submit" name="accion" value="agregar">Agregar</button>
                    <a href="medicos.php" class="btn btn-dark float-end">Consultar Medicos</a>
                    
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