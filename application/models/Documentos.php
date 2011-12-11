<?php
class Application_Model_Documentos extends Zend_Db_Table_Abstract{
    protected $iDocuIdDocumento;
    protected $iDocu_iCursIdCursos;
    protected $iDocu_iLeccIdLeccion;
    protected $tDocuRuta;
    protected $vDocuComentario;
    protected $vDocuTitulo;
    protected $vDocuTipoDocumento;
    protected $vDocuTamano;
    protected $cDocuEstado;
    
    public function getDocumentosbyIdCurso($idcurso){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM documentos
                                WHERE iDocu_iCursIdCursos = ".$idcurso);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getDocumentosbyIdCursoIdPadre($idcurso,$iddocpadre){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM documentos
                                WHERE iDocu_iCursIdCursos = ".$idcurso." AND iDocuPadre = ".$iddocpadre);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getCarpetasbyIdCurso($idcurso){
        
    }
    
    public function getArchivosbyNombreCarpeta($idcurso,$carpeta){
        
    }
    
    public function getDocumentobyIdDocumento($iddocumento){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM documentos
                                WHERE iDocuIdDocumento = ".$iddocumento);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getConocimientobyIdConocimiento($idconocimiento){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM conocimiento
                                WHERE iConIdConocimiento = ".$idconocimiento);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarCarpeta($idcurso,$idleccion,$ruta,$comentario,$titulo,$iddocupadre){
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $ruta=$ruta."/".$titulo;
                        
            if(!file_exists($ruta)){
                mkdir($ruta,0777);
            }
            
            $dbAdapter->insert("documentos", array(
                'iDocu_iCursIdCursos'     =>  $idcurso,
                'iDocuPadre'     =>  $iddocupadre,
                'iDocu_iLeccIdLeccion'     =>  $idleccion,
                'tDocuRuta' =>  $ruta,
                'vDocuComentario' =>  $comentario,
                'vDocuTitulo' =>  $titulo,
                'vDocuTipoDocumento' =>  'folder',
                'vDocuTamano' =>  NULL,
                'iDocuFechaCreacion' =>  time(),
                'iDocuFechaModificado' =>  time(),
                'cDocuEstado' =>  "A"
            ));
           
    }

    public function registrarArchivo($idcurso,$idleccion,$ruta,$comentario,$titulo,$iddocupadre,$tamanio){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
//        $ruta=$ruta."/".$titulo;

        $dbAdapter->insert("documentos", array(
            'iDocu_iCursIdCursos'     =>  $idcurso,
            'iDocuPadre'     =>  $iddocupadre,
            'iDocu_iLeccIdLeccion'     =>  $idleccion,
            'tDocuRuta' =>  $ruta,
            'vDocuComentario' =>  $comentario,
            'vDocuTitulo' =>  $titulo,
            'vDocuTipoDocumento' =>  'archivo',
            'vDocuTamano' =>  $tamanio,
            'iDocuFechaCreacion' =>  time(),
            'iDocuFechaModificado' =>  time(),
            'cDocuEstado' =>  "A"
        ));

    }
    
    public function obternerruta($iddocu){
        $ruta="";
        if($iddocu==0){
            $ruta="";
        }
        else{
            $documento = $this->getDocumentobyIdDocumento($iddocu);
            $iddocupadre = $documento[0]['iDocuPadre'];
            $ruta="/".$documento[0]['vDocuTitulo'].$ruta;
            while($iddocupadre!=0){
                $documento = $this->getDocumentobyIdDocumento($iddocupadre);
                $ruta="/".$documento[0]['vDocuTitulo'].$ruta;
                $iddocupadre = $documento[0]['iDocuPadre'];
            }
        }
        
        return $ruta;
    }

    public function buscarNombreArchivobyIdDocuPadre($iddocupadre,$nombrearchivo){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM documentos
                                WHERE iDocuPadre = ".$iddocupadre." AND vDocuTipoDocumento='archivo' AND vDocuTitulo = '".$nombrearchivo."'");
        $result = $stmt->fetchAll();
        
        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
}