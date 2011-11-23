<?php
require_once 'mysql.php';
	
	$usuario = $_POST['login'];
	$clave = $_POST['password'];
	
	$db = new MySQL();	
	$resultado = $db->consulta("Select vUsuClave,TipoUsuario_iTiUsuarioIdTipoUsuario from usuarios where vUsuUsuario='".$usuario."'");
	$filas=$db->num_rows($resultado);

	if ($filas> 0) 
	{
		$row = mysql_fetch_assoc($resultado);
		if ($row['vUsuClave']==hash_hmac('md5', $clave, 'tesis'))
		{
			$resultado2 = $db->consulta("Select vUrl from tipousuario where iTiUsuarioIdTipoUsuario='".$row['TipoUsuario_iTiUsuarioIdTipoUsuario']."' and Estado='A'");
			$row2 = mysql_fetch_assoc($resultado2);
			header("location: ".$_configuration['root_web'].$row2['vUrl']);
		}
		else
		{
			header("location: ".$_configuration['root_web']."alumno/alumno_principa.php"); 
		}
	}
	else
	{
		header("location: ".$_configuration['root_web']."alumn/alumno_principal.php");  
	}

?>