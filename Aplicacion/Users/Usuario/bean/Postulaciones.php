<?php
    session_start();
    require_once './../../../src/consultas.php';
    $consultas= new consultas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #listado_ofertas{
            position: relative;
            
            margin: 1vw 0;
            float: left;
            padding: 0.5vw 5%;
            border-radius:10px;
            background: #c5d8f7;
        }
        #listado_ofertas div{
            float:left;
        }
        
        #listado_ofertas div button{
            margin-top: 0.5vw;
        }
        #listado_ofertas div label{
            text-transform: capitalize;
            margin-top: 0.5vw;
            margin-right: 1.5%;
        }
        #listado_ofertas div label:after{
            content:'';
            display: block;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.vacio').css({'display':'none'})
            $('.datos').css({'display':'none'})
            
            $('#formulario_select').submit(()=>{
                $.ajax({
                    url:'./Cositas/Consultar_postulaciones.php',
                    type:'POST',
                    dataType:'JSON',
                    data:$('#formulario_select').serialize(),
                    success:res=>{
                        if(res.success)
                            if(res.mensaje)
                            {
                                $('.vacio').css({'display':'block'})
                                $('.datos').css({'display':'none'})
                                
                            }
                            else{
                                $('.vacio').css({'display':'none'})
                                $('.datos').css({'display':'block'})

                                $res.datos.foreach(e=>{
                                    $('.cuerpo_table').append(
                                        '<tr>'+
                                            '<td>'+e.fecha_creacion+'</td>'+
                                            '<td>'+e.cedula+'</td>'+
                                            '<td>'+e.nombre+'</td>'+
                                            '<td>'+e.ciudad+'</td>'+
                                            '<td>'+e.telefono+'</td>'+
                                            '<td>'+e.curriculum+'</td>'+
                                            '<td>'+e.estadoPost+'</td>'+
                                        '</tr>'
                                    )
                                })
                                
                            }


                    }
                })
            })
        })
    </script>
</head>
<body>
    <div class="com md-12">
        <div class="col-md-10 mx-auto">
            <h2>Postulaciones</h2>
            <label> Listado de personas que se han postualdo a las ofertas </label>
            <div class="row">
                <div class="col-md-10 mx-auto mt-4">
            
            
                <?php
                    $resp=$consultas->List_Postulaciones_persona();
                    if(mysqli_num_rows($resp)>0)
                    {
                        while($fila=mysqli_fetch_assoc($resp))
                        {?>
                        <div class="col-md-12" id="listado_ofertas">
                            <div class="col-md-12"><label>codigo: </label><?=$fila['codigo']?></div>
                            <div class="col-md-12"><label>nombre: </label><?=$fila['nombre']?></div>
                            <div class="col-md-10 descrip"><label>descripcion: </label><br><?=$fila['descripcion']?></div>
                            <div class="col-md-6"><label>cantidad_max: </label><br><?=$fila['cantidad_max']?></div>
                            <div class="col-md-6"><label>salario: </label><br><?=$fila['salario']?></div>
                            <div class="col-md-6"><label>ciudad: </label><br><?=$fila['ciudad']?></div>
                            <div class="col-md-6"><label>fecha_creacion: </label><br><?=$fila['fecha_creacion']?></div>
                            <div class="col-md-6"><label>fecha_publicacion: </label><br><?=$fila['fecha_publicacion']?></div>
                            <div class="col-md-6"><label>fecha_vencimiento: </label><br><?=$fila['fecha_vencimiento']?></div>
                            <div class="col-md-6"><label>sector: </label><br><?=$fila['sector1']?></div>
                            <div class="col-md-6"><label>experencia : </label><br><?=$fila['experencia']?> Años</div>
                            <div class="col-md-6"><label>Estado postulación : </label><br><?=$fila['nomEstado']?> </div>
                            <div class="col-md-6"><label>fecha Postulación : </label><br><?=$fila['fecha_postu']?> </div>
                           

                            

                            
                        </div>    
                        <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>