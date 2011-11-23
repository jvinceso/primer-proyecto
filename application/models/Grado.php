<?php
class Application_Model_Grado {
	protected $iGradoIdGrado;
	protected $vGradoDescripcion; 
	protected $tiGradoEstado;
        protected $PeriodoAcademico_iPerAcaIdPeriodoAcademico;

	public function __construct(){

	}
 
	public function listarDocentes() {
		// Not yet implemented
	}

 	public function promoverAlumnos() {
		// Not yet implemented
	}

	public function registrarGrado() {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $configuracion = new Application_Model_Configuracion();
            $peracademico = new Application_Model_PeriodoAcademico();
            $periodo = $peracademico->getPeriodoActual();
            $idperiodoacademico = $peracademico->getPeriodoActualId();
 
            $peracadescripcion=$periodo[0]['vPerAcaDescripcion'];
            $peractual=$peracademico->getPeriodoActualAnual();
            
            if($peracadescripcion==$peractual){
                $gradosprim=$configuracion->getGradosPrimaria(); 

                foreach ($gradosprim as $gp) {
                    $dbAdapter->insert("grado", array(
                    'vGradoDescripcion'     =>  $gp['tConfDescripcion'],
                    'PeriodoAcademico_iPerAcaIdPeriodoAcademico'     => $idperiodoacademico,
                    'tiGradoEstado'     =>  'I' ));
                }
                return true;
            }
            return false;
        }
        
        public function listarGradosPeriodoActual(){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
            
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $select = $dbAdapter->select()
                    ->from("grado")
                    ->where("PeriodoAcademico_iPerAcaIdPeriodoAcademico = '".$idperiodoacademicoactual."'");

            $stmt = $dbAdapter->query($select);
            $result = $stmt->fetchAll();
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
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
        
        public function listarGradosActivos(){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
            
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $select = $dbAdapter->select()
                    ->from("grado")
                    ->where("PeriodoAcademico_iPerAcaIdPeriodoAcademico = '".$idperiodoacademicoactual."' AND tiGradoEstado='A'");

            $stmt = $dbAdapter->query($select);
            $result = $stmt->fetchAll();
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
        }
}
 