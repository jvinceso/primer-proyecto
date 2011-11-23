<?php
class Application_Model_Seccion {
	protected $iSeccIdSeccion;
	protected $vSeccDescripcion; 
	protected $tiSeccEstado;
        protected $iGradoIdGrado;
        protected $Grado_iGradoIdGrado;

	public function __construct(){

	}
        
        public function listarSeccionesPeriodoActual(){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select sec.iSeccIdSeccion, sec.vSeccDescripcion, sec.Grado_iGradoIdGrado , gr.vGradoDescripcion, sec.tiSeccEstado 
                            from seccion sec inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado
                            inner join periodoacademico pera on gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=pera.iPerAcaIdPeriodoAcademico
                            where pera.iPerAcaIdPeriodoAcademico='".$idperiodoacademicoactual."' and gr.tiGradoEstado='A' order by sec.Grado_iGradoIdGrado, gr.vGradoDescripcion,  sec.vSeccDescripcion");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
        }
        
        public function listarSeccionesPorGrado($idGrado){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select sec.iSeccIdSeccion, sec.vSeccDescripcion, sec.Grado_iGradoIdGrado , gr.vGradoDescripcion 
                            from seccion sec inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado 
                            inner join periodoacademico pera on gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=pera.iPerAcaIdPeriodoAcademico 
                            where pera.iPerAcaIdPeriodoAcademico='".$idperiodoacademicoactual."' and gr.tiGradoEstado='A' and sec.Grado_iGradoIdGrado ='".$idGrado."'");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
        }
        
        public function existenseccionesperactual(){
            
        }
                
        public function actualizarGradoPorId($id,$estado) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
            
            $peracademico = new Application_Model_PeriodoAcademico();
            $periodo = $peracademico->getPeriodoActual(); 
 
            $peracadescripcion=$periodo[0]['vPerAcaDescripcion'];
            $peractual=$peracademico->getPeriodoActualAnual();
            
            if($peracadescripcion==$peractual){
                //$gradosprim=$configuracion->getGradosPrimaria(); 

                //foreach ($gradosprim as $gp) {
                    $data = array('tiGradoEstado' =>  $estado );   
                    $dbAdapter->update('grado',$data,'iGradoIdGrado = ' . $id);
                    
                //}
                return true;
            }
            return false;
        }
        
        public function registrarSeccion($descripcion, $idgrado) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
             
            $dbAdapter->insert("seccion", array(
                    'vSeccDescripcion'     =>  $descripcion,
                    'tiSeccEstado' => 'A',
                    'Grado_iGradoIdGrado'     =>  $idgrado ));
        }
        
        public function deleteSeccion($idseccion) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
             
            $dbAdapter->delete("seccion", "iSeccIdSeccion='".$idseccion."'");
        }
        
        public function actualizarSeccion($id,$estado) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
            
            $data = array('tiSeccEstado' =>  $estado );
            $dbAdapter->update('seccion',$data,'iSeccIdSeccion = ' . $id);
                  
        }
}
 