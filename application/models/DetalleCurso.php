<?php
class Application_Model_DetalleCurso extends Zend_Db_Table_Abstract{
    
    public function buscarDetalle($idcurso,$descripcion){
        $dbAdapter= Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query('
            SELECT *
            FROM detallecurso 
            WHERE vDescripcion = "'.$descripcion.'" AND Cursos_iCursIdCursos = '.$idcurso);

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return TRUE;
        }else{
            return "0";
        }
    }
    
    public function getDetalle($idcurso,$descripcion){
        $dbAdapter= Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query('
            SELECT *
            FROM detallecurso 
            WHERE vDescripcion = "'.$descripcion.'" AND Cursos_iCursIdCursos = '.$idcurso);

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return "0";
        }
    }
    
    public function insertarDetalle($idcurso, $descripcion, $value){
        $accion = $this->buscarDetalle($idcurso,$descripcion);
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        if($accion==0){
            $dbAdapter->insert("detallecurso", array(
                    'Cursos_iCursIdCursos'     =>  $idcurso,
                    'vDescripcion'     =>  $descripcion,
                    'tValor'     =>  $value));
        }
        else
        {
            $data = array('tValor' =>  $value );   
            $dbAdapter->update('detallecurso',$data,'Cursos_iCursIdCursos = '.$idcurso.' AND vDescripcion = "'.$descripcion.'"');
        }
    }
    
    public function eliminarDetalle($idcurso, $descripcion){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->delete("detallecurso", 'Cursos_iCursIdCursos = '.$idcurso.' AND vDescripcion = "'.$descripcion.'"');
    }
}