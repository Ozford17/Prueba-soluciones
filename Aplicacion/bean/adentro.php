<?php
header("Content-type: text/html; charset=utf8");
if ($_POST['nombre_usuario'] && $_POST['contraseña'])
{
	session_start();
	require_once "../src/consultas.php";
	$consulta = new consultas();  
	$nombre=$_POST['nombre_usuario'];
	$contraseña=hash("sha256", $_POST['contraseña']);
	//$contraseña=$_POST['contraseña'];
	$_SESSION['tipo']=0;
	$res=$consulta->verificarUsuario($nombre,$contraseña);
	while ($fila=mysqli_fetch_assoc($res)) {
		if ($nombre==$fila['usuario'] && $contraseña==$fila['contra']) {
			$_SESSION['codigo']=$fila['codigo'];
			
			
			$_SESSION['tipo']=$fila['tipo'];
			
			if($fila['tipo']==1)
			{
				
				$resp=$consulta->BuscarEmpresa_usuario($fila['empresa'], $fila['usuario'] );
				if ($f=mysqli_fetch_assoc($resp)) {
					$_SESSION['cod_empre']=$f['codigo'];
					$_SESSION['nombre']=$f['nombre'];
					$_SESSION['documento']=$f['nit'];
					$_SESSION['ciudad']=$f['nombreciudad'];
					$_SESSION['correo']=$f['correo'];
				}
			}
			else{
				

				$resp=$consulta->BuscarPersona_usuario($fila['persona'],$fila['usuario']);
				if ($f=mysqli_fetch_assoc($resp)) {
					$_SESSION['cod_persona']=$f['codigo'];
					$_SESSION['nombre']=$f['nombre'];
					$_SESSION['tipo_doc']=$f['tipo_doc'];
					$_SESSION['documento']=$f['numero_doc'];
					$_SESSION['ciudad']=$f['nombreciudad'];
					$_SESSION['correo']=$f['correo'];
			}
			}
			

		}
		else
		{
			
			$_SESSION['tipo']=0;
		}
	}
	
	if ($_SESSION['tipo']==0) {
		$mesaje["error"]="true";
		$mensaje["direc"]="index.php?Error";
		$mensaje['mensaje']="Datos de usuario incorrectos";
	}else if ($_SESSION['tipo']==1) {
		$mesaje["error"]="false";
		$mensaje["direc"]="Users/Empresa/";
	}else if ($_SESSION['tipo']==2) {
		$mesaje["error"]="false";
		$mensaje["direc"]="Users/Usuario/index.php?s=".base64_encode($_SESSION["codigo"]);
	}else {
		$mensaje["error"]="true";
		$mensaje["direc"]="index.php?Error";
		$mensaje["mensaje"]="error de tipo";
	}
}	
else{
	$mensaje["error"]="true";
	$mensaje["direc"]="index.php?Error";
	$mensaje["mensaje"]="No se enviaron los parametros";
}

$deco= json_encode($mensaje);
echo base64_encode(($deco));


?>