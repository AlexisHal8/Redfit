<?php
@session_start();

require_once __DIR__.'/../config/db.php';
function mostrar_comentarios(){
    global $conn;
    $sql="SELECT * FROM comentarios";
    $select_preparado= mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($select_preparado);

    // solo es un select
    $resultado=mysqli_stmt_get_result($select_preparado);
    $productos=array();

    while($fila_db=mysqli_fetch_assoc($resultado)){
        $productos[]=$fila_db;

    }
    mysqli_stmt_close($select_preparado);
    return $productos;
    
}
function eliminar_comentario($id_com){
    global $conn;
    $sql="DELETE FROM comentarios WHERE id_com=?";
    $delete_preparado = mysqli_prepare($conn, $sql);

    if(!$delete_preparado){
        return ['estatus'=> 'error', 'mensaje'=> 'Error al preparar la consulta'];
    }
    
    mysqli_stmt_bind_param($delete_preparado, 'i', $id_com);
    $query_ok = mysqli_stmt_execute($delete_preparado); 
    $rows_ok = mysqli_affected_rows($conn);
    mysqli_stmt_close($delete_preparado);
    
    if($query_ok && $rows_ok > 0){
        return ['estatus'=>'msg', 'mensaje'=>'Comentario eliminado correctamente'];
    }else{
        return ['estatus'=>'error', 'mensaje'=>'Error al borrar. No hubo cambios'];
    }
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['accion']) && $_POST['accion'] === 'eliminar'){
        if(isset($_POST['id_com'])){
            $id_com = (int)$_POST['id_com'];
            $resultado = eliminar_comentario($id_com);
            echo "<script>
                alert('".$resultado['mensaje']."');
                window.location.href='../public/admin/comentarios.php';
            </script>";   
        }
    }
}