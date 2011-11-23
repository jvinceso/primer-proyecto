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
								<a href="">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/home.png" alt="Principal" title="Principal">
									<span class="social-menu-text-active">Principal</span>
								</a>
							</li>
							<li>
								<a href="red/mensajes.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/instant_message.png" alt="Mensajes" title="Mensajes">
									<span class="social-menu-text4">Mensajes</span>
								</a>
							</li>
							<li>
								<a href="red/invitaciones.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/invitation.png" alt="Invitaciones" title="Invitaciones">
									<span class="social-menu-text4">Invitaciones</span>
								</a>
							</li>
							<li>
								<a href="red/perfilcompartido.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/my_shared_profile.png" alt="Mi perfil compartido" title="Mi perfil compartido">
									<span class="social-menu-text4">Mi perfil compartido</span>
								</a>
							</li>
							<li>
								<a href="red/amigos.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/friend.png" alt="Amigos" title="Amigos">
									<span class="social-menu-text4">Amigos</span>
								</a>
							</li>
							<li>
								<a href="red/grupos.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/group.png" alt="Grupos" title="Grupos">
									<span class="social-menu-text4">Grupos</span>
								</a>
							</li>
							<li>
								<a href="red/buscar.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/zoom.png" alt="Buscar" title="Buscar">
									<span class="social-menu-text4">Buscar</span>
								</a>
							</li>
							<li>
								<a href="red/archivos.php">
								<img hspace="6" src="http://localhost:3001/tesiss/main/img/icons/16/briefcase.png" alt="Mis archivos" title="Mis archivos">
								<span class="social-menu-text4">Mis archivos</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="social-content-right">
				<div class="social-box-main1">
					<div class="rounded_div" style="width:280px">
						<div>
							<p><strong>Nombre</strong><br>
							<span class="social-groups-text4">Tello Villarruel, Josue</span>
							</p>
						</div>
						<div>
							<p><strong>Correo electrónico</strong><br>
							<span class="social-groups-text4">josue_11_12t@hotmail.com</span>
							</p>
						</div>
						<div class="box_description_group_actions">
							<a href="">
								<img hspace="6" src="http://localhost:3001/tesiss/main/img/profile_edit.png" alt="Editar perfil" title="Editar perfil">Editar perfil
							</a>
						</div>
					</div>
					<div class="social-box-right"><br>
						<form method="GET" action="http://localhost:3001/tesiss/main/social/search.php">
							<table cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td>
											<div id="search_label">
												<b>Buscar</b> (Usuarios, Grupos)
													<div>
														<input type="text" size="25" value="" name="q"> &nbsp;
														<button class="search" type="submit" value="search">Buscar</button>
													</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</form><br>
					</div>
				</div>
			</div>
		</div>
		<div class="clear">&nbsp;
		</div>
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