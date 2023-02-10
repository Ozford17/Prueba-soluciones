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
    <title>Empresa: <?php if($_SESSION['nombre']){ echo $_SESSION['nombre'];}?></title>
    <script type="text/javascript" src="../../src/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../Users/Empresa/Cositas/ajax/menu.js"></script>
    <link rel="stylesheet" href="../../css/admin1.css">
    <link rel="stylesheet" href="../../Users/Empresa/Cositas/Menu.css">
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
            <?php  require("../../Users/Empresa/Cositas/Menu.php")?>
        </div>
    </div>
    <div class="centro">
        <div class="barra">
            <span><?=$_SESSION["nombre"]?></span>
            <div class="cerrar">Cerrar Sesión</div>
        </div>
        <div class="princ">
            <?php 
                $resp=$consulta->Busqueda_datos_empresa($_SESSION['documento']);
                if($fila=mysqli_fetch_assoc($resp))
                {

                
            ?>
            <div class="row">
                <div class="col-md-11 mx-auto" >
                    <div class="izquierda  col-md-4 form-group"><label > Nit: </label> <?=$fila['nit']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Digito: </label> <?=$fila['digito']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Nombre: </label> <?=$fila['nombre']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Direccion: </label> <?=$fila['direccion']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Ciudad: </label> <?=$fila['nombreciudad']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Representante: </label> <?=$fila['representante']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Telefono: </label> <?=$fila['telefono']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Correo: </label> <?=$fila['correo']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Cantidad de empleados: </label><?=$fila['cant_emple']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Cantidad max de ofertas:</label> <?=$fila['cant_max_ofertas']?>	</div>
                    <div class="izquierda  col-md-4 form-group"><label > Fecha de creación:</label> <?=$fila['fecha_creacion']?>	</div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</body>
</html>