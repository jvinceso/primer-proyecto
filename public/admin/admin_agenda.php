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
				<span>Mi Agenda</span>
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
		<div class="actions">
			<a href="#">
			<!--<a href="/chamilo/main/calendar/myagenda.php?action=view&amp;view=month">-->
				<img src="http://localhost:3001/chamilo/main/img/icons/32/month.png" alt="Vista mensual" title="Vista mensual">
			</a>
			<a href="#">
			<!--<a href="/chamilo/main/calendar/myagenda.php?action=view&amp;view=week">-->
				<img src="http://localhost:3001/chamilo/main/img/icons/32/7days.png" alt="Vista semanal" title="Vista semanal">
			</a>
			<!--<a href="/chamilo/main/calendar/myagenda.php?action=view&amp;view=day">-->
			<a href="#">
				<img src="http://localhost:3001/chamilo/main/img/icons/32/1day.png" alt="Vista diaria" title="Vista diaria">
			</a>
		</div>
		<table id="agenda_list">
			<tbody>
				<tr>
					<th width="10%">
						<!--<a href="/chamilo/main/calendar/myagenda.php?coursePath=&amp;courseCode=&amp;action=view&amp;view=month&amp;month=9&amp;year=2011">-->
						<a href="#">
							<img src="http://localhost:3001/chamilo/main/img/action_prev.png" alt="Anterior" title="Anterior">
						</a>
					</th>
					<th width="80%" colspan="5"><br>
						<h3>Octubre 2011</h3>
					</th>
					<th width="10%">
						<!--<a href="/chamilo/main/calendar/myagenda.php?coursePath=&amp;courseCode=&amp;action=view&amp;view=month&amp;month=11&amp;year=2011">-->
						<a href="#">
							<img src="http://localhost:3001/chamilo/main/img/action_next.png" alt="Siguiente" title="Siguiente">
						</a>
					</th>
				</tr>
				<tr>
					<td class="weekdays">Lun</td>
					<td class="weekdays">Mar</td>
					<td class="weekdays">Mié</td>
					<td class="weekdays">Jue</td>
					<td class="weekdays">Vie</td>
					<td class="weekdays">Sáb</td>
					<td class="weekdays">Dom</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
					</td>
					<td>
					</td>
					<td>
					</td>
					<td>
					</td>
					<td class="days_week">
						<div class="agenda_day"> 1</div>
					</td>
					<td class="days_week">
						<div class="agenda_day"> 2</div>
					</td>
				</tr>
				<tr><td class="days_week"><div class="agenda_day"> 3</div></td><td class="days_week"><div class="agenda_day"> 4</div></td><td class="days_week"><div class="agenda_day"> 5</div></td><td class="days_week"><div class="agenda_day"> 6</div></td><td class="days_week"><div class="agenda_day"> 7</div></td><td class="days_week"><div class="agenda_day"> 8</div></td><td class="days_week"><div class="agenda_day"> 9</div></td></tr><tr><td class="days_week"><div class="agenda_day"> 10</div></td><td class="days_week"><div class="agenda_day"> 11</div></td><td class="days_week"><div class="agenda_day"> 12</div></td><td class="days_week"><div class="agenda_day"> 13</div></td><td class="days_week"><div class="agenda_day"> 14</div></td><td class="days_week"><div class="agenda_day"> 15</div></td><td class="days_week"><div class="agenda_day"> 16</div></td></tr><tr><td class="days_week"><div class="agenda_day"> 17</div></td><td class="days_week"><div class="agenda_day"> 18</div></td><td class="days_week"><div class="agenda_day"> 19</div></td><td class="days_week"><div class="agenda_day"> 20</div></td><td class="days_week"><div class="agenda_day"> 21</div></td><td class="days_week"><div class="agenda_day"> 22</div></td><td class="days_week"><div class="agenda_day"> 23</div></td></tr><tr><td class="days_week"><div class="agenda_day"> 24</div></td><td class="days_week"><div class="agenda_day"> 25</div></td><td class="days_today" style="width:10%;"><div class="agenda_day"> 26</div><div class="rounded_div_agenda" style="background-color:#CAFFAA;"><i>09:53 h.</i> <div style="float:right"> <a href="http://localhost:3001/chamilo/main/calendar/agenda.php?cidReq=002&amp;day=26&amp;month=10&amp;year=2011#26"> <img src="http://localhost:3001/chamilo/main/img/icons/22/course.png" alt="Matematica Curso" title="Matematica Curso"></a></div> <div> <a id="course_1_1_0" class="opener" href="#"> Creación del curso</a></div></div></td><td class="days_week"><div class="agenda_day"> 27</div></td><td class="days_week"><div class="agenda_day"> 28</div></td><td class="days_week"><div class="agenda_day"> 29</div></td><td class="days_week"><div class="agenda_day"> 30</div></td></tr><tr><td class="days_week"><div class="agenda_day"> 31</div></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table><div class="clear">&nbsp;</div> <!-- 'clearing' div to make sure that footer stays below the main and right column sections -->
	</div>
	<div class="push">
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