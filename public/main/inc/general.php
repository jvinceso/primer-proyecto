<?php
class general{
	function construirHead($opt)
	{
		switch ($opt){
		case 1:
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
			break;
		}
	}
}
?>