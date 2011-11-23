<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>
INE Los Pinos - Los Pinos</title>
<style type="text/css" media="screen, projection">
/*<![CDATA[*/
@import "http://localhost:3001/tesiss/main/css/base.css";@import "http://localhost:3001/tesiss/main/css/chamilo/default.css";@import "http://localhost:3001/tesiss/main/css/chamilo/course.css";/*]]>*/
</style>
<style type="text/css" media="print">
/*<![CDATA[*/
@import "http://localhost:3001/tesiss/main/css/chamilo/print.css";/*]]>*/
</style>

<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery.min.js" type="text/javascript" ></script>
<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/chosen/chosen.jquery.min.js" type="text/javascript" ></script>

<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/thickbox.js" type="text/javascript" ></script>
<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/thickbox.css" type="text/css" media="projection, screen" />
<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/chosen/chosen.css" type="text/css" media="projection, screen" />

<link rel="top" href="http://localhost:3001/tesiss/index.php" title="" />
<link rel="courses" href="http://localhost:3001/tesiss/main/auth/courses.php" title="otros cursos" />
<link rel="profil" href="http://localhost:3001/tesiss/main/auth/profile.php" title="Mi perfil" />
<link href="http://www.chamilo.org/documentation.php" rel="Help" />
<link href="http://www.chamilo.org/team.php" rel="Author" />
<link href="http://www.chamilo.org" rel="Copyright" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Generator" content="Chamilo 1" />

<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery-ui/smoothness/jquery-ui-1.8.16.custom.css" type="text/css">
<script type="text/javascript" src="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery-ui/smoothness/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery-ui/default.css" type="text/css">
<script type="text/javascript"> 
var counter_image = 1;
function remove_image_form(id_elem1) {
    var elem1 = document.getElementById(id_elem1);
    elem1.parentNode.removeChild(elem1);
    counter_image--;
    var filepaths = document.getElementById("filepaths");
    if (filepaths.childNodes.length < 3) {
        var link_attach = document.getElementById("link-more-attach");
        if (link_attach) {
            link_attach.innerHTML='<a href="javascript://" onclick="return add_image_form()">Agregar otro fichero</a>';
        }
    }
}

function add_image_form() {
    // Multiple filepaths for image form
    var filepaths = document.getElementById("filepaths");
    if (document.getElementById("filepath_"+counter_image)) {
        counter_image = counter_image + 1;
    }  else {
        counter_image = counter_image;
    }
    var elem1 = document.createElement("div");
    elem1.setAttribute("id","filepath_"+counter_image);
    filepaths.appendChild(elem1);
    id_elem1 = "filepath_"+counter_image;
    id_elem1 = "'"+id_elem1+"'";
    document.getElementById("filepath_"+counter_image).innerHTML = "<input type=\"file\" name=\"attach_"+counter_image+"\"  size=\"20\" />&nbsp;<a href=\"javascript:remove_image_form("+id_elem1+")\"><img src=\"http://localhost:3001/tesiss/main/img/delete.gif\"></a>";

    if (filepaths.childNodes.length == 3) {
        var link_attach = document.getElementById("link-more-attach");
        if (link_attach) {
            link_attach.innerHTML="";
        }
    }
}

function validate_text_empty (str,msg) {
    var str = str.replace(/^\s*|\s*$/g,"");
    if (str.length == 0) {
        alert(msg);
        return true;
    }
}

jQuery(document).ready(function() {
    /* Binds a tab id in the url */
    $("#tab_browse").bind("tabsselect", function(event, ui) {
        window.location.href=ui.tab;
    });
    $("#tabs").tabs();
    $("#tab_browse").tabs();

    var valor = "topic_";

    $(".head").click(function() {
                $(this).next().next().slideToggle("fast");
                image_clicked = $("#" + this.id + " img").attr("src");
                image_clicked_info = image_clicked.split("/");
                image_real_clicked = image_clicked_info[image_clicked_info.length-1];
                image_path = image_clicked.split("img");
                current_path = image_path[0]+"img/";
                if (image_real_clicked == "div_show.gif") {
                    current_path = current_path+"div_hide.gif";
                    $("#" + this.id + " img").attr("src", current_path);
                } else {
                    current_path = current_path+"div_show.gif";
                    $("#" + this.id + " img").attr("src", current_path)
                }
                return false;
            }).next().next().hide();

   // anchor for current topic
   if (valor) {
        $("#"+valor).show();
        window.location = document.URL+"#"+valor;
   }

});
</script>

</head>
<body dir="ltr" >
<div class="skip">
<ul>
<li><a href="#menu">Ir al menú</a></li>
<li><a href="#content" accesskey="2">Ir al contenido</a></li>
</ul>
</div>
<div id="wrapper"><ul id="navigation">    <li class="help">                   
        <a href="http://localhost:3001/tesiss/main/help/help.php?open=Groups&height=400&width=600" class="thickbox" title="Ayuda">
        <img src="http://localhost:3001/tesiss/main/img/help.large.png" alt="Ayuda" title="Ayuda" />
        </a>
    </li>
    <li class="report">
        <a href="http://support.chamilo.org/projects/chamilo-18/wiki/How_to_report_bugs" target="_blank">
        <img src="http://localhost:3001/tesiss/main/img/bug.large.png" style="vertical-align: middle;" alt="Comunicar un error" title="Comunicar un error"/></a>
    </li>
</ul><div id="header"><div id="header1"><div id="top_corner"></div><div id="logo"><a href="http://localhost:3001/tesiss/index.php"  > <img title="INE Los Pinos - Los Pinos" src="http://localhost:3001/tesiss/main/css/chamilo/images/header-logo.png" alt="INE Los Pinos - Los Pinos"  /></a></div><div id="plugin-header"></div></div><div id="header2"><div id="Header2Right"><ul><li><li><a href="http://localhost:3001/tesiss/whoisonline.php" target="_top" title="Usuarios en línea" ><img width="13px" src="http://localhost:3001/tesiss/main/img/members.gif" title="Usuarios en línea"> 1</a></li></li></ul></div></div><div id="header3"><ul id="logout"><li><a href="http://localhost:3001/tesiss/index.php?logout=logout&uid=3" target="_top"><span>Salir (josuete)</span></a></li></ul><ul><li><a  href="http://localhost:3001/tesiss/index.php" target="_top"><span id="tab_active">Página principal</span></a></li><li><a  href="http://localhost:3001/tesiss/user_portal.php" target="_top"><span id="tab_active">Mis cursos</span></a></li><li><a  href="http://localhost:3001/tesiss/main/calendar/myagenda.php?view=month&" target="_top"><span id="tab_active">Mi agenda</span></a></li><li><a  href="http://localhost:3001/tesiss/main/auth/my_progress.php" target="_top"><span id="tab_active">Mi progreso</span></a></li><li id="current"><a  href="http://localhost:3001/tesiss/main/social/home.php" target="_top"><span id="tab_active">Red social</span></a></li></ul></div><div id="header4"><ul class="bread"  > <li  > <a class="home" href="http://localhost:3001/tesiss/"  > <img align="middle" src="http://localhost:3001/tesiss/main/css/home.png" alt="Página principal" title="Página principal"  /></a></li><li  > <a href="home.php?" class="breadcrumb breadcrumb0" target="_top"><span>Social</span></a></li><li  > <a href="groups.php?" class="breadcrumb breadcrumb1" target="_top"><span>Grupos</span></a></li><li  > <span>Lista de grupos</span></li></ul></div><div class="clear"></div></div><div id="main"><div id="submain"><div id="social-content"><div id="social-content-left"><div class="social-menu"><script type="text/javascript">      
            function show_icon_edit(element_html) { 
                ident="#edit_image";
                $(ident).show();
            }       
            
            function hide_icon_edit(element_html)  {
                ident="#edit_image";
                $(ident).hide();
            }               
            </script><div class="social-content-image"><div class="social-background-content" onmouseout="hide_icon_edit()" onmouseover="show_icon_edit()"><center><img src=http://localhost:3001/tesiss/main/img/unknown.jpg?4e963a04570e7 width="110px" /><div id="edit_image" class="hidden_message" style="display:none"><a href="http://localhost:3001/tesiss/main/auth/profile.php">Editar perfil</a></div></center></div></div><div align="center" class="social-menu-title"><span class="social-menu-text1">Menú</span></div><div><ul><li><a href="http://localhost:3001/tesiss/main/social/home.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/home.png" alt="Principal" title="Principal"  /><span class="social-menu-text4" >Principal</span></a></li><li><a href="http://localhost:3001/tesiss/main/messages/inbox.php?f=social"><img hspace="6" src="http://localhost:3001/tesiss/main/img/instant_message.png" alt="Mensajes" title="Mensajes"  /><span class="social-menu-text4" >Mensajes</span></a></li><li><a href="http://localhost:3001/tesiss/main/social/invitations.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/invitation.png" alt="Invitaciones" title="Invitaciones"  /><span class="social-menu-text4" >Invitaciones</span></a></li><li><a href="http://localhost:3001/tesiss/main/social/profile.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/my_shared_profile.png" alt="Mi perfil compartido" title="Mi perfil compartido"  /><span class="social-menu-text4" >Mi perfil compartido</span></a></li>
                  <li><a href="http://localhost:3001/tesiss/main/social/friends.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/friend.png" alt="Amigos" title="Amigos"  /><span class="social-menu-text4" >Amigos</span></a></li>
                  <li><a href="http://localhost:3001/tesiss/main/social/groups.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/group.png" alt="Grupos" title="Grupos"  /><span class="social-menu-text-active" >Grupos</span></a></li><li><a href="http://localhost:3001/tesiss/main/social/search.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/zoom.png" alt="Buscar" title="Buscar"  /><span class="social-menu-text4" >Buscar</span></a></li><li><a href="http://localhost:3001/tesiss/main/social/myfiles.php"><img hspace="6" src="http://localhost:3001/tesiss/main/img/icons/16/briefcase.png" alt="Mis archivos" title="Mis archivos"  /><span class="social-menu-text4" >Mis archivos</span></a></li></ul>
                  </div></div></div><div id="social-content-right"><div id="tab_browse"  > <ul  > <li  > <a href="#tab_browse-1"  > Mis grupos</a></li><li  > <a href="#tab_browse-2"  > Lo último</a></li><li  > <a href="#tab_browse-3"  > Populares</a></li></ul><div id="tab_browse-1"  > <p  > </p></div><div id="tab_browse-2"  > <p  > </p></div><div id="tab_browse-3"  > <p  > </p></div></div></div></div><div class="clear">&nbsp;</div> <!-- 'clearing' div to make sure that footer stays below the main and right column sections -->
</div> <!-- end of #main" started at the end of banner.inc.php -->
</div> <!-- end of #main" started at the end of banner.inc.php -->

<div class="push"></div>
</div> <!-- end of #wrapper section -->

<div id="footer"> <!-- start of #footer section -->
<div id="bottom_corner"></div>
<div class="copyright"><div align="right">Responsable : <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#97;&#100;&#109;&#105;&#110;&#105;&#115;&#116;&#114;&#97;&#100;&#111;&#115;&#64;&#108;&#111;&#115;&#112;&#105;&#110;&#111;&#115;&#46;&#99;&#111;&#109;" name="clickable_email_link">Tello, Renzo</a></div><div align="right">Plataforma <a href="http://www.chamilo.org/" target="_blank">Chamilo 1.8.8.4</a>&copy; 2011</div></div><div class="footer_emails"><div id="plugin-footer"></div><br><div style="clear:both"></div></div></div> <!-- end of #footer --><script>
$(document).ready( function() {
    $(".chzn-select").chosen();
});
</script>
</body>
</html>