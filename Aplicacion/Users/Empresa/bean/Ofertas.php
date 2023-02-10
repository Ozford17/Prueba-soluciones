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
        .creacion_oferta{
            margin-top: 2vw;
            border:black solid 1px;
            border-radius: 25px;
            padding: 1vw 5%;
            display: none;
        }
        .creacion_oferta form div 
        {
            float: left;
            margin-left: 5%;
        }
        .creacion_oferta form div label{
            margin: 0.5vw 0;
            text-transform: capitalize;
            
        }
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
        
        $('.abir_creacion').click(e=>{
            e.preventDefault()
            $('.creacion_oferta').css({'display':'block'});
        })
        $('.cancelar').click((e)=>{
            e.preventDefault()
            $('.creacion_oferta').css({'display':'none'});
        })
        $("#departamento").change(e=>{
            $.ajax({
                url:'./Cositas/llamar_ciudad.php',
                type:'POST',
                dataType:'JSON',
                data:{'departamento':$('#departamento').val()},
                success:res=>{
                    $("#ciudad option").remove();
                    res.forEach(e=>{
                        
                        $('#ciudad').append('<option value="'+e.codigo+'" >'+e.nombre+'</option>')
                    })
                    
                }
            })
        })
        $('#formulario').submit(()=>{
            
            $.ajax({
                url:'./Cositas/Guardar_oferta.php',
                type:'POST',
                dataType:'JSON',
                data:$('#formulario').serialize(),
                success:res=>{
                    
                    if(res.success)
                    {   
                        $('#listado_ofertas').load(location.href + " #listado_ofertas")
                        $('.creacion_oferta').css({'display':'none'});
                    }
                    
                }
            })
        })


    })
</script>
</head>
<body>
    


<div class="row">
    <div class="col-md-10 mx-auto" >
        <div class="col-md-4">
            <h2>Ofertas</h2>
        </div>
        <div class="col-md-8">
            <p>Ofertas creadas por usted</p>
            <button class="btn btn-primary abir_creacion"> Crear Oferta</button>
        </div>

        <div class="col-md-12 mx-auto creacion_oferta">
            <h4> Creación de ofertas</h4>
            <div class="row">
                <form action="javascript:enviar.focus();" id="formulario">
                
                <div class="col-md-5">
                    <label>nombre: </label>
                    <input type="text" class="form-control" name="Nombre">
                </div>
                <div class="col-md-12">
                    <label>descripción: </label><br>
                    <textarea name="Descripcion" rows="10" cols="100"></textarea>
                </div>
                <div class="col-md-5">
                    <label>cantidad maxima de postulaciones: </label>
                    <input type="number" min=0 class="form-control" name="cant_max">  
                </div>
                <div class="col-md-5">
                    <label>salario: </label>
                    <input type="number" min=0 class="form-control" name="Salario">  
                </div>
                <div class="col-md-5">
                    <label>departamento: </label>
                    <select name="departamento" id="departamento" class="form-control">
                        <option value="0" selected="selected">Seleccione</option>
                        <?php
                            $resp=$consultas->List_departamento();
                            while($fil=mysqli_fetch_assoc($resp))
                            {?>
                                <option value="<?=$fil['codigo']?>"><?=$fil['nombre']?></option>
                            <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label>ciudad: </label>
                    <select name="ciudad" id="ciudad" class="form-control">
                        <option value="0" selected="selected">Seleccione</option>
                        
                    </select>
                </div>
                
                <div class="col-md-5">
                    <label>fecha_publicacion: </label>
                    <input type="date"  class="form-control" name="fech_publi">  
                </div>
                <div class="col-md-5">
                    <label>fecha_vencimiento: </label>
                    <input type="date"  class="form-control" name="fech_venci">  
                </div>
                <div class="col-md-5">
                    <label>sector: </label>
                    <select name="sector" id="sector" class="form-control">
                        <option value="0" selected="selected">Seleccione</option>
                        <?php
                            $resp=$consultas->List_sector();
                            while($fil=mysqli_fetch_assoc($resp))
                            {?>
                                <option value="<?=$fil['codigo']?>"><?=$fil['descripcion']?></option>
                            <?php
                            }
                        ?>
                        
                    </select>
                </div>
                <div class="col-md-5">
                    <label>experencia en años: </label>
                    <input type="number" min="0" max="10"  class="form-control" name="Experencia">  
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 mx-auto mt-3">
                        <input type="submit"  class=" btn btn-primary " name="enviar" id="enviar" value="Registrar">  
                        <button  class=" btn btn-danger cancelar">Cancelar</button>  
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="col-md-10 mx-auto mt-4">
            <h4>Listado de ofertas.</h4>
           
                <?php
                    $resp=$consultas->List_ofertas($_SESSION['codigo']);
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