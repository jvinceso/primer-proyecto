<?php
class Application_Model_PeriodoAcademico extends Zend_Db_Table_Abstract{
    protected $iPerAcaIdPeriodoAcademico;
    protected $vPerAcaDescripcion;
    protected $cPerAcaEstado;
    public function getPeriodoActual(){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('pera' => 'periodoacademico'))
                ->where('cPerAcaEstado = "A"');

        $stmt = $dbAdapter->query($select);
        $result = $stmt->fetchAll(); 
        return $result;
    }
    public function getPeriodoActualAnual(){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('pera' => 'periodoacademico'),
                       array('vPerAcaDescripcion'))
                ->where('cPerAcaEstado = "A"');

        $stmt = $dbAdapter->query($select);
        
        $filas=$stmt->rowCount();
        if($filas==0){
            //No existe Periodo Academico Activo 
            return 'A';
        }
        if($filas>1){
            //Error en la BD
            return 'B';
        }
        
        $result = $stmt->fetchAll();
        
        $anual=$result[0]['vPerAcaDescripcion'];
        
        return $anual;
    }
    
    public function getPeriodoActualId(){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('pera' => 'periodoacademico'),
                       array('iPerAcaIdPeriodoAcademico'))
                ->where('cPerAcaEstado = "A"');

        $stmt = $dbAdapter->query($select);
        $filas=$stmt->rowCount();
        if($filas==0){
            //No existe Periodo Academico Activo 
            return 'A';
        }
        if($filas>1){
            //Error en la BD
            return 'B';
        }
        $result = $stmt->fetchAll(); 
        $id=$result[0]['iPerAcaIdPeriodoAcademico'];
        return $id;
    }
    
    public function validarPeriodo(){
        $idperiodoacademico = $this->getPeriodoActualId();
         switch($idperiodoacademico){
            case 'A':
                return false;
                break;
            case 'B':
                return false;
                break;
            default:
                if ((int)date("Y")<=(int)$this->getPeriodoActualAnual()){
                    return false;
                }
                else{
                    return true;
                }
                break;
            }
        
    }
    public function validarActivarGrado(){
        if ((int)date("Y")==(int)$this->getPeriodoActualAnual() && (int)date("n")==1){
            return true;
        }
        else{
            return false;
        }        
    }
    public function validarActivarSeccion(){
        if ((int)date("Y")==(int)$this->getPeriodoActualAnual() && (int)date("n")==1){
            return true;
        }
        else{
            return false;
        }        
    }
    public function registrarPeriodo(){
        $peracademicoactual = $this->getPeriodoActualId();
        
        switch($peracademicoactual){
            case 'A': 
            case 'B':
                return false;
                break;
            default:
                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                $data = array(
                    'cPerAcaEstado' => 'I' 
                    );   
                $dbAdapter->update('periodoacademico', 
                        $data,'iPerAcaIdPeriodoAcademico = '.$peracademicoactual);

                $dbAdapter->insert("periodoacademico", array(
                    'vPerAcaDescripcion'=>  date("Y"),
                    'cPerAcaEstado'=> 'A'
                    ));
                return true;
                break;
            }
    }
}