<?php
require_once 'configuration.php';

class MySQL{
	private $conexion;
	private $total_consultas;
	
		public function MySQL(){
			if(!isset($this->conexion)){
			global $_configuration;
			$this->conexion = mysql_connect($_configuration['db_host'], $_configuration['db_user'],$_configuration['db_password']);
			mysql_select_db($_configuration['db_database'],$this->conexion) or die(mysql_error());
			}
		}
		 
		public function consulta($consulta){
		  $this->total_consultas++;
		  $resultado = mysql_query($consulta,$this->conexion);
			if(!$resultado){
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}
		  return $resultado; 
		}
		
		public function fetch_array($consulta){ 
			return mysql_fetch_array($consulta);
		}
		
		public function num_rows($consulta){ 
			return mysql_num_rows($consulta);
		}
		
		public function getTotalConsultas(){
			return $this->total_consultas;
		}
		
		function encriptar($cadena, $clave)
		{
			$cifrado = MCRYPT_RIJNDAEL_256;
			$modo = MCRYPT_MODE_ECB;
			return mcrypt_encrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
		}

		function desencriptar($cadena, $clave)
		{
			$cifrado = MCRYPT_RIJNDAEL_256;
			$modo = MCRYPT_MODE_ECB;
			return mcrypt_decrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
		}
}?>
