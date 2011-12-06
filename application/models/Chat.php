<?php
class Application_Model_Chat{
    public function init(){
        define('DBPATH','localhost');
        define('DBUSER','root');
        define('DBPASS','root');
        define('DBNAME','bdpinos');

//        session_start();

        global $dbh;
        $dbh = mysql_connect(DBPATH,DBUSER,DBPASS);
        mysql_selectdb(DBNAME,$dbh);

        if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
        if ($_GET['action'] == "sendchat") { sendChat(); } 
        if ($_GET['action'] == "closechat") { closeChat(); } 
        if ($_GET['action'] == "startchatsession") { startChatSession(); } 

        if (!isset($_SESSION['chatHistory'])) {
                $_SESSION['chatHistory'] = array();	
        }

        if (!isset($_SESSION['openChatBoxes'])) {
                $_SESSION['openChatBoxes'] = array();	
        }
    }
    
    public function chatHeartbeat() {
	
	$sql = "select * from chat where (chat.to = '".mysql_real_escape_string($_SESSION['username'])."' AND recd = 0) order by id ASC";
	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($_SESSION['username'])."' and recd = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
?>
{
		"username": "<?php echo $_SESSION['username'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}

function sendChat() {
	$from = $_SESSION['username'];
	$to = $_POST['to'];
	$message = $_POST['message'];

	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);

	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
	$query = mysql_query($sql);
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}

//MODIFICACION USERS CONECT

public function usuariosconectados(){
      $ahora = time();
      $limite = $ahora-24*60;
      $dbAdapter = Zend_Db_Table::getDefaultAdapter();
      $periodo=new Application_Model_PeriodoAcademico();
      $idperido=$periodo->getPeriodoActualId();
      $result=$dbAdapter->query("SELECT DISTINCT usu.vUsuUsuario, usu.vUsuApellidoPat, usu.vUsuApellidoMat, usu.vUsuNombre
FROM log lg
INNER JOIN usuarios usu ON usu.iUsuIdUsuario = lg.iUsuIdUsuario
INNER JOIN cursosusuarios cusu ON cusu.Usuarios_iUsuIdUsuario = usu.iUsuIdUsuario
INNER JOIN cursos cur ON cur.iCursIdCursos = cusu.Cursos_iCursIdCursos
INNER JOIN seccion sec ON sec.iSeccIdSeccion = cur.Seccion_iSeccIdSeccion
INNER JOIN grado grad ON grad.iGradoIdGrado = sec.Grado_iGradoIdGrado
WHERE lg.iLogTimeStamp > '".$limite."'
AND lg.cAcciIdAccion = 'A'
AND grad.PeriodoAcademico_iPerAcaIdPeriodoAcademico = '$idperido'
");
      $rst=$result->fetchAll();
      if(sizeof($rst)>0){
          return $rst;
      }else{
          return "NADA";
      }
            
}

}