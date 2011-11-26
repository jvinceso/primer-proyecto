<?php
class Application_Model_Cursos{
    protected $iCursIdCursos;
    protected $vCursNombreCurso;
    protected $tiCursActivo;
    protected $iCursCreado;
    protected $iCursFechaCreacion;
    protected $iCursDescripcion;
    protected $Seccion_iSeccIdSeccion;
    
    public function listarCursosPeriodoActual(){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select cur.iCursIdCursos, gr.vGradoDescripcion, sec.vSeccDescripcion, cur.vCursNombreCurso, cur.iCursDescripcion, cur.tiCursActivo
                            from cursos cur
                            inner join seccion sec on cur.Seccion_iSeccIdSeccion = sec.iSeccIdSeccion
                            inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado
                            order by gr.iGradoIdGrado, sec.vSeccDescripcion, vCursNombreCurso");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
    }
    
    public function crearTablaCursosSimple() {
            $contenido = '
            <table class="data_table">
            <tbody>
            <tr class="row_odd">
                    <th>&nbsp;</th>
                    <th>Codigo</th>
                    <th><a href="">Grado</a></th>                    
                    <th><a href="">Seccion</a></th>
                    <th><a href="">Curso</a></th>
                    <th><a href="">Descripcion</a></th>  
                    <th><a href="">Estado</a></th>
            </tr>';

            $listacursos = $this->listarCursosPeriodoActual();
            
            $cont=0;
            foreach ($listacursos as $aux){
                if ($cont % 2){
                    $contenido.='<tr class="row_even">';
                }
                else{
                    $contenido .= '<tr class="row_odd">';
                }
                $contenido.='
                            <td>
                                <input type="checkbox" name="id" value="'.$aux['iCursIdCursos'].'">
                            </td>
                            <td>
                                <center>'.$aux['iCursIdCursos'].'</center>
                            </td>
                            <td>
                                <center>'.$aux['vGradoDescripcion'].'</center>
                            </td>
                            <td>
                                <center>'.$aux['vSeccDescripcion'].'</center>
                            </td>
                            <td>
                                <center>'.$aux['vCursNombreCurso'].'</center>
                            </td>
                            <td>
                                <center>'.$aux['iCursDescripcion'].'</center>
                            </td>
                            <td>
                                <center>';
                                if($aux['tiCursActivo']=='A'){
                                    $contenido.='<a href="/admin/actualizarseccion/?cur='.$aux['iCursIdCursos'].'&est=I" onclick="ActDelCurso('.$aux['iCursIdCursos'].',\'I\',event,\'act\');" ><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.='<a href="/admin/actualizarseccion/?cur='.$aux['iCursIdCursos'].'&est=A" onclick="ActDelCurso('.$aux['iCursIdCursos'].',\'A\',event,\'act\');" ><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
                $contenido.='
                               </center>
                            </td>
                        </tr>';
            
            $cont++;
        }
        
	$contenido .= '</tbody>
                </table>';
         
        return $contenido;
    }    
	 
    public function registrarCurso($nombrecurso, $descripcion, $idseccion) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            
            if($this->buscarCursoxSeccion($idseccion, $nombrecurso)==NULL){
                $dbAdapter->insert("cursos", array(
                    'vCursNombreCurso'     =>  $nombrecurso,
                    'tiCursActivo'     =>  'A',
                    'dCursFechaCreacion'     =>  time(),
                    'iCursDescripcion'     =>  $descripcion,
                    'Seccion_iSeccIdSeccion' => $idseccion));
                return true;
            }
            return false;
    }
    
    public function buscarCursoxSeccion($idseccion, $nombrecurso){  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select *  
                               from cursos where Seccion_iSeccIdSeccion=".$idseccion." AND vCursNombreCurso='".$nombrecurso."'");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }
            else{
                return NULL;   
            }
     }
     
      public function crearTablaCursos(){
            $contenido = '
            <table class="data_table">
            <tbody>
            <tr class="row_odd">
                    <th>&nbsp;</th>
                    <th>Codigo</th>
                    <th><a href="">Grado</a></th>                    
                    <th><a href="">Seccion</a></th>
                    <th><a href="">Curso</a></th>
                    <th><a href="">Descripcion</a></th>  
                    <th><a href="">Estado</a></th>
            </tr>';

            $listacursos = $this->listarCursosPeriodoActual();

            $cont=0;
            foreach ($listacursos as $aux){
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

                                if ($cont<sizeof($listacursos)-1){
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
        public function actualizarCursoPorId($id,$estado) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
            $data = array('tiCursActivo' =>  $estado );   
            $dbAdapter->update('cursos',$data,'iCursIdCursos = ' . $id);
        }
}