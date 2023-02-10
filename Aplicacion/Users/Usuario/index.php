<?php
    session_start();
    
    require_once "../../src/consultas.php";
	$consulta = new consultas();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario: <?php if($_SESSION['nombre']){ echo $_SESSION['nombre'];}?></title>
    <script type="text/javascript" src="../../src/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../Users/Usuario/Cositas/ajax/menu.js"></script>
    <link rel="stylesheet" href="../../css/admin1.css">
    <link rel="stylesheet" href="../../Users/Usuario/Cositas/Menu.css">
    <link rel="stylesheet" href="../../src/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .izquierda{
            float: left;
            margin-bottom: 0.5vw;
        }

        
    </style>
</head>
<body>
<div class="lado">
        <div class="perfil">
            <img src="../../images/Logo.png" alt="Logo">
        </div>
        <div class="men">
            <?php  require("../../Users/Usuario/Cositas/Menu.php")?>
        </div>
    </div>
    <div class="centro">
        <div class="barra">
            <span><?=$_SESSION["nombre"]?></span>
            <div class="cerrar">Cerrar Sesión</div>
        </div>
        <div class="princ">
            <?php 
                $resp=$consulta->Busqueda_datos_usuario($_SESSION['tipo_doc'],$_SESSION['documento']);
                if($fila=mysqli_fetch_assoc($resp))
                {

                
            ?>
            <div class="row">
                <div class="col-md-11 mx-auto" >
                <div class="izquierda  col-md-4 form-group"><label >codigo: </label><br><?=$fila['codigo']?></div>
                <div class="izquierda  col-md-4 form-group"><label >Tipo documento: </label><br><?=$fila['tipo_doc']?></div>
                <div class="izquierda  col-md-4 form-group"><label >numero: </label><br><?=$fila['numero_doc']?></div>
                <div class="izquierda  col-md-4 form-group"><label >nombre: </label><br><?=$fila['nombre']?></div>
                <div class="izquierda  col-md-4 form-group"><label >apellido: </label><br><?=$fila['apellido']?></div>
                <div class="izquierda  col-md-4 form-group"><label >fecha de nacimiento: </label><br><?=$fila['fecha_nacimiento']?></div>
                <div class="izquierda  col-md-4 form-group"><label >ciudad: </label><br><?=$fila['ciudad']?></div>
                <div class="izquierda  col-md-4 form-group"><label >direccion: </label><br><?=$fila['direccion']?></div>
                <div class="izquierda  col-md-4 form-group"><label >telefono: </label><br><?=$fila['telefono']?></div>
                <div class="izquierda  col-md-4 form-group"><label >correo: </label><br><?=$fila['correo']?></div>
                <div class="izquierda  col-md-4 form-group"><label >curriculum: </label><br><?=$fila['curriculum']?></div>
                <div class="izquierda  col-md-4 form-group"><label >activo: </label><br><?=$fila['activo']?></div>
                <div class="izquierda  col-md-4 form-group"><label >fecha de creación: </label><br><?=$fila['fecha_creacion']?></div>

                    
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</body>
</html>