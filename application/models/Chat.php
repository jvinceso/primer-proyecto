<?php
require_once(realpath(dirname(__FILE__)) . '/Usuario.php');
require_once(realpath(dirname(__FILE__)) . '/ChatMensajes.php');

class Chat {
	private $idChat;
	private $nombre;
	private $fechaCreacion;
	private $mensaje;
	private $activoChat;
	private $usuarioChat;
	private $idUduario;
	/**
	 * @AssociationType Usuario
	 */
	private $unnamed_Usuario_;
	/**
	 * @AssociationType ChatMensajes
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_ChatMensajes_ = array();
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	/**
	 * Usuario
	 */
	public function AlertarNuevoMensaje() {
		// Not yet implemented
	}

	/**
	 * Usuario,Seguridad
	 */
	public function EnviarMensaje() {
		// Not yet implemented
	}

	/**
	 * Seguridad,Usuario
	 */
	public function RevizarBuzonMensajes() {
		// Not yet implemented
	}

	/**
	 * Seguridad,Usuario
	 */
	public function RecibirMensaje() {
		// Not yet implemented
	}

	public function setChat() {
		// Not yet implemented
	}

	public function getChat() {
		// Not yet implemented
	}
}
?>