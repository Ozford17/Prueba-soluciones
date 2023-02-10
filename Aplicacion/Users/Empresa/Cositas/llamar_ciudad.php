<?php
    header("Content-type: text/html; charset=utf8");
    if($_POST['departamento'])
    {
        $depa=$_POST['departamento'];
        require_once './../../../src/consultas.php';
        $consultas= new consultas();
        
        $resp=$consultas->List_Ciudad($depa);
        $dato= array();
        while($fil=mysqli_fetch_assoc($resp)){
            array_push($dato,$fil);
        }
        echo json_encode($dato);
    }
?>