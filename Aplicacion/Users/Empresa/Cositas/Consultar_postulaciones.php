<?php
if($_POST['oferta'])
{
    $oferta=$_POST['oferta'];
    require_once './../../../src/consultas.php';
    $consultas= new consultas();
    
    $mensaje=array();
    $datos=array();
    
    $resp=$consultas->listar_postulaciones($oferta);
    if(mysqli_num_rows($resp)>0){
        $mensaje['success']=true;
        while($fila=mysqli_fetch_assoc($resp))
        {
            
            array_push($datos,$fila);

        }
        $mensaje['datos']=$datos;
    }
    else{
        $mensaje['success']=true;
        $mensaje['mensaje']='No hay datos';
    }

    echo json_encode($mensaje);
    

}
?>