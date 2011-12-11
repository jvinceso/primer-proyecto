<?php
require_once(realpath(dirname(__FILE__)) . '/Chat.php');

class ChatMensajes {
	private $mensajeChatMensaje;
	private $idChat;
	/**
	 * @AssociationType Chat
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_Chat_;
	
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function setChatMensaje() {
		// Not yet implemented
	}

	public function getChatMensaje() {
		// Not yet implemented
	}
}
?>