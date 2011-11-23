<?php
require ("../../main/inc/configuration.php");
require_once '../../main/inc/admin/portal_admin.class.php';

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
			<a href="http://localhost:3001/tesiss/index.php">
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
				<a href="http://localhost:3001/tesiss/index.php?logout=logout&amp;uid=3" target="_top">
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
		<div id="social-content">
			<div id="social-content-left">
				<div class="social-menu">
					<script type="text/javascript">      
						function show_icon_edit(element_html) { 
							ident="#edit_image";
							$(ident).show();
						}       
						
						function hide_icon_edit(element_html)  {
							ident="#edit_image";
							$(ident).hide();
						}               
					</script>
					<div class="social-content-image">
						<div class="social-background-content" onmouseout="hide_icon_edit()" onmouseover="show_icon_edit()">
							<center>
								<img src="http://localhost:3001/tesiss/main/img/unknown.jpg?4e9625d0543fc" width="110px">
								<div id="edit_image" class="hidden_message" style="display: none; ">
									<a href="">Editar perfil</a>
								</div>
							</center>
						</div>
					</div>
					<div align="center" class="social-menu-title">
						<span class="social-menu-text1">Menú</span>
					</div>
					<div>
						<ul>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/home.png" alt="Principal" title="Principal">
									<span class="social-menu-text4">Principal</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/instant_message.png" alt="Mensajes" title="Mensajes">
									<span class="social-menu-text4">Mensajes</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/invitation.png" alt="Invitaciones" title="Invitaciones">
									<span class="social-menu-text4">Invitaciones</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/my_shared_profile.png" alt="Mi perfil compartido" title="Mi perfil compartido">
									<span class="social-menu-text4">Mi perfil compartido</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/friend.png" alt="Amigos" title="Amigos">
									<span class="social-menu-text-active">Usuarios</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/group.png" alt="Grupos" title="Grupos">
									<span class="social-menu-text4">Grupos</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/zoom.png" alt="Buscar" title="Buscar">
									<span class="social-menu-text4">Buscar</span>
								</a>
							</li>
							<li>
								<a href="#">
								<img hspace="6" src="http://localhost:3001/tesiss/main/img/icons/16/briefcase.png" alt="Mis archivos" title="Mis archivos">
								<span class="social-menu-text4">Mis archivos</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="social-content-right">
				 
				 
								 
			<h1> Registro</h1>
				<form action="/chamilo/main/auth/inscription.php" method="post" name="registration" id="registration">
					<div class="row">
						<div class="label">
							<span class="form_required">*</span> Apellidos
						</div>
						<div class="formw">	<input size="40" name="lastname" type="text">
						</div>
					</div>
					<div class="row">
						<div class="label">
							<span class="form_required">*</span> Nombre
						</div>
						<div class="formw">	<input size="40" name="firstname" type="text">
						</div>
					</div>
					<div class="row">
						<div class="label">
							<span class="form_required">*</span> Correo electrónico
						</div>
						<div class="formw">	<input size="40" name="email" type="text">
						</div>
					</div>
					<div class="row">
						<div class="label">Código oficial
						</div>
						<div class="formw">	<input size="40" name="official_code" type="text">
						</div>
					</div>
					<div class="row">
						<div class="label">
							<span class="form_required">*</span> Nombre de usuario
						</div>
						<div class="formw">	<input size="40" name="username" type="text">
						</div>
					</div>
					<div class="row">
						<div class="label">
							<span class="form_required">*</span> Contraseña
						</div>
						<div class="formw">	<input size="20" autocomplete="off" name="pass1" type="password">
						</div>
					</div>
					<div class="row">
						<div class="label">
							<span class="form_required">*</span> Confirme la contraseña
						</div>
						<div class="formw">	<input size="20" autocomplete="off" name="pass2" type="password">
						</div>
					</div>
					<div class="row">
						<div class="label">Teléfono
						</div>
						<div class="formw">	<input size="20" name="phone" type="text">
						</div>
					</div>
					<div class="row">
						<div class="label">Notificación por correo de nuevas invitaciones recibidas
						</div>
						<div class="formw">
							<select class="chzn-select" id="extra_mail_notify_invitation" name="extra_mail_notify_invitation" style="display: none; ">
								<option value="1" selected="selected">Inmediatamente</option>
								<option value="8">A diario</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="label">Notificación por correo de nuevo mensaje personal
						</div>
						<div class="formw">
							<select class="chzn-select" id="extra_mail_notify_message" name="extra_mail_notify_message" style="display: none; ">
								<option value="1" selected="selected">Inmediatamente</option>
								<option value="8">A diario</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="label">Notificación por correo de nuevos mensajes recibidos en grupos
						</div>
						<div class="formw">
							<select class="chzn-select" id="extra_mail_notify_group_message" name="extra_mail_notify_group_message" style="display: none; ">
								<option value="1" selected="selected">Inmediatamente</option>
								<option value="8">A diario</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="label">
						</div>
						<div class="formw">	<button class="save" name="submit" type="submit">Registrar usuario</button>
						</div>
					</div>
					<div class="row">
						<div class="label"></div>
						<div class="formw"><span class="form_required">*</span> <small>Contenido obligatorio</small></div>
					</div><input name="_qf__registration" type="hidden" value="">

					<div class="clear">
						&nbsp;
					</div>
				</form>
				<br>

				<div class="clear">&nbsp;</div> <!-- 'clearing' div to make sure that footer stays below the main and right column sections -->
				 
								 
								 
				 
				 
			</div>
		</div>
		<div class="clear">&nbsp;
		</div>
	</div> 
</div>
<div class="push"></div>
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