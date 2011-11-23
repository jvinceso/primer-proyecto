<?php
class Application_Model_TipoUsuario extends Zend_Db_Table_Abstract{

    protected $Descripcion;
    protected $vUrl;
    protected $Estado;

    public function __construct() {
    }
    public function getTipoUsuario(){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('tipusu' => 'tipousuario'),
                        array('iTiUsuarioIdTipoUsuario','vDescripcion')
                        )
                ->where("Estado = 'A'")
                ->order('vDescripcion');
        
        $stmt = $dbAdapter->query($select);
        $result = $stmt->fetchAll();
        if(isset($result)){
            $arr=$this->query2array($result);
            return $arr;
        }else{
            return NULL;   
        }    
    }
/*
 * Recibe Array's Resultado de una consulta SQL y crea Array de una Dimension
  */
    public function query2array($array_re){
        $array_temp;
        for($i=0;$i<sizeof($array_re);$i++)
        {
            //aca Pones el Id del campo que quieres pasar al array 
            $array_temp[$array_re[$i]['iTiUsuarioIdTipoUsuario']]=($array_re[$i]['vDescripcion']);
        }return $array_temp;
    }
}

?>
