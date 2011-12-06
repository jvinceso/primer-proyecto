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
                            where gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=".$idperiodoacademicoactual."
                            order by gr.iGradoIdGrado, sec.vSeccDescripcion, vCursNombreCurso");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
    }
    
    public function crearTablaCursosSimple($pag_inicio=null, $nroregistros=null, $opt=null) {
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

            //$listacursos = $this->listarCursosPeriodoActual();
            $consulta="
                Select cur.iCursIdCursos, gr.vGradoDescripcion, sec.vSeccDescripcion, cur.vCursNombreCurso, cur.iCursDescripcion, cur.tiCursActivo
                from cursos cur
                inner join seccion sec on cur.Seccion_iSeccIdSeccion = sec.iSeccIdSeccion
                inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado
                order by gr.iGradoIdGrado, sec.vSeccDescripcion, vCursNombreCurso";
            $listacursos = $this->consultaPaginada($consulta, $pag_inicio, $nroregistros,$opt);
            
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
        $paginador = '
            <table class="data_table">
                <tbody>
                    <th><a href=""><< Primero</a></th>                    
                    <th><a href="">< Anterior</a></th>
                    <th>
                        <a href="">1 </a>
                        <a href="">2 </a>
                        <a href="">3 </a>
                    </th>
                    <th><a href="/admin/listacursos/?opt=sig">Siguiente ></a></th>
                    <th><a href="">Ultimo >></a></th>  
                <tbody>
                <tr class="row_odd">
                    
                </tr>
            </table>';
    
//        $pagina_actual=0;
//        $nroregistros=5;
//        
//        $consulta="Select cur.iCursIdCursos, gr.vGradoDescripcion, sec.vSeccDescripcion, cur.vCursNombreCurso, cur.iCursDescripcion, cur.tiCursActivo
//                from cursos cur
//                inner join seccion sec on cur.Seccion_iSeccIdSeccion = sec.iSeccIdSeccion
//                inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado
//                order by gr.iGradoIdGrado, sec.vSeccDescripcion, vCursNombreCurso
//                LIMIT ".$pagina_actual.",".$nroregistros;
//        
//        $paginador=$this->crearNavegador($consulta);
//        
        return $contenido.$paginador;
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
     
    public function crearTablaCursos($data,$page=null,$nroreg=null){
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
        $cont=0;
        foreach ($data as $aux){
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
                            if($page==NULL && $nroreg==NULL){
                                if($aux['tiCursActivo']=='A'){
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iCursIdCursos'].',\'I\',event,\'act\');" ><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iCursIdCursos'].',\'A\',event,\'act\');" ><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
                            }
                            else{
                                if($aux['tiCursActivo']=='A'){
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iCursIdCursos'].',\'I\',event,\'act\','.$page.','.$nroreg.');" ><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iCursIdCursos'].',\'A\',event,\'act\','.$page.','.$nroreg.');" ><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
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
    
    public function actualizarCursoPorId($id,$estado) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
            $data = array('tiCursActivo' =>  $estado );   
            $dbAdapter->update('cursos',$data,'iCursIdCursos = ' . $id);
        }

    public function consultaPaginada($consulta,$inicio=null,$nro_registros=1,$opt=null){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query($consulta);
        $result = $stmt->fetchAll();
        
        $total_registros=sizeof($result);
        $nro_paginas=(int)$total_registros/$nro_registros;
        
        switch($opt){
            case 'pri':
                $stmt=$dbAdapter->query($consulta." LIMIT ".$inicio.", ".$nro_registros);
                $result = $stmt->fetchAll();
                return $result;
                break;
            
            case 'ant':
                break;
            
            case 'sig':
                $inicio+=$nro_registros;
                $stmt=$dbAdapter->query($consulta." LIMIT ".$inicio.", ".$nro_registros);
                $result = $stmt->fetchAll();
                return $result;
                break;
            
            case 'ult':
                break;
                
        }
    }
    
    public function listarCursosPeriodoActualActivos(){
        $periodoacademico= new Application_Model_PeriodoAcademico();
        $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("SELECT cur.iCursIdCursos, gr.vGradoDescripcion, sec.vSeccDescripcion, cur.vCursNombreCurso, cur.iCursDescripcion, cur.tiCursActivo
                    FROM cursos cur
                    INNER JOIN seccion sec ON cur.Seccion_iSeccIdSeccion = sec.iSeccIdSeccion
                    INNER JOIN grado gr ON sec.Grado_iGradoIdGrado = gr.iGradoIdGrado
                    where gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=".$idperiodoacademicoactual." and cur.tiCursActivo = 'A'
                    ORDER BY gr.iGradoIdGrado, sec.vSeccDescripcion, vCursNombreCurso");

        $result = $stmt->fetchAll();

        if(isset($result)){
            return $result;
        }else{
            return NULL;
        }
    }
    
    public function obtenerdocentescurso($idcurso){
        $dbAdapter= Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                    SELECT cusu.Cursos_iCursIdCursos, cusu.Usuarios_iUsuIdUsuario
                    FROM cursosusuarios cusu
                    inner join usuarios usu on usu.iUsuIdUsuario=cusu.Usuarios_iUsuIdUsuario
                    inner join tipousuario tusu on tusu.iTiUsuarioIdTipoUsuario=usu.TipoUsuario_iTiUsuarioIdTipoUsuario
                    WHERE tusu.iTiUsuarioIdTipoUsuario='2' and tiCursUsuActivo='A'  and cusu.Cursos_iCursIdCursos='".$idcurso."'
                    ");
        $result = $stmt->fetchAll();
        if(isset($result)){
            return $result;
        }else{
            return NULL;
        }
    }
    
    public function verificardocentecurso($idcurso,$iddocente){
        $dbAdapter= Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                    SELECT *
                    FROM cursosusuarios
                    WHERE Cursos_iCursIdCursos = ".$idcurso." AND Usuarios_iUsuIdUsuario = ".$iddocente);
        $result = $stmt->fetchAll();
        if(isset($result)){
            return $result;
        }else{
            return NULL;
        }
    }

    public function getDocenteCursobyIdCurso($idcurso){
        $dbAdapter= Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query('
            SELECT *
            FROM cursosusuarios curusu
            INNER JOIN cursos cur ON curusu.Cursos_iCursIdCursos = cur.iCursIdCursos
            INNER JOIN usuarios usu ON usu.iUsuIdUsuario = curusu.Usuarios_iUsuIdUsuario
            WHERE cur.iCursIdCursos = '.$idcurso.' AND usu.TipoUsuario_iTiUsuarioIdTipoUsuario=2 AND curusu.tiCursUsuActivo = "A"');

        $result = $stmt->fetchAll();

        if(isset($result)){
            return $result;
        }else{
            return NULL;
        }
    }
    
}