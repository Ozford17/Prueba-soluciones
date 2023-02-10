<?php

require_once "Conexion.php";
  class consultas extends conexionBD{
    /*==============================================================================================================
      :::::::::::::::::::::::::::::UTILIDADES::::::::::::::::::::
    ===============================================================================================================*/
    /*=============================================================================================================
                Busqueda de usuario  (inicio de session)
    ===============================================================================================================*/
    public function verificarUsuario($email,$password){
      $sql="SELECT * 
            FROM  usuario 
            WHERE usuario='$email' AND contra='$password' and estado=1;";
      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }
   

    /*=============================================================================================================
      Busqueda de usuario con empresa
    ===============================================================================================================*/
    public function BuscarEmpresa_usuario($correo, $usuario){
      $sql="SELECT e.*,c.nombre as nombreciudad
            FROM usuario u 
              inner join empresas e on u.empresa=e.codigo 
              inner join ciudad c on e.ciudad=c.codigo
            where u.empresa=$correo and u.usuario='$usuario'";
      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      Busqueda de usuario con persona
    ===============================================================================================================*/
    public function BuscarPersona_usuario($correo,$usuario){
      $sql="SELECT p.*, c.nombre as nombreciudad
            FROM usuario u 
              inner join persona p on u.persona=p.codigo
              inner join ciudad c on p.ciudad=c.codigo
            where u.persona=$correo and u.usuario='$usuario'";
      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      Busqueda datos de la empresa
    ===============================================================================================================*/
    public function Busqueda_datos_empresa($nit){
      $sql="SELECT e.*, c.nombre as nombreciudad
            FROM empresas e 
              inner join ciudad c on e.ciudad=c.codigo
            where e.nit='$nit'";
      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      Busqueda datos del usuario
    ===============================================================================================================*/
    public function Busqueda_datos_usuario($tipo,$docuemto){
      $sql="SELECT e.*, c.nombre as nombreciudad , td.descripcion as nombretipo
            FROM persona e 
              inner join tipo_doc td on e.tipo_doc=td.codigo 
              inner join ciudad c on e.ciudad=c.codigo
            where e.numero_doc='$docuemto' and e.tipo_doc=$tipo";
      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }


    /*=============================================================================================================
      Busqueda ofertas de la empresa
    ===============================================================================================================*/
    public function List_ofertas($codigo){
      $sql="SELECT of.*, se.descripcion as sector1
        FROM empresas e 
          inner join usuario us on us.empresa=e.codigo
          inner join ofertas of on e.codigo=of.empresa 
          inner join sector se on of.sector=se.codigo
        where us.codigo=$codigo";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }


    /*=============================================================================================================
      Lista de departamentos
    ===============================================================================================================*/
    public function List_departamento(){
      $sql="SELECT codigo, nombre
        FROM departamento ";
          

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      Lista de ciudades
    ===============================================================================================================*/
    public function List_Ciudad($departamento){
      $sql="SELECT  codigo, nombre
        FROM ciudad
        where departamento=$departamento";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      Lista de sectores
    ===============================================================================================================*/
    public function List_sector(){
      $sql="SELECT  codigo, descripcion
        FROM sector
        where activo=1";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }


    /*=============================================================================================================
      Insercion de ofertas
    ===============================================================================================================*/
    public function Insertar_Oferta($Nombre,$Descripcion,$cant_max,$Salario,$departamento,$ciudad,$fech_publi,$fech_venci,$sector,$Experencia){
      session_start();
      $sql="Insert into ofertas (empresa,	nombre,	descripcion,	cantidad_max,	salario,	ciudad,	fecha_creacion,	fecha_publicacion,	fecha_vencimiento,	sector,	experencia)
            select ".$_SESSION['cod_empre'].", '$Nombre','$Descripcion',$cant_max,$Salario,$ciudad,CURDATE(),'$fech_publi','$fech_venci',$sector,$Experencia  ";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }


    /*=============================================================================================================
      Listar postulaciones 
    ===============================================================================================================*/
    public function listar_postulaciones($oferta){
      
      $sql="SELECT p.*, uo.fecha_creacion, uo.estado as estadoPost , eo.descripcion as nombreOfe , c.nombre as nombre_c
            FROM `ofertas` o 
              inner join usuario_oferta uo on o.codigo=uo.oferta
              inner join estado_oferta eo on uo.estado=eo.codigo
              inner join persona p on uo.persona=p.codigo 
              inner join ciudad c on p.ciudad=c.codigo
            where o.codigo=$oferta";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      Listar ofertas persona 
    ===============================================================================================================*/
    public function List_ofertas_persona(){
      
      $sql="SELECT o.* , se.descripcion as sector1 
      FROM `ofertas` o 
      inner join sector se on o.sector=se.codigo 
      where o.codigo not in(
          select uo.oferta 
          from usuario_oferta uo  
          left join persona p on uo.persona=p.codigo 
                where uo.persona =".$_SESSION['cod_persona'].")";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
      insertar postulaciones a oferta 
    ===============================================================================================================*/
    public function postular_oferta($oferta){
      
      $sql="INSERT INTO usuario_oferta
            select ".$_SESSION['cod_persona'].",$oferta,curdate(),1,1";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }


    /*=============================================================================================================
      Buscar datos de la oferta
    ===============================================================================================================*/
    public function buscar_oferta($oferta){
      
      $sql="SELECT o.*, se.descripcion as sector1
            from ofertas o
            inner join sector se on o.sector=se.codigo
            where o.codigo =$oferta";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    /*=============================================================================================================
     cantidad de ofertas postuladas 
    ===============================================================================================================*/
    public function cantidad_postulaciones($oferta){
      
      $sql="SELECT count(*) as cantidad
            from ofertas o
            inner join usuario_oferta uo on uo.oferta=o.codigo
            where o.codigo =$oferta";

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }

    
    /*=============================================================================================================
     listado de ofertas postuladas 
    ===============================================================================================================*/
    public function List_Postulaciones_persona(){
      
      $sql="SELECT o.* , se.descripcion as sector1 , uo.estado as estadoOfe, uo.fecha_creacion as fecha_postu, eo.descripcion as nomEstado
            FROM `ofertas` o 
              inner join sector se on o.sector=se.codigo 
              inner join usuario_oferta uo on uo.oferta=o.codigo
              inner join estado_oferta eo on uo.estado=eo.codigo
            where uo.persona =".$_SESSION['cod_persona'];

      //echo $sql."<br>";
      $resultado=$this->consultar($sql);
      return $resultado;
    }
    
    
    



    

         
  }
  ?>
