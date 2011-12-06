<?php
class db
{
	private $cn;
	private $rs;
		
	public function __construct($serverName = "localhost", $user = "root", $pass = "VINCES_900709", $db = "venta_pollos")
	{
		$this->cn = new mysqli($serverName, $user, $pass, $db);
	}
	
	public function dbExecute($query) {
		$this->rs = $this->cn->query($query);	
		return $this->rs;
	}
	
	public function getInsertedId()
	{
		return $this->cn->insert_id;
	}
	
	public function getAffectedRows()
	{
		return $this->cn->affected_rows;
	}
	
}
?>