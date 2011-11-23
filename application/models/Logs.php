<?php
class Application_Model_Logs extends Zend_Db_Table_Abstract{
	protected $_name = 'log';
        protected $_primary = 'iLogIdLog';
        protected $_sequence = true;
        protected $iLogIdLog;
        protected $iUsuIdUsuario;
	protected $iLogTimeStamp;
	protected $cAcciIdAccion;
	/**
	 * Usuario,Seguridad,Sistema
	 */
 
	public function __construct()
	{
	 
	}	 
	public function crearLog($idaccion) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            
            $mysession = new Zend_Session_Namespace('sesion');                    
            $usuario_id=$mysession->usuario_id;
            
            $insert = $dbAdapter->insert("log", array(
                'iUsuIdUsuario'     =>  $usuario_id,
                'iLogTimeStamp'     => time(),
                'cAcciIdAccion'     =>  $idaccion ));
	}

}