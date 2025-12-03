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
    <title>Panel Admin - Objetivos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <?php require_once __DIR__. '/nav.php' ?>
    <main class="d-flex">
        <div id="admin-main" class="p-4 w-100">
            <h1>Listado de Objetivos</h1>
            <a href="./alta_objetivos.php" class="btn btn-primary"><i class="bi bi-arrow-return-left me-2 fs-5"></i> Agregar Nuevo</a>
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Objetivo</th>
                    <th class="w-50">Descripción</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once __DIR__ .'/../../lib/gestor_objetivos.php';
                    $objetivos = mostrar_objetivos();
                    foreach($objetivos as $fila){
                    ?>
                    <tr>
                        <td><?= $fila['id_obj'] ?></td>
                        <td><?= $fila['nom_obj'] ?></td>
                        <td><?= $fila['desc_obj'] ?></td>
                        <td><?= $fila['estatus'] ? "Activo" : "Inactivo"; ?></td>
                        <td> 
                            <a href="editar_objetivos.php?id_obj=<?= $fila['id_obj']?>" class="btn btn-warning mb-1"> Editar</a>
                            <form action="../../lib/gestor_objetivos.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="id_obj" value="<?= $fila['id_obj'] ?>">
                                <button class="btn btn-danger" type="submit" name="accion" value="eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>