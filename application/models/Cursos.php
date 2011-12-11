<?php
class Application_Model_Cursos extends Zend_Db_Table_Abstract{
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

    public function getInfoCurso($idcurso){
        $dbAdapter= Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query('
            SELECT *
            FROM cursos cur
            INNER JOIN seccion secc ON cur.iCursIdCursos = secc.iSeccIdSeccion
            INNER JOIN grado gr ON secc.Grado_iGradoIdGrado = gr.iGradoIdGrado
            WHERE cur.iCursIdCursos = '.$idcurso);

        $result = $stmt->fetchAll();

        if(isset($result)){
            return $result;
        }else{
            return NULL;
        }
    }
    
    public function crearVistaCurso($idcurso,$tipoVista){
        $html = "";
        $curso=$this->getInfoCurso($idcurso);
        $seccion = new Application_Model_Seccion();
        $idseccion = $curso[0]['Seccion_iSeccIdSeccion'];
        $nroalumnos = sizeof($seccion->listarAlumnosporSecciones($idseccion));
        if($tipoVista=="docente"){
            $html.='
                    <div style="margin-left:10%; margin-right:10%;">
                        <table align="center">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="110" valign="middle" align="left">
                                                        <img src="/main/img/blackboard_blue.png" alt="Mr. Chamilo" title="Mr. Chamilo">
                                                    </td>
                                                    <td valign="middle" align="left"><h1>&nbsp;Nombre del Curso: <a style="color:#5084A0;">'.$curso[0]['vCursNombreCurso'].'</a><br/>
                                                        <h2>&nbsp;Grado: <a style="color:#5084A0;">'.$curso[0]['vGradoDescripcion'].' "'.$curso[0]['vSeccDescripcion'].'"</a> - Nro. Alumnos: <a style="color:#5084A0;">'.$nroalumnos.'</a></h2></h1>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="clear">
                </div>
                <div class="courseadminview" style="border:0px; margin-top: 0px;padding:0px;">
                    <div class="normal-message" id="id_normal_message" style="display:none">
                        <img src="/main/inc/lib/javascript/indicator.gif">&nbsp;&nbsp;Por favor, espere...
                    </div>
                    <div class="confirmation-message" id="id_confirmation_message" style="display:none"></div>
                    </div>
                    <div class="courseadminview">
                        <span class="viewcaption">Creación de contenidos
                        </span>		
                        <table width="100%">
                            <tbody>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_1" href="/main/course_description?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_1" src="/main/img/info.gif" alt="Descripción del curso" title="Descripción del curso">
                                        </a>
                                        <a id="istooldesc_1" href="/docente/descripcioncurso?idcurso='.$idcurso.'&opt=ini" class="" target="_self">
                                            Descripción del curso
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_3" href="documentos?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_3" src="/main/img/folder_document.gif" alt="Documentos" title="Documentos">
                                        </a>
                                        <a id="istooldesc_3" href="documentos?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            Documentos
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_25" href="editarunidades?idcurso='.$idcurso.'" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_25" src="/main/img/scormbuilder.gif" alt="Leccion 1" title="Leccion 1">
                                        </a>
                                        <a id="istooldesc_25" href="editarunidades?idcurso='.$idcurso.'" class="" target="_self">
                                            Unidades
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_4" href="lecciones?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_4" src="/main/img/scorms.gif" alt="Lecciones" title="Lecciones">
                                        </a>
                                        <a id="istooldesc_4" href="lecciones?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            Lecciones
                                        </a>
                                        </center>    
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_6" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_6" src="/main/img/quiz.gif" alt="Ejercicios" title="Ejercicios">
                                        </a>
                                        <a id="istooldesc_6" href="main/exercice/exercice.php?cidReq=002" class="" target="_self"> Ejercicios
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_16" href="/main/gradebook/index.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_16" src="/main/img/gradebook.gif" alt="Evaluaciones" title="Evaluaciones">
                                        </a>
                                        <a id="istooldesc_16" href="/main/gradebook/index.php?cidReq=002" class="" target="_self">
                                            Evaluaciones
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_17" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_17" src="/main/img/glossary.gif" alt="Glosario" title="Glosario">
                                        </a>
                                        <a id="istooldesc_17" href="/main/glossary/index.php?cidReq=002" class="" target="_self">
                                            Glosario
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="courseadminview">
                        <span class="viewcaption">Interacción
                        </span>
                        <table width="100%">
                            <tbody>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_2" href="/main/calendar/agenda.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_2" src="/main/img/agenda.gif" alt="Agenda" title="Agenda">
                                        </a>
                                        <a id="istooldesc_2" href="" class="" target="_self">
                                            Agenda
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_8" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_8" src="/main/img/forum.gif" alt="Foros" title="Foros">
                                        </a>
                                        <a id="istooldesc_8" href="/main/forum/index.php?cidReq=002" class="" target="_self">
                                            Foros
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_9" href="/main/dropbox/index.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_9" src="/main/img/dropbox.gif" alt="Compartir documentos" title="Compartir documentos">
                                        </a>
                                        <a id="istooldesc_9" href="/main/dropbox/index.php?cidReq=002" class="" target="_self">
                                            Compartir documentos
                                        </a>
                                        <center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_10" href="/main/user/user.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_10" src="/main/img/members.gif" alt="Usuarios" title="Usuarios">
                                        </a>
                                        <a id="istooldesc_10" href="/main/user/user.php?cidReq=002" class="" target="_self">
                                            Usuarios
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_11" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_11" src="/main/img/group.gif" alt="Grupos" title="Grupos">
                                        </a>
                                        <a id="istooldesc_11" href="/main/group/group.php?cidReq=002" class="" target="_self">
                                            Grupos
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_12" class="" href="" target="_self">
                                            <img class="tool-icon" id="toolimage_12" src="/main/img/chat.gif" alt="Chat" title="Chat">
                                        </a>
                                        <a id="istooldesc_12" class="" href="" target="_self">
                                            Chat
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_13" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_13" src="/main/img/works.gif" alt="Tareas" title="Tareas">
                                        </a>
                                        <a id="istooldesc_13" href="" class="" target="_self">
                                            Tareas
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_14" href="/main/survey/survey_list.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_14" src="/main/img/survey.gif" alt="Encuestas" title="Encuestas">
                                        </a>
                                        <a id="istooldesc_14" href="" class="" target="_self">
                                            Encuestas
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                    
                <div class="clear">
                    &nbsp;
                </div>';
            
        }
        else if($tipoVista=="alumno"){
             $html.='
                    <div style="margin-left:10%; margin-right:10%;">
                        <table align="center">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="110" valign="middle" align="left">
                                                        <img src="/main/img/blackboard_blue.png" alt="Mr. Chamilo" title="Mr. Chamilo">
                                                    </td>
                                                    <td valign="middle" align="left"><h1>&nbsp;Nombre del Curso: <a style="color:#5084A0;">'.$curso[0]['vCursNombreCurso'].'</a><br/>
                                                        <h2>&nbsp;Grado: <a style="color:#5084A0;">'.$curso[0]['vGradoDescripcion'].' "'.$curso[0]['vSeccDescripcion'].'"</a> - Nro. Alumnos: <a style="color:#5084A0;">'.$nroalumnos.'</a></h2></h1>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="clear">
                </div>
                <div class="courseadminview" style="border:0px; margin-top: 0px;padding:0px;">
                    <div class="normal-message" id="id_normal_message" style="display:none">
                        <img src="/main/inc/lib/javascript/indicator.gif">&nbsp;&nbsp;Por favor, espere...
                    </div>
                    <div class="confirmation-message" id="id_confirmation_message" style="display:none"></div>
                    </div>
                    <div class="courseadminview">
                        <span class="viewcaption">Creación de contenidos
                        </span>		
                        <table width="100%">
                            <tbody>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_1" href="/main/course_description?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_1" src="/main/img/info.gif" alt="Descripción del curso" title="Descripción del curso">
                                        </a>
                                        <a id="istooldesc_1" href="/alumno/descripcioncurso?idcurso='.$idcurso.'&opt=ini" class="" target="_self">
                                            Descripción del curso
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_3" href="/alumnos/documentos?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_3" src="/main/img/folder_document.gif" alt="Documentos" title="Documentos">
                                        </a>
                                        <a id="istooldesc_3" href="/alumno/documentos?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            Documentos
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_25" href="/alumnos/editarunidades?idcurso='.$idcurso.'" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_25" src="/main/img/scormbuilder.gif" alt="Leccion 1" title="Leccion 1">
                                        </a>
                                        <a id="istooldesc_25" href="/alumnos/editarunidades?idcurso='.$idcurso.'" class="" target="_self">
                                            Unidades
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_4" href="/alumnos/lecciones?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_4" src="/main/img/scorms.gif" alt="Lecciones" title="Lecciones">
                                        </a>
                                        <a id="istooldesc_4" href="/alumnos/lecciones?idcurso='.$idcurso.'&iddocpadre=0" class="" target="_self">
                                            Lecciones
                                        </a>
                                        </center>    
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_6" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_6" src="/main/img/quiz.gif" alt="Ejercicios" title="Ejercicios">
                                        </a>
                                        <a id="istooldesc_6" href="main/exercice/exercice.php?cidReq=002" class="" target="_self"> Ejercicios
                                        </a>
                                        </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_16" href="/main/gradebook/index.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_16" src="/main/img/gradebook.gif" alt="Evaluaciones" title="Evaluaciones">
                                        </a>
                                        <a id="istooldesc_16" href="/main/gradebook/index.php?cidReq=002" class="" target="_self">
                                            Evaluaciones
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_17" href="" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_17" src="/main/img/glossary.gif" alt="Glosario" title="Glosario">
                                        </a>
                                        <a id="istooldesc_17" href="/main/glossary/index.php?cidReq=002" class="" target="_self">
                                            Glosario
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="courseadminview">
                        <span class="viewcaption">Interacción
                        </span>
                        <table width="100%">
                            <tbody>
                                <tr valign="top">
                                    <td width="50%">
                                      <center>
                                        <a id="tooldesc_13" href="aprendojugando?idcurso='.$idcurso.'" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_13" src="/main/img/works.gif" alt="Tareas" title="Tareas">
                                        </a>
                                        <a id="istooldesc_13" href="aprendojugando?idcurso='.$idcurso.'" class="" target="_self">
                                            Aprendo Jugando 
                                        </a>
                                      </center>
                                    </td>
                                    <td width="50%">
                                        <center>
                                        <a id="tooldesc_14" href="/main/survey/survey_list.php?cidReq=002" class="" target="_self">
                                            <img class="tool-icon" id="toolimage_14" src="/main/img/survey.gif" alt="Encuestas" title="Encuestas">
                                        </a>
                                        <a id="istooldesc_14" href="" class="" target="_self">
                                            Encuestas
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                    
                <div class="clear">
                    &nbsp;
                </div>';
        }
        return $html;
    }
    
}

