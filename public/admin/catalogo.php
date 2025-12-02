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
    <title>Panel Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- CONTENIDO -->
    <main class="d-flex">
        <?php require_once __DIR__. '/menu-1.php' ?>
        <div id="admin-main" class="p-4">
            <h1>Catalogo de Productos/servicios</h1>
            <a href=./alta_productos.php class="btn btn-primary">Agregar productos</a>
            <table class="table table-sriped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre producto</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th class="w-25">Imagen</th>
                    <th>Estatus</th>
                    <th>Stock</th>
                    <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once __DIR__ .'/../../lib/gestor_producto.php';
                    $productos=mostrar_productos();
                    foreach($productos as $fila_tabla){
                    
                    ?>
                    <tr>
                    <td><?= $fila_tabla['id_prod'] ?></td>
                    <td><?= $fila_tabla['nom_prod'] ?></td>
                    <td><?= $fila_tabla['desc'] ?></td>
                    <td><?= $fila_tabla['prec'] ?></td>
                    <td><img class="img-fluid" src=" <?= $fila_tabla['img'] ?>" alt=""></td>
                    <td><?=$mensaje=$fila_tabla['estatus']?"Activo":"Inactivo"; ?></td>
                    <td><?= $fila_tabla['stock'] ?></td>
                    <td> <a href="editar_productos.php?id_prod=<?= $fila_tabla['id_prod']?>" class="btn btn-warning mb-3"> Editar</a>
                    <form action="../../lib/gestor_producto.php" method="post">
                        <input type="hidden" name="id_prod" value="<?= $fila_tabla['id_prod'] ?>">
                        <button class="btn btn-danger" type="submit" name="accion" value="eliminar">Eliminar</button>

                    </form>
                        </tr>
                    
                    <?php 
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>

    </main>
</body>

</html>