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
    <title>Reseñas y Comentarios</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <?php require_once __DIR__. '/nav.php' ?>
    <main class="d-flex">
        <div id="admin-main" class="p-4 w-100">
            <h1>Reseñas de Clientes</h1>
            
            <table class="table table-striped mt-4 align-middle">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th class="w-25">Cliente (ID)</th> <th class="w-50">Comentario</th>
                    <th>Calificación</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once __DIR__ .'/../../lib/gestor_comentarios.php';
                    $comentarios = mostrar_comentarios();
                    foreach($comentarios as $fila){
                    ?>

                    <tr>
                        <td><?= $fila['id_com'] ?></td>
                        <td>
                            <i class="bi bi-person-circle me-2"></i> 
                            Cliente <?= $fila['id_cli'] ?>
                        </td>
                        <td><?= htmlspecialchars($fila['comentario']) ?></td>
                        <td>
                            <div class="text-warning">
                                <?php 
                                // Pintamos estrellas llenas según la calificación
                                for($i=1; $i <= 5; $i++){
                                    if($i <= $fila['calificacion']){
                                        echo '<i class="bi bi-star-fill"></i>';
                                    } else {
                                        echo '<i class="bi bi-star"></i>'; // Estrella vacía
                                    }
                                }
                                ?>
                            </div>
                        </td>
                        <td><?= date("d/m/Y h:i A", strtotime($fila['fecha'])) ?></td>
                        <td> 
                            <form action="../../lib/gestor_comentarios.php" method="post" onsubmit="return confirm('¿Estás seguro de eliminar este comentario?');">
                                <input type="hidden" name="id_com" value="<?= $fila['id_com'] ?>">
                                <button class="btn btn-danger btn-sm" type="submit" name="accion" value="eliminar">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                    <?php if(empty($comentarios)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted p-4">
                                No hay comentarios registrados aún.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>