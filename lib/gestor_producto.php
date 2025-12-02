<?php
@session_start();

require_once __DIR__.'/../config/db.php';
function mostrar_productos(){
    global $conn;
    $sql="SELECT * FROM catalogo";
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

function agregar_producto($nom_prod, $desc, $prec, $img, $stock, $estatus){
    global $conn;
    $sql="INSERT INTO catalogo (nom_prod, `desc`, prec, img, estatus, stock) VALUES (?,?,?,?,?,?)";
    $insert_preparado=mysqli_prepare($conn, $sql);
    
    if(!$insert_preparado){
        //retun false 
        return [
            'estatus'=> 'error',
            'mensaje'=> 'error en la ejecucion en la base de datos'
        ];

    }

    mysqli_stmt_bind_param($insert_preparado, 'ssdsii',$nom_prod, $desc, $prec, $img, $stock, $estatus);
    $query_ok=mysqli_stmt_execute($insert_preparado); //True o False 

    $rows_ok =mysqli_affected_rows($conn); //0>1
    mysqli_stmt_close($insert_preparado);
    if($query_ok && $rows_ok > 0){
        return [
            'estatus'=>'msg',
            'mensaje'=>'producto agregado correctamente'
        ];

    }else{
        return[
        'estatus'=>'error',
        'mensaje'=>'Error al insertar el producto. no hubo cambios'
        ];

    }

}
// $resultado=agregar_producto('Curso C++', 'curso expres para aprender c', '400', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/ISO_C%2B%2B_Logo.svg/1067px-ISO_C%2B%2B_Logo.svg.png', '40', '1');
// print_r($resultado);

function eliminar_producto($id_prod){
    global $conn;
    $sql="DELETE FROM catalogo WHERE id_prod=?";
    $delete_preparado=mysqli_prepare($conn, $sql);


        if(!$delete_preparado){
        //retun false 
        return [
            'estatus'=> 'error',
            'mensaje'=> 'error en la ejecucion en la base de datos'
        ];

    }
    mysqli_stmt_bind_param($delete_preparado, 'i', $id_prod);
    $query_ok=mysqli_stmt_execute($delete_preparado); //True o False 

    $rows_ok =mysqli_affected_rows($conn); //0>1
    mysqli_stmt_close($delete_preparado);
    if($query_ok && $rows_ok > 0){
        return [
            'estatus'=>'msg',
            'mensaje'=>'producto borrado correctamente'
        ];

    }else{
        return[
        'estatus'=>'error',
        'mensaje'=>'Error al borrar el producto. no hubo cambios'
        ];

    }

}

function modificar_producto($nom_prod, $desc, $prec, $img, $estatus, $stock, $id){
    global $conn;
    $sql="UPDATE catalogo SET nom_prod=?, `desc`=?, prec=?, img=?, estatus=?, stock=? WHERE id_prod=?";
    $insert_preparado=mysqli_prepare($conn, $sql);
    
    if(!$insert_preparado){
        //retun false 
        return [
            'estatus'=> 'error',
            'mensaje'=> 'error en la ejecucion en la base de datos'
        ];

    }

    mysqli_stmt_bind_param($insert_preparado, 'ssdsiii',$nom_prod, $desc, $prec, $img, $stock, $estatus, $id);
    $query_ok=mysqli_stmt_execute($insert_preparado); //True o False 

    $rows_ok =mysqli_affected_rows($conn); //0>1
    mysqli_stmt_close($insert_preparado);
    if($query_ok && $rows_ok > 0){
        return [
            'estatus'=>'msg',
            'mensaje'=>'producto modificado correctamente'
        ];

    }else{
        return[
        'estatus'=>'error',
        'mensaje'=>'Error al insertar el producto. no hubo cambios'
        ];

    }

}

    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['accion'])){
            $accion=$_POST['accion'];

            switch($accion){
                case 'agregar':
                    if(isset($_POST['nom_prod'],$_POST['desc'],$_POST['prec'],$_POST['img'],$_POST['stock'])){
                        $nom_prod=trim($_POST['nom_prod']);
                        $desc=trim($_POST['desc']);
                        $prec=(float)$_POST['prec'];
                        $img=trim($_POST['img']);
                        $stock=(int)$_POST['stock'];
                        $estatus=1;


                        $resultado=agregar_producto($nom_prod,$desc,$prec, $img, $stock, $estatus);
                        header('Location: ../public/admin/alta_productos.php?msg=' .urlencode($resultado['mensaje']));
                        exit;


                    }else{
                        header('Location: ../public/admin/alta_productos.php?error=' .urlencode('Hubo un error en el formulario, favor de revisar los campos'));
                        exit;
                    }
                    break;
                case 'editar':
                    if(isset($_POST['nom_prod'],$_POST['desc'],$_POST['prec'],$_POST['img'],$_POST['stock'],$_POST['id_prod'],$_POST['estatus'])){
                        $id_prod=(int)$_POST['id_prod'];
                        $nom_prod=trim($_POST['nom_prod']);
                        $desc=trim($_POST['desc']);
                        $prec=(float)$_POST['prec'];
                        $img=trim($_POST['img']);
                        $stock=(int)$_POST['stock'];
                        $estatus=(int)$_POST['estatus'];
                        $resultado=modificar_producto($nom_prod,$desc,$prec, $img, $stock, $estatus, $id_prod);
                        echo"
                    <script>
                    alert('".$resultado['mensaje']."');
                    window.location.href='../public/admin/catalogo.php';
                    </script>
                    ";  

                    }else{
                        echo"
                    <script>
                    alert('Algun dato  no proporcionado, intente de nuevo ".$id_prod['id_prod'], $nom_prod['nom_prod'], $desc['desc'], $prec['prec'], $stock['stock'], $estatus['stock']."');
                    window.location.href='../public/admin/editar_productos.php';
                    </script>
                    ";
                        
                    //    header('Location: ../public/admin/editar_productos.php?error=' .urlencode('Algun dato  no proporcionado, intente de nuevo'));
                    }
                    break;
                case 'eliminar':
                    if(isset($_POST['id_prod'])){
                        $id_prod=(int)$_POST['id_prod'];
                        $resultado=eliminar_producto($id_prod);
                    echo"
                    <script>
                    alert('".$resultado['mensaje']."');
                    window.location.href='../public/admin/catalogo.php';
                    </script>
                    ";   
                        

                    }
                    else{
                        header('Location: ../public/admin/catalogo.php?error=' .urlencode('ID del producto no proporcionado, intente de nuevo'));
                    }
                        exit;
                    break;
                default:

            }

        }else{
            echo"
            <script>
            alert('Accion no detectada intente de nuevo');
            window.location.href='../public/admin/catalogo.php';
            </script>
            ";
            exit;
        }

    }


?>