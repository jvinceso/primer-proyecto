<?php
require_once 'mysql.php';
	function validar()
	{
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
	}
	
	function myFunction($post)
	{
		$usuario = htmlentities($post['login']); 
		$clave = htmlentities($post['password']); 

		$db = new MySQL();	
		$resultado = $db->consulta("Select vUsuClave,TipoUsuario_iTiUsuarioIdTipoUsuario from usuarios where vUsuUsuario='".$usuario."'");
		$filas=$db->num_rows($resultado);
		
		$respuesta = new xajaxResponse();
		if ($filas> 0) 
		{
			$row = mysql_fetch_assoc($resultado);
			if ($row['vUsuClave']==hash_hmac('md5', $clave, 'tesis'))
			{
				$resultado2 = $db->consulta("Select vUrl from tipousuario where iTiUsuarioIdTipoUsuario='".$row['TipoUsuario_iTiUsuarioIdTipoUsuario']."' and Estado='A'");
				$row2 = mysql_fetch_assoc($resultado2);
				$respuesta -> redirect($_configuration['root_web'].$row2['vUrl']);
			}
			else
			{
				$respuesta->assign("mensaje","innerHTML", "<div id='login_fail'>Contrase&ntilde;a Incorrecta</div>");
			}
		}
		else
		{
			$respuesta->assign("mensaje","innerHTML", "<div id='login_fail'>Usuario Incorrecto</div>");
		}
		return $respuesta;
		
	}
	
	function myFunctions($arg)
	{
		// do some stuff based on $arg like query data from a database and
		// put it into a variable like $newContent
		$newContent = "Value of $arg: ".$arg;
		
		// Instantiate the xajaxResponse object
		$objResponse = new xajaxResponse();
		
		// add a command to the response to assign the innerHTML attribute of
		// the element with id="SomeElementId" to whatever the new content is
		$objResponse->assign("SomeElementId","innerHTML", $newContent);
		
		//return the  xajaxResponse object
		return $objResponse;
	}

?>