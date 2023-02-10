<?php
    if(
        $_POST['Nombre'] &&
        $_POST['Descripcion'] &&
        $_POST['cant_max'] &&
        $_POST['Salario'] &&
        $_POST['departamento'] &&
        $_POST['ciudad'] &&
        $_POST['fech_publi'] &&
        $_POST['fech_venci'] &&
        $_POST['sector'] &&
        $_POST['Experencia'] 
    )

    {
        $Nombre=$_POST['Nombre'];
        $Descripcion=$_POST['Descripcion'];
        $cant_max=$_POST['cant_max'];
        $Salario=$_POST['Salario'];
        $departamento=$_POST['departamento'];
        $ciudad=$_POST['ciudad'];
        $fech_publi=$_POST['fech_publi'];
        $fech_venci=$_POST['fech_venci'];
        $sector=$_POST['sector'];
        $Experencia=$_POST['Experencia'];
        
        require_once './../../../src/consultas.php';
        $consultas= new consultas(); 

        $consultas->Insertar_Oferta($Nombre,$Descripcion,$cant_max,$Salario,$departamento,$ciudad,$fech_publi,$fech_venci,$sector,$Experencia);

        $mensaje['success']=true;

        echo json_encode($mensaje);

    }
?>