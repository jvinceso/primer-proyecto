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
        
        public function listarSeccionesPeriodoActualActivos(){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select sec.iSeccIdSeccion, sec.vSeccDescripcion, sec.Grado_iGradoIdGrado , gr.vGradoDescripcion, sec.tiSeccEstado 
                            from seccion sec inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado
                            inner join periodoacademico pera on gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=pera.iPerAcaIdPeriodoAcademico
                            where pera.iPerAcaIdPeriodoAcademico='".$idperiodoacademicoactual."' and gr.tiGradoEstado='A' and sec.tiSeccEstado='A' order by sec.Grado_iGradoIdGrado, gr.vGradoDescripcion,  sec.vSeccDescripcion");
             
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
                            where pera.iPerAcaIdPeriodoAcademico='".$idperiodoacademicoactual."' and gr.tiGradoEstado='A' and sec.Grado_iGradoIdGrado ='".$idGrado."' order by sec.Grado_iGradoIdGrado, gr.vGradoDescripcion");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
        }
               
        public function listarSeccionesPorGradoActivos($idGrado){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select sec.iSeccIdSeccion, sec.vSeccDescripcion, sec.Grado_iGradoIdGrado , gr.vGradoDescripcion 
                            from seccion sec inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado 
                            inner join periodoacademico pera on gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=pera.iPerAcaIdPeriodoAcademico 
                            where pera.iPerAcaIdPeriodoAcademico='".$idperiodoacademicoactual."' and gr.tiGradoEstado='A' and sec.tiSeccEstado='A'  and sec.Grado_iGradoIdGrado ='".$idGrado."' order by sec.Grado_iGradoIdGrado, gr.vGradoDescripcion");
             
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
        
        public function crearTablaSecciones(){
            $contenido = '
            <table class="data_table">
            <tbody>
            <tr class="row_odd">
                    <th width="18px">&nbsp;</th>
                    <th>Codigo</th>
                    <th><a href="">Grado</a></th>
                    <th><a href="">Sección</a></th> 
                    <th width="15px"><a href="">Activo</a></th>
                    <th width="220px">Acción</th>
            </tr>';

            $listasecciones = $this->listarSeccionesPeriodoActual();

            $cont=0;
            foreach ($listasecciones as $aux){
                if ($cont % 2){
                    $contenido.='<tr class="row_even">';
                }
                else{
                    $contenido .= '<tr class="row_odd">';
                }
                $contenido.='
                            <td>
                                <input type="checkbox" name="id[]" value="4">
                            </td>
                            <td>
                                <center>'.$aux['iSeccIdSeccion'].'</center>
                            </td>

                            <td>
                                <center>'.$aux['vGradoDescripcion'].'</center>
                            </td> 
                            <td>
                                <center>'.$aux['vSeccDescripcion'].'</center>
                            </td>
                            <td>
                                <center>';
                                if($aux['tiSeccEstado']=='A'){
                                    $contenido.=' <a href="/admin/actualizarseccion/?secc='.$aux['iSeccIdSeccion'].'&est=I"><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.=' <a href="/admin/actualizarseccion/?secc='.$aux['iSeccIdSeccion'].'&est=A"><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
                $contenido.='
                               </center>
                            </td>
                            <td>
                                <a href="">
                                    <img src="/main/img/course.gif" title="Cursos" alt="Cursos" />
                                </a>&nbsp;&nbsp;
                                <a href="">
                                    <img src="/main/img/synthese_view.gif" alt="Información" title="Información">
                                </a>&nbsp;&nbsp;
                                <a href="">
                                    <img src="/main/img/login_as.gif" alt="Iniciar sesión como" title="Iniciar sesión como">
                                </a>&nbsp;&nbsp;
                                <img src="/main/img/statistics_na.gif" alt="Informes" title="Informes">&nbsp;&nbsp;
                                <a href="">
                                    <img src="/main/img/icons/22/edit.png" alt="Editar" title="Editar">
                                </a>&nbsp;
                                <img src="/main/img/admin_star_na.png" alt="No es administrador" title="No es administrador" />';

                                if ($cont<sizeof($listasecciones)-1){
                                    if($aux['vGradoDescripcion']==$listasecciones[$cont+1]['vGradoDescripcion']){
                                        $contenido.='
                                        <a>
                                            <img src="/main/img/icons/22/delete_na.png" alt="No Eliminar" title="No Puede Eliminarse">
                                        </a>';
                                    }
                                    else{
                                        $contenido.='
                                        <a href="/admin/eliminarseccion/?secc='.$aux['iSeccIdSeccion'].'">
                                            <img src="/main/img/icons/22/delete.png" alt="Eliminar?" title="Eliminar?">
                                        </a>';
                                    }
                                }
                                else {
                                    $contenido.='
                                        <a href="/admin/eliminarseccion/?secc='.$aux['iSeccIdSeccion'].'">
                                            <img src="/main/img/icons/22/delete.png" alt="Eliminar?" title="Eliminar?">
                                        </a>';
                                }

                           $contenido.='                             
                            </td>
                        </tr>';

                $cont++;
            }

            $contenido .= '</tbody>
                    </table>
                </div>';
         
            return $contenido;
        }
}
 