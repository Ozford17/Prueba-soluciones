<?php
    if($_POST['oferta'])
    {
        $mensaje['success']=false;
        require_once './../../../src/consultas.php';
        $consultas= new consultas();
        session_start();

        $oferta=$_POST['oferta'];
        $cant_postu=0;
        $resp=$consultas->cantidad_postulaciones($oferta);
        $fila=mysqli_fetch_assoc($resp);
        
        $cant_postu=$fila['cantidad'];
        
        $res=$consultas->buscar_oferta($oferta);
        $fil=mysqli_fetch_assoc($res);
        
        if($cant_postu>$fil['cantidad_max'])
        {
            $consultas->postular_oferta($oferta);
        }

        $mensaje['success']=true;
        

        
        echo json_encode($mensaje);
    }
?>