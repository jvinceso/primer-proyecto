<?php
/**
 * Asegura la información
 */
class Seguridad {
	/**
	 * datos que desean ser enviados de forma segura
	 */
	private $parametros;
	/**
	 * tipo de aseguramiento de la informacion
	 */
	private $encriptacion;
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function EncriptarDatos() {
		// Not yet implemented
	}

	public function RecuperarDatosEncriptados() {
		// Not yet implemented
	}

	public function setSeguridad() {
		// Not yet implemented
	}

	public function getSeguridad() {
		// Not yet implemented
	}
}
?>