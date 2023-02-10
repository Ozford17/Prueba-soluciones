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
        .datos{
            margin-top: 1vw;
        }
        #formulario_select{
            margin:1vw 0;
        }
        #formulario_select input{
            margin-top: 1vw;
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
                        console.log('res')
                        console.log(res)
                        if(res.success)
                            if(res.mensaje)
                            {
                                $('.vacio').css({'display':'block'})
                                $('.datos').css({'display':'none'})
                                
                            }
                            else{
                                $('.vacio').css({'display':'none'})
                                $('.datos').css({'display':'block'})

                                res.datos.forEach(e=>{
                                    $('.cuerpo_table').append(
                                        '<tr>'+
                                            '<td>'+e.fecha_creacion+'</td>'+
                                            '<td>'+e.numero_doc+'</td>'+
                                            '<td>'+e.nombre+'</td>'+
                                            '<td>'+e.nombre_c+'</td>'+
                                            '<td>'+e.telefono+'</td>'+
                                            '<td>'+e.curriculum+'</td>'+
                                            '<td>'+e.nombreOfe+'</td>'+
                                            
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
            <label> Listado de personas que se han postulado a las ofertas </label>
            <div class="row">
                <form action="javascript:Enviar.focus();" id="formulario_select">
                    <div class="col-md-4">
                        <label for="">Oferta</label>
                        <select name="oferta" id="oferta">
                            <option value="0" selected="selected">Seleccione</option>
                            <?php
                                $resp=$consultas->List_ofertas($_SESSION['codigo']);
                                while($fila=mysqli_fetch_assoc($resp))
                                {?>
                                    <option value="<?=$fila['codigo']?>"><?=$fila['codigo']?>-<?=$fila['nombre']?></option>
                                <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn btn-primary" value="Enviar" id="Enviar" name="Enviar">
                    </div>
                </form>
            </div>
            <div class="row" class="mostrar_datos">
                <div class="col-md-5 vacio">
                    <p>No hay datos </p>
                </div>
                <div class="col-md-10 datos">
                    <table  class=" col-md-12 table">
                        <thead>
                            <tr>
                                <th>Fecha postulación</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Telefono</th>
                                <th>Hoja de vida</th>
                                <th>Estado</th>
                                

                            </tr>
                        </thead>
                        <tbody class="cuerpo_table">
                            
                            
                        </tbody>
                    </table>
            
                </div>
                
            </div>
        
        </div>
    </div>
</body>
</html>