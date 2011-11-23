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
				<span>Mi Red Social</span>
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
		<?php
		if (!isset($_SESSION['plataforma']))
		{
		?>
			<div class="admin_section">
					<h4>
						<img src="http://localhost:3001/chamilo/main/img/members.gif" alt="Usuarios" title="Usuarios"> Usuarios
					</h4>
					<div style="list-style-type:none">
						<form method="get" action="user_list.php">
							<input type="text" name="keyword" value="">
							<button class="search" type="submit"> Buscar</button>
						</form>
					</div>
				<ul>        
					<li><a href="#">Lista de usuarios</a></li>
					<li><a href="#">Ver indicadores de usuarios</a></li>
					<li><a href="#">Añadir usuarios</a></li>
				</ul>

			</div>
			<div class="admin_section">
				<h4><img src="http://localhost:3001/chamilo/main/img/course.gif" alt="Cursos" title="Cursos"> Cursos</h4>
				<div style="list-style-type:none">
					<form method="get" action="course_list.php">
						<input type="text" name="keyword" value="">
						<button class="search" type="submit">Buscar</button>
					</form>
				</div>
				<ul>
					<li><a href="#">Lista de cursos</a></li>
					<li><a href="#">Crear un curso</a></li>
					<li><a href="#">Categorías de cursos</a></li>
					<li><a href="#">Inscribir usuarios en un curso</a></li>
				</ul>
			</div>

			<div class="admin_section">
				<h4><img src="http://localhost:3001/chamilo/main/img/settings.png" alt="Plataforma" title="Plataforma"> Plataforma</h4>
				<ul>
					<li><a href="#">Validar Periodo Académico</a></li>
					<li><a href="#">Parámetros de configuración</a></li>
					<li><a href="#">Anuncios de la plataforma</a></li>
					<li><a href="#">Configuración de la página principal</a></li>
					<li><a href="#">Estadísticas </a></li>
					<li><a href="#">Agenda global </a></li>
					<li><a href="#">Información del sistema</a></li>
				</ul>
			</div>


			<div class="admin_section">
				<h4><img width="22px" src="http://localhost:3001/chamilo/main/img/blackboard_blue.png" alt="Sesiones de formación" title="Sesiones de formación"> Sesiones de formación</h4>
				<div style="list-style-type:none">
					<form method="POST" action="session_list.php">
						<input type="text" name="keyword_name" value="">
						<button class="search" type="submit">Buscar</button>
					</form>
				</div>
				<ul>        
					<li><a href="session_list.php">Lista de sesiones</a></li>     
					<li><a href="../coursecopy/copy_course_session.php">Copiar cursos de una sesión a otra</a></li>
					<li> <a href="usergroups.php"> Clases</a></li>    </ul>
			</div>
		<?php
		}
		else
		{
			
		}
		?>
	
		

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