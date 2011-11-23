<?php
require ("../main/inc/configuration.php");
require_once '../main/inc/admin/portal_admin.class.php';

$portal = new PortalAdmin();

session_start();
if(!isset($_SESSION['login'])) {
  header("location:". $_configuration['root_web']); 
  exit();
}

/* INICIO head */
$head='<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">';
$head.='<head>';
$head.='<title>'.$_configuration['web_title'].'</title>';
$head.='<style type="text/css" media="screen, projection">';
$head.='/*<![CDATA[*/';
$head.='@import "'.$_configuration['root_web'].'main/css/base.css";@import "'.$_configuration['root_web'].'main/css/tesis/default.css";@import "'.$_configuration['root_web'].'main/css/tesis/course.css";/*]]>*/';
$head.='</style>';
$head.='<style type="text/css" media="print">';
$head.='/*<![CDATA[*/';
$head.='@import "http://localhost:3001/chamilo/main/css/chamilo/print.css";/*]]>*/';
$head.='</style>';
$head.='<script src="'.$_configuration['root_web'].'main/inc/lib/javascript/jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="'.$_configuration['root_web'].'main/inc/lib/javascript/chosen/chosen.jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="'.$_configuration['root_web'].'main/inc/lib/javascript/thickbox.js" type="text/javascript" ></script>';
$head.='<link rel="stylesheet" href="'.$_configuration['root_web'].'main/inc/lib/javascript/thickbox.css" type="text/css" media="projection, screen" />';
$head.='<link rel="stylesheet" href="'.$_configuration['root_web'].'main/inc/lib/javascript/chosen/chosen.css" type="text/css" media="projection, screen" />';
$head.='<script src= "'.$_configuration['root_web'].'main/inc/lib/javascript/jquery.menu.js" type="text/javascript"></script>';
$head.='<script type="text/javascript">
//<![CDATA[
// This is a patch for the "__flash__removeCallback" bug, see FS#4378.
if ( ( navigator.userAgent.toLowerCase().indexOf("msie") != -1 ) && ( navigator.userAgent.toLowerCase().indexOf( "opera" ) == -1 ) ) {
    window.attachEvent( "onunload", function() {
            window["__flash__removeCallback"] = function ( instance, name ) {
                try {
                    if ( instance ) {
                        instance[name] = null ;
                    }
                } catch ( flashEx ) {
                }
            } ;
	});
}
//]]>
</script>';
$head.='<script type="text/javascript" src="http://localhost:3001/chamilo/main/inc/lib/javascript/bxslider/jquery.bxSlider.min.js"></script>
<link rel="stylesheet" href="http://localhost:3001/chamilo/main/inc/lib/javascript/bxslider/bx_styles/bx_styles.css" type="text/css">
<script type="text/javascript">
$(document).ready(function(){
	$("#slider").bxSlider({
		infiniteLoop	: true,
		auto			: true,
		pager			: true,
		autoHover		: true,
		pause			: 10000
	});
});
</script>
<link rel="stylesheet" type="text/css" href="http://localhost:3001/chamilo/main/inc/lib/javascript/dtree/dtree.css" />
<script src="http://localhost:3001/chamilo/main/inc/lib/javascript/dtree/dtree.js" type="text/javascript"></script>
<link rel="shortcut icon" href="http://localhost:3001/tesis/favicon.ico" type="image/x-icon" />';
$head.='</head>';

echo $head;
/* FIN Head*/

/* INICIO EBody */
echo '<body>';
//Verificar archivo de Configuración

/*Inicio EWrapper*/
echo '<div id="wrapper">';

/*Inicio ENavegacion*/
echo '<ul id="navigation">';
$report ='<li class="report">';
$report .='<a href="#" target="_blank" style="margin-left: 50px; ">';
$report .='<img src="http://localhost:3001/tesiss/main/img/bug.large.png" style="vertical-align: middle;" alt="Comunicar un error" title="Dejar un Mensaje"></a></li>';
echo $report;
echo '</ul>';
/*Fin ENavegacion*/

/*Inicio EHeader*/?>
<div id="header">
	<div id="header1">
		<div id="top_corner">
		</div>
		<div id="logo">
			<a href=<?php echo $_configuration['root_web']; ?>>
			<img title="INE Los Pinos - Los Pinos" src="http://localhost:3001/tesiss/main/css/chamilo/images/header-logo.png" alt="INE Los Pinos - Los Pinos">
			</a>
		</div>
		<div id="plugin-header">
		</div>
	</div>
	<div id="header2">
		<div id="Header2Right">
			<ul>
				<li>
				</li>
				<li>
					<a href="http://localhost:3001/tesiss/whoisonline.php" target="_top" title="Usuarios en línea">
						<img width="13px" src="http://localhost:3001/tesiss/main/img/members.gif" title="Usuarios en línea"> 1
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="header3">
		<ul id="logout">
			<li>
				<a href="" target="_top">
					<span>Salir (josuete)</span>
				</a>
			</li>
		</ul>
		<ul>
		<?php
				$portal->menu();
			?>
			
		</ul>
	</div>
	<div id="header4">
		<ul class="bread">
			<li>
				<a class="home" href="http://localhost:3001/tesiss/">
					<img align="middle" src="http://localhost:3001/tesiss/main/css/home.png" alt="Página principal" title="Página principal">
				</a>
			</li>
			<li>
				<span>Mis Cursos</span>
			</li>
		</ul>
	</div>
	<div class="clear">
	</div>
</div>
<?php
/*Fin EHeader*/

/*Inicio EMain*/
?>

<div id="main">
	<div id="submain">
		<div style="margin-left:10%; margin-right:10%;">
			<table align="center">
				<tbody>
					<tr>
						<td>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td width="110" valign="middle" align="left">
											<img src="/chamilo/main/img/mascot.png" alt="Mr. Chamilo" title="Mr. Chamilo">
										</td>
										<td valign="middle" align="left">Bienvenidos a este curso</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="courseintro_icons">
				<p>
					<a href="/chamilo/courses/002/index.php?cidReq=002&amp;intro_cmdEdit=1">
						<img src="http://localhost:3001/chamilo/main/img/icons/22/edit.png" alt="Modificar" title="Modificar">
					</a>
					<a href="/chamilo/courses/002/index.php?cidReq=002&amp;intro_cmdDel=1" onclick="javascript:if(!confirm('Por favor, confirme su elección')) return false;">
						<img src="http://localhost:3001/chamilo/main/img/icons/22/delete.png" alt="Eliminar" title="Eliminar">
					</a>
				</p>
			</div>
		</div>
		<div class="clear">
		</div>	
		<div class="courseadminview" style="border:0px; margin-top: 0px;padding:0px;">
			<div class="normal-message" id="id_normal_message" style="display:none">
				<img src="HTTP://localhost:3001/main/inc/lib/javascript/indicator.gif">&nbsp;&nbsp;Por favor, espere...
			</div>
			<div class="confirmation-message" id="id_confirmation_message" style="display:none">
			</div>
		</div>
		<div class="courseadminview">
			<span class="viewcaption">Creación de contenidos</span>		
				<table width="100%">
					<tbody>
						<tr valign="top">
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_1" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_1" href="http://localhost:3001/chamilo/main/course_description/?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_1" src="http://localhost:3001/chamilo/main/img/info.gif" alt="Descripción del curso" title="Descripción del curso">
								</a>
								<a id="istooldesc_1" href="http://localhost:3001/chamilo/main/course_description/?cidReq=002" class="" target="_self"> Descripción del curso</a>
							</td>
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_3" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_3" href="http://localhost:3001/chamilo/main/document/document.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_3" src="http://localhost:3001/chamilo/main/img/folder_document.gif" alt="Documentos" title="Documentos">
								</a>
								<a id="istooldesc_3" href="http://localhost:3001/chamilo/main/document/document.php?cidReq=002" class="" target="_self"> Documentos</a>
							</td>
						</tr>
						<tr valign="top">
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_4" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_4" href="http://localhost:3001/chamilo/main/newscorm/lp_controller.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_4" src="http://localhost:3001/chamilo/main/img/scorms.gif" alt="Lecciones" title="Lecciones">
								</a>
								<a id="istooldesc_4" href="http://localhost:3001/chamilo/main/newscorm/lp_controller.php?cidReq=002" class="" target="_self"> Lecciones</a>
							</td>
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_5" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_5" href="http://localhost:3001/chamilo/main/link/link.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_5" src="http://localhost:3001/chamilo/main/img/links.gif" alt="Enlaces" title="Enlaces">
								</a>
								<a id="istooldesc_5" href="http://localhost:3001/chamilo/main/link/link.php?cidReq=002" class="" target="_self"> Enlaces</a>
							</td>
						</tr>
						<tr valign="top">
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_6" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_6" href="http://localhost:3001/chamilo/main/exercice/exercice.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_6" src="http://localhost:3001/chamilo/main/img/quiz.gif" alt="Ejercicios" title="Ejercicios">
								</a>
								<a id="istooldesc_6" href="http://localhost:3001/chamilo/main/exercice/exercice.php?cidReq=002" class="" target="_self"> Ejercicios</a>
							</td>
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_7" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_7" href="http://localhost:3001/chamilo/main/announcements/announcements.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_7" src="http://localhost:3001/chamilo/main/img/valves.gif" alt="Anuncios" title="Anuncios">
								</a>
								<a id="istooldesc_7" href="http://localhost:3001/chamilo/main/announcements/announcements.php?cidReq=002" class="" target="_self"> Anuncios</a>
							</td>
						</tr>
						<tr valign="top">
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_16" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_16" href="http://localhost:3001/chamilo/main/gradebook/index.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_16" src="http://localhost:3001/chamilo/main/img/gradebook.gif" alt="Evaluaciones" title="Evaluaciones">
								</a>
								<a id="istooldesc_16" href="http://localhost:3001/chamilo/main/gradebook/index.php?cidReq=002" class="" target="_self"> Evaluaciones</a>
							</td>
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_17" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_17" href="http://localhost:3001/chamilo/main/glossary/index.php?cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_17" src="http://localhost:3001/chamilo/main/img/glossary.gif" alt="Glosario" title="Glosario">
								</a>
								<a id="istooldesc_17" href="http://localhost:3001/chamilo/main/glossary/index.php?cidReq=002" class="" target="_self"> Glosario</a>
							</td>
						</tr>
						<!--
						<tr valign="top">
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_19" src="http://localhost:3001/chamilo/main/img/invisible.gif" alt="Activar" title="Activar">
								</a>
								<a id="tooldesc_19" href="http://localhost:3001/chamilo/main/attendance/index.php?cidReq=002" class="invisible" target="_self">
									<img class="tool-icon" id="toolimage_19" src="http://localhost:3001/chamilo/main/img/attendance_na.gif" alt="Asistencia" title="Asistencia">
								</a>
								<a id="istooldesc_19" href="http://localhost:3001/chamilo/main/attendance/index.php?cidReq=002" class="invisible" target="_self"> Asistencia</a>
							</td>
							
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_20" src="http://localhost:3001/chamilo/main/img/invisible.gif" alt="Activar" title="Activar">
								</a>
								<a id="tooldesc_20" href="http://localhost:3001/chamilo/main/course_progress/index.php?cidReq=002" class="invisible" target="_self">
									<img class="tool-icon" id="toolimage_20" src="http://localhost:3001/chamilo/main/img/course_progress_na.gif" alt="Programación didáctica" title="Programación didáctica">
								</a>
								<a id="istooldesc_20" href="http://localhost:3001/chamilo/main/course_progress/index.php?cidReq=002" class="invisible" target="_self"> Programación didáctica</a>
							</td>
							
						</tr>
						<tr valign="top">
							<td width="50%">
								<a class="make_visible_and_invisible" href="javascript:void(0);">
									<img id="linktool_25" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
								</a>
								<a id="tooldesc_25" href="http://localhost:3001/chamilo/main/newscorm/lp_controller.php?action=view&amp;lp_id=1&amp;id_session=0&amp;cidReq=002" class="" target="_self">
									<img class="tool-icon" id="toolimage_25" src="http://localhost:3001/chamilo/main/img/scormbuilder.gif" alt="Leccion 1" title="Leccion 1">
								</a>
								<a id="istooldesc_25" href="http://localhost:3001/chamilo/main/newscorm/lp_controller.php?action=view&amp;lp_id=1&amp;id_session=0&amp;cidReq=002" class="" target="_self"> Leccion 1</a>
							</td>
						</tr>
						-->
					</tbody>
				</table>
		</div>
						<div class="courseadminview">
							<span class="viewcaption">Interacción</span>
								<table width="100%">
								<tbody>
									<tr valign="top">
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_2" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_2" href="http://localhost:3001/chamilo/main/calendar/agenda.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_2" src="http://localhost:3001/chamilo/main/img/agenda.gif" alt="Agenda" title="Agenda">
											</a>
											<a id="istooldesc_2" href="http://localhost:3001/chamilo/main/calendar/agenda.php?cidReq=002" class="" target="_self"> Agenda</a>
										</td>
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_8" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_8" href="http://localhost:3001/chamilo/main/forum/index.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_8" src="http://localhost:3001/chamilo/main/img/forum.gif" alt="Foros" title="Foros">
											</a>
											<a id="istooldesc_8" href="http://localhost:3001/chamilo/main/forum/index.php?cidReq=002" class="" target="_self"> Foros</a>
										</td>
									</tr>
									<tr valign="top">
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_9" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_9" href="http://localhost:3001/chamilo/main/dropbox/index.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_9" src="http://localhost:3001/chamilo/main/img/dropbox.gif" alt="Compartir documentos" title="Compartir documentos"></a>
													<a id="istooldesc_9" href="http://localhost:3001/chamilo/main/dropbox/index.php?cidReq=002" class="" target="_self"> Compartir documentos</a>
													
										</td>
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_10" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_10" href="http://localhost:3001/chamilo/main/user/user.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_10" src="http://localhost:3001/chamilo/main/img/members.gif" alt="Usuarios" title="Usuarios">
											</a>
											<a id="istooldesc_10" href="http://localhost:3001/chamilo/main/user/user.php?cidReq=002" class="" target="_self"> Usuarios</a>
										</td>
									</tr>
									<tr valign="top">
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_11" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_11" href="http://localhost:3001/chamilo/main/group/group.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_11" src="http://localhost:3001/chamilo/main/img/group.gif" alt="Grupos" title="Grupos">
											</a>
											<a id="istooldesc_11" href="http://localhost:3001/chamilo/main/group/group.php?cidReq=002" class="" target="_self"> Grupos</a>
										</td>
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_12" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_12" class="" href="javascript: void(0);" onclick="javascript: window.open('http://localhost:3001/chamilo/main/chat/chat.php?cidReq=002','window_chat002',config='height='+380+', width='+625+', left=2, top=2, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no')" target="_self">
												<img class="tool-icon" id="toolimage_12" src="http://localhost:3001/chamilo/main/img/chat.gif" alt="Chat" title="Chat">
											</a>
											<a id="istooldesc_12" class="" href="javascript: void(0);" onclick="javascript: window.open('http://localhost:3001/chamilo/main/chat/chat.php?cidReq=002','window_chat002',config='height='+380+', width='+625+', left=2, top=2, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no')" target="_self">Chat</a>
										</td>
									</tr>
									<tr valign="top">
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_13" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_13" href="http://localhost:3001/chamilo/main/work/work.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_13" src="http://localhost:3001/chamilo/main/img/works.gif" alt="Tareas" title="Tareas">
											</a>
											<a id="istooldesc_13" href="http://localhost:3001/chamilo/main/work/work.php?cidReq=002" class="" target="_self"> Tareas</a>
										</td>
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_14" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_14" href="http://localhost:3001/chamilo/main/survey/survey_list.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_14" src="http://localhost:3001/chamilo/main/img/survey.gif" alt="Encuestas" title="Encuestas">
											</a>
											<a id="istooldesc_14" href="http://localhost:3001/chamilo/main/survey/survey_list.php?cidReq=002" class="" target="_self"> Encuestas</a>
										</td>
									</tr>
									<!--
									<tr valign="top">
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_15" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_15" href="http://localhost:3001/chamilo/main/wiki/index.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_15" src="http://localhost:3001/chamilo/main/img/wiki.gif" alt="Wiki" title="Wiki">
											</a>
											<a id="istooldesc_15" href="http://localhost:3001/chamilo/main/wiki/index.php?cidReq=002" class="" target="_self"> Wiki</a>
										</td>
										<td width="50%">
											<a class="make_visible_and_invisible" href="javascript:void(0);">
												<img id="linktool_18" src="http://localhost:3001/chamilo/main/img/visible.gif" alt="Desactivar" title="Desactivar">
											</a>
											<a id="tooldesc_18" href="http://localhost:3001/chamilo/main/notebook/index.php?cidReq=002" class="" target="_self">
												<img class="tool-icon" id="toolimage_18" src="http://localhost:3001/chamilo/main/img/notebook.gif" alt="Notas personales" title="Notas personales">
											</a>
											<a id="istooldesc_18" href="http://localhost:3001/chamilo/main/notebook/index.php?cidReq=002" class="" target="_self"> Notas personales</a>
										</td>
									</tr>
									-->
								</tbody>
							</table>
						</div>
						<div class="courseadminview">
							<span class="viewcaption">Administración</span>		
								<table width="100%">
									<tbody>
										<tr valign="top">
											<td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;
												<a id="tooldesc_24" href="http://localhost:3001/chamilo/main/course_info/maintenance.php?cidReq=002" class="" target="_self">
													<img class="tool-icon" id="toolimage_24" src="http://localhost:3001/chamilo/main/img/backup.gif" alt="Mantenimiento del curso" title="Mantenimiento del curso">
												</a>
												<a id="istooldesc_24" href="http://localhost:3001/chamilo/main/course_info/maintenance.php?cidReq=002" class="" target="_self"> Mantenimiento del curso</a>
											</td>
											<td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;
												<a id="tooldesc_22" href="http://localhost:3001/chamilo/main/tracking/courseLog.php?cidReq=002" class="" target="_self">
													<img class="tool-icon" id="toolimage_22" src="http://localhost:3001/chamilo/main/img/statistics.gif" alt="Informes" title="Informes">
												</a>
												<a id="istooldesc_22" href="http://localhost:3001/chamilo/main/tracking/courseLog.php?cidReq=002" class="" target="_self"> Informes</a>
											</td>
										</tr>
										<tr valign="top">
											<td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;
												<a id="tooldesc_23" href="http://localhost:3001/chamilo/main/course_info/infocours.php?cidReq=002" class="" target="_self">
													<img class="tool-icon" id="toolimage_23" src="http://localhost:3001/chamilo/main/img/reference.gif" alt="Configuración del curso" title="Configuración del curso">
												</a>
												<a id="istooldesc_23" href="http://localhost:3001/chamilo/main/course_info/infocours.php?cidReq=002" class="" target="_self"> Configuración del curso</a>
											</td>
											
										</tr>
									</tbody>
								</table>	
						</div>
<div class="clear">&nbsp;</div> <!-- 'clearing' div to make sure that footer stays below the main and right column sections -->
</div>
	<div class="push"></div>
</div>

<?php
/*Fin EMain*/
echo '</div>';
/*Fin EWrapper*/

/*Inicio Footer*/
?>
<div id="footer">
	<div id="bottom_corner">
	</div>
	<div class="copyright">
		<div align="right">Responsable : 
			<a href="mailto:administrados@lospinos.com" name="clickable_email_link">Tello, Vinces</a>
		</div>
		<div align="right">Plataforma
			<a href="http://www.lospinos.com/" target="_blank">Elearning v. 1.0.0.1</a>© 2011
		</div>
	</div>
	<div class="footer_emails">
		<div id="plugin-footer">
		</div><br>
		<div style="clear:both">
		</div>
	</div>
</div>
<?php
/*Fin Footer*/

echo '<script>
$(document).ready( function() {
    $(".chzn-select").chosen();
});
</script>';
$body .= '</body>';
echo $body;
/* FIN Ebody */
?>