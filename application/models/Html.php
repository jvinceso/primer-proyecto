<?php
class Application_Model_Html{
    /*protected $layoutt;
    public function setLayoutt($layoutt){
        $this->layoutt=$layoutt;
    }
    
    public function getLayoutt($layoutt){
        return $this->layoutt;
    }*/
    public function crearDoctype(){
        return '
            <!DOCTYPE html>
            <html lang="es-ES">
            <meta charset="UTF-8"><head>';
    }
        
    public function closeHead(){
     return '</head>';
    }
    
    public function setTitle($title){
     return '<title>'.$title.'</title>';
    }
 
    public function cargarCss($css=null){
        $res='
            <link type="text/css" rel="stylesheet" href="/main/inc/lib/javascript/thickbox.css"  media="projection, screen" />
            <link type="text/css" rel="stylesheet" href="/main/inc/lib/javascript/chosen/chosen.css"  media="projection, screen" />
            <link type="text/css" rel="stylesheet" href="/main/inc/lib/javascript/dtree/dtree.css" />
            <link type="text/css" rel="stylesheet" href="/main/inc/lib/javascript/bxslider/bx_styles/bx_styles.css" >
            <style type="text/css" media="screen, projection">
                /*<![CDATA[*/@import "/main/css/base.css";@import "/main/css/tesis/default.css";@import "/main/css/tesis/course.css";/*]]>*/
            </style>
            <style type="text/css" media="print">
                /*<![CDATA[*/@import "/main/css/tesis/print.css";/*]]>*/
            </style>
            
            <link type="text/css" rel="stylesheet" media="all" href="/css/chat.css" />';
        if ($css==null){
            return $res;
         }
         else{
            return $res.$css;
         }
    }
 
    public function cargarScript($script=null){
        $res='
            <script type="text/javascript" src="/main/inc/lib/javascript/jquery.min.js"  ></script>
            <script type="text/javascript" src="/main/inc/lib/javascript/chosen/chosen.jquery.min.js"  ></script>
            <script type="text/javascript" src="/main/inc/lib/javascript/thickbox.js" ></script>
            <script type="text/javascript" src= "/main/inc/lib/javascript/jquery.menu.js" ></script>
            <script type="text/javascript">
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
            </script>
            <script type="text/javascript" src="/main/inc/lib/javascript/bxslider/jquery.bxSlider.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){
                    $("#slider").bxSlider({
                            infiniteLoop	: true,
                            auto		: true,
                            pager		: true,
                            autoHover		: true,
                            pause		: 10000
                    });
            });
            </script>
            <script type="text/javascript" src="/main/inc/lib/javascript/dtree/dtree.js" ></script>
            
            ';
        
//        if ($script==null){
//         return $res;     
//         }
//         else{
//            return $res.$script;
//         }
            if (Zend_Session::sessionExists()){
                return $res.'
            <script type="text/javascript" src="/js/chat/chat.js"></script>'.$script;
            }
            else{
            return $res.$script;
         }
    }
    
    public function crearFooter(){
        return '
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
    
        <script>
            $(document).ready( function() {
                $(".chzn-select").chosen();
            });
        </script>

        </body>
        </html>';
    }

    public function crearWrapper($navigation=null, $header1=null,$header2=null,$header3=null,$header4=null, $content=null, $menuwrapper=null,$submain=null){
        //Inicio del Div Wrapper y ul Navigation
        print '
            <div id="wrapper">
                <ul id="navigation">';
        if (!$navigation==null){
            print $navigation;
        }
        else{
//            print '
//                    <li class="report">
//                            <a href="#" target="_blank">
//                            <img src="/main/img/chat.png" style="vertical-align: middle;" alt="Comunicar un error" title="Dejar un Mensaje">
//                              <a>1 Tello</a>
//                              <a>2 Tello</a>
//                            </a>
//                    </li>';  
            if (Zend_Session::sessionExists()){
            print '
                    <li class="report">
                            <img src="/main/img/chat.png" style="vertical-align: middle;" alt="Chatea con tus amigos" title="Dejar un Mensaje">
                            <div id="chatdiv">';
$chat= new Application_Model_Chat();
$result=$chat->usuariosconectados();
$arratemp="";
    if($result!="NADA"){
        foreach($result as $aux){
        print '<div>
                <a onclick="javascript:chatWith(\''.strtoupper($aux['vUsuUsuario']).'\')" href="javascript:void(0)">
                 <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/372617_1420530801_1579660712_q.jpg" class="pic">
                 <span class="name">'.$aux['vUsuNombre'].' '.$aux['vUsuApellidoPat'].' '.$aux['vUsuApellidoMat'].'</span>              
                </a>
              </div>';
        }
    }else{
        print'<div>No Hay Usuarios</div>';
    }

print '
    </div>
 </li>'; 
                }
        }
        //Fin de Div Navigation
        print '</ul>';
        
        //Inicio del div Header
        print '<div id="header">';
        
            //Inicio del div header1
            print '<div id="header1">';
            if (!$header1==null){
                print $header1;
            }
            else{
                print '
                    <div id="top_corner">
                    </div>
                    <div id="logo">
                        <a href="/"/>
                            <img title="INE Los Pinos - Los Pinos" src="/main/css/tesis/images/header-logo.png" alt="INE Los Pinos - Los Pinos">
                        </a>
                    </div>
                    <div id="plugin-header">
                    </div>';                
            }
            //Fin del Div header1
            print '</div>';
            
            //Inicio del div header2
            print '<div id="header2">';
            if (!$header2==null){
                print $header2;
            }
            else{
                print '
                    <div id="Header2Right">
                        <ul>
                            <li>
                            </li>
                            <li>
                                <a href="" target="_top" title="Usuarios en línea">
                                    <img width="13px" src="/main/img/members.gif" title="Usuarios en línea"> 1
                                </a>
                            </li>
                        </ul>
                    </div>';                
            }
            //Fin del Div header2
            print '</div>';
            
            if (!$header3==null){
                 //Inicio del div header3
                print '<div id="header3">';
                print $header3;
                
                //Fin del Div header3
                print '</div>';
            } 
            
            //Inicio del div header4
            print '<div id="header4">';
            if (!$header4==null){
                print $header4;
            }/*
            else{
                print '';                
            }*/
            //Fin del Div header4
            print '</div>';
            
            //Inicio del Div Clear
            print '
                <div class="clear">
                </div>';
            //Fin del Div Clear
           
        //Fin del Div Header
        print '</div>';
        
        //Inicio del Div Main y Sub Main
        print '<div id="main">';
            print '<div id="submain">';
                    if (!$content==null){
                          print '<div id="content" class="maincontent">';
                          print $content;
                          print '</div>';
                    }
                    if(!$submain==null){
                        print $submain;
                    }
                    
                
                //Inicio div menu-wrapper
                print '<div id="menu-wrapper">';
                    if (!$menuwrapper==null){
                        print $menuwrapper;
                    }
                    else{
                        print '';
                    }
                //Fin del div menu-wrapper
                print '</div>';
                
                print '<div class="clear">&nbsp;
                       </div>';
            //Fin del div submain
            print '</div>';
            
        //Fin del div main 
        print '</div>'; 
        
        //Div push
        print '
            <div class="push">
            </div>';
        
    //Fin del div wrapper 
    print '</div>'; 
    }
    
    public function crearContentAjax($submain=null){
        if(!$submain==null){
            print $submain;
        }else{
           print 'ERROR NO HAY CONTENIDO';
        }
    } 
}

?>
