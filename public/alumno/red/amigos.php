<?php
$includePath = dirname(__FILE__);
$main_configuration_file_path = $includePath.'/main/inc/configuration.php';
$already_installed = false;
if (file_exists($main_configuration_file_path)) {
    require_once $main_configuration_file_path;
    $already_installed = true;
} else {
    $_configuration = array();
}

/* INICIO head */
$head='<head>';
$head.='<title>Colegio Los Pinos - Los Pinos</title>';
$head.='<style type="text/css" media="screen, projection">';
$head.='@import "http://localhost:3001/tesiss/main/css/base.css";@import "http://localhost:3001/tesiss/main/css/chamilo/default.css";@import "http://localhost:3001/tesiss/main/css/chamilo/course.css";';
$head.='</style>';
$head.='<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/chosen/chosen.jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/thickbox.js" type="text/javascript" ></script>';
$head.='<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/thickbox.css" type="text/css" media="projection, screen" />';
$head.='<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/chosen/chosen.css" type="text/css" media="projection, screen" />';
$head.='<script src= "http://localhost:3001/tesiss/main/inc/lib/javascript/jquery.menu.js" type="text/javascript"></script>';
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
			<li>
				<a href="../alumno_principal.php" target="_top">
					<span id="tab_active">Página principal</span>
				</a>
			</li>
			<li>
				<a href="../alumno_cursos.php" target="_top">
					<span id="tab_active">Mis cursos</span>
				</a>
			</li>
			<li>
				<a href="../alumno_agenda.php" target="_top">
					<span id="tab_active">Mi agenda</span>
				</a>
			</li>
			<li>
				<a href="../alumno_progreso.php" target="_top">
					<span id="tab_active">Mi progreso</span>
				</a>
			</li>
			<li id="current">
				<a href="../alumno_redsocial.php" target="_top">
					<span id="tab_active">Red social</span>
				</a>
			</li>
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
								<a href="../alumno_redsocial.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/home.png" alt="Principal" title="Principal">
									<span class="social-menu-text4">Principal</span>
								</a>
							</li>
							<li>
								<a href="mensajes.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/instant_message.png" alt="Mensajes" title="Mensajes">
									<span class="social-menu-text4">Mensajes</span>
								</a>
							</li>
							<li>
								<a href="invitaciones.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/invitation.png" alt="Invitaciones" title="Invitaciones">
									<span class="social-menu-text4">Invitaciones</span>
								</a>
							</li>
							<li>
								<a href="perfilcompartido.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/my_shared_profile.png" alt="Mi perfil compartido" title="Mi perfil compartido">
									<span class="social-menu-text4">Mi perfil compartido</span>
								</a>
							</li>
							<li>
								<a href="amigos.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/friend.png" alt="Amigos" title="Amigos">
									<span class="social-menu-text-active">Amigos</span>
								</a>
							</li>
							<li>
								<a href="grupos.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/group.png" alt="Grupos" title="Grupos">
									<span class="social-menu-text4">Grupos</span>
								</a>
							</li>
							<li>
								<a href="buscar.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/zoom.png" alt="Buscar" title="Buscar">
									<span class="social-menu-text4">Buscar</span>
								</a>
							</li>
							<li>
								<a href="archivos.php">
								<img hspace="6" src="http://localhost:3001/tesiss/main/img/icons/16/briefcase.png" alt="Mis archivos" title="Mis archivos">
								<span class="social-menu-text4">Mis archivos</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="social-content-right">
				Su lista de contactos está vacía<br><br>
				<a href="">Pruebe a encontrar algunos amigos</a>
			</div>
		</div>
		<div class="clear">&nbsp;
		</div>
	</div> 
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