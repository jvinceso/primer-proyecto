<?php
require_once("../../main/inc/mysql.php");
class Consultas{
	private $inserts = 0;
	private $join = NULL;
	private $primaryKey = FALSE;
	private $query;
	private $row;
	
	private $fetchMode = "assoc";
	
	private $select="SELECT *";
	private $SQL;
	private $table;
	
	private $fields;
	private $values;
	private $where = NULL;	
	private $Rs = NULL;
	
	private $encode = TRUE;
	private $caching = FALSE;
		
	private $db;
	
	public function __construct()
	{
		if(!isset($this->conexion)){
// 			$db=new MySQL();
		}		
	}
/*Obtener Datos - get*/
	public function getWhere($table, $where, $limit = 0, $offset = 0) {		
	$_where="";
	echo "where en consulta :";
	print_r($where);
	echo "</br>";
		foreach($where as $field => $value) {
			$_where.= "$field = '$value' AND ";
		}
		
		$_where = rtrim($_where, "AND ");
		print_r($_where);echo "</br>";
		print_r($limit);echo "</br>";
		print_r($offset);echo "</br>";
		if($limit === 0 and $offset === 0) {
			$query = "$this->select FROM $table WHERE $_where"; 
		} else {
			$query = "SELECT $this->fields FROM $table WHERE $_where LIMIT $limit, $offset";	
		}
		echo $query;
		echo "</br>";
		return $this->data($query);
	}

	private function getTable($table,$prefix="") {
		$table = str_replace($prefix, "", $table);

		$this->table($table);
		
		return $table; 	
	}	
/*Contadores - Count*/
	public function countAll($table = NULL) {
		if($table) {
			$query = "SELECT COUNT(*) AS Total FROM $table";
		} else {
			$query = "SELECT COUNT(*) AS Total FROM $this->table";	
		}	
		$data = $this->data($query);
		return isset($data[0]["Total"]) ? $data[0]["Total"] : 0;
	}	

	public function countBySQL($SQL, $table = NULL) {		
		if($SQL	=== "") {
			return FALSE;
		}
		
		$query = "SELECT COUNT(*) AS Total FROM $this->table WHERE $SQL";
		
		$data = $this->data($query);
		
		return isset($data[0]["Total"]) ? $data[0]["Total"] : 0;
	}

/* Busquedas - Find */	
	public function find($ID, $table = NULL) {
		if($table) {
			$this->table($table);
		}

		$query = "SELECT $this->fields FROM $this->table WHERE $this->primaryKey = $ID";
	
		return $this->data($query);
	}
/* Encuentra todos y ordena */
	public function findAll($table = NULL, $group = NULL, $order = NULL, $limit = NULL) {
		$SQL = NULL;
		
		if(!is_null($group)) {
			$SQL .= " GROUP BY ".$group;
		}
		
		if(!$order) {
			$SQL .= "";		
		} elseif(!is_null($order)) {
			$SQL .= " ORDER BY ". $order;
		} elseif(is_null($order)) {
			$SQL .= " ORDER BY $this->primaryKey";
		}
		
		if(!is_null($limit)) {
			$SQL .= " LIMIT ". $limit;
		}
		
		if($table) {
			$this->table($table);	
		}

		$query = "SELECT $this->fields FROM $this->table$SQL";

		return $this->data($query);
	}
	
	/*Inserts*/
	
	public function insert($table = NULL, $data = NULL) {
		if(!$table) {
			if(!$this->table or !$this->fields or !$this->values) {
				return FALSE;
			} else {
				$table  = $this->table;
				$fields = $this->fields;
				$values = $this->values;
			}
		}
		
		$table = $this->getTable($table);
		
		if(is_array($data)) {
			$count   = count($data) - 1;
			$_fields = NULL;
			$_values = NULL;
			$i 		 = 0;
			
			foreach($data as $field => $value) {
				if($i === $count) {
					$_fields .= "$field";
					$_values .= "'$value'";
				} else {
					$_fields .= "$field, ";
					$_values .= "'$value', ";	
				}
						
				$i++;	
			}
			
			$query = "INSERT INTO $table ($_fields) VALUES ($_values)";
		} else {
			return FALSE;
		}	
		
		$this->Rs = $db->consulta($query);

		if($this->Rs) {
			$insertID = $db->getTotalConsultas();						
			return $insertID;
		}
		
		return FALSE;
	}
	
	/*Busca por atributo*/
	public function findBy($field = NULL, $value = NULL, $table = NULL, $group = NULL, $order = NULL, $limit = NULL) {
		$SQL = NULL;

		if($table) {
			$this->table($table);
		}
		
		if(!is_null($group)) {
			$SQL .= " GROUP BY " . $group;
		}
		
		if(!$order) {
			$SQL .= "";
		} elseif(!is_null($order)) {
			$SQL .= " ORDER BY " . $order;
		} elseif($order === "") {
			$SQL .= " ORDER BY $this->primaryKey";
		}
		
		if(!is_null($limit)) {
			$SQL .= " LIMIT ". $limit;
		}

		if(is_array($field)) {
			$i = 0;
			$_SQL = NULL;

			foreach($field as $_field => $_value) {
				$_SQL .= "$_field = '$_value' AND ";	
			}
			
			$_SQL = rtrim($_SQL, "AND ");
			
			$query = "SELECT $this->fields FROM $this->table WHERE $_SQL";
		} else {
			$query = "SELECT $this->fields FROM $this->table WHERE $field = '$value'$SQL";
		}

		return $this->data($query);
	}	
/*Busca por (condicion)SQL=Where*/	
	public function findBySQL($SQL, $table = NULL, $group = NULL, $order = NULL, $limit = NULL) {					
		if(!is_null($group)) {
			$SQL .= " GROUP BY ". $group;
		}
		
		if($table) {
			$this->table($table);
		}
		
		if(is_null($order)) { 
			$SQL .= "";		
		} elseif(!is_null($order)) {  
			$SQL .= " ORDER BY ". $order;
		} elseif($order === "") { 
			$SQL .= " ORDER BY $this->primaryKey";
		}

		if(!is_null($limit)) {
			$SQL .= " LIMIT ". $limit;
		}
		
		$query = "SELECT $this->fields FROM $this->table WHERE $SQL";

		return $this->data($query);
	}	
/* Tablas */	
	public function table($table, $fields = "*") {
		$this->table  = $table;  
		$this->fields = $fields;
		
		$data = $this->data("SHOW COLUMNS FROM $this->table");
		
		if(is_array($data)) {
			foreach($data as $column) {
				if($column["Key"] === "PRI") {
					$this->primaryKey = $column["Field"];					
					return $this->primaryKey;
				}
			}
		}		
		return NULL;
	}
/*Delete*/	
	public function delete($ID = 0, $table = NULL) {	
		if($ID === 0) {
			return FALSE;		
		}

		if($table) {
			$this->table($table);
		}
		
		$query = "DELETE FROM $this->table WHERE $this->primaryKey = $ID";
		
		return ($this->Consultas->query($query)) ? TRUE : FALSE;
	}	
    /**Make a deletion by a SQL query*/
	public function deleteBySQL($SQL = NULL, $table = NULL) {
		if(!$SQL) {
			return FALSE;
		}

		if($table) {
			$this->table($table);
		}
		
		$query = "DELETE FROM $this->table WHERE $SQL";
		
		return ($this->Consultas->query($query)) ? TRUE : FALSE;
	}
    /*** @param string *@return void*/
	public function join($table, $condition, $position = FALSE) {
		if(!$table or !$condition) {
			return FALSE;	
		}
		
		if(!$position) {
			$this->join = "JOIN $table ON $condition";
		} else {
			$this->join = "$position JOIN $table ON $condition";	
		}
	}
	public function like($data, $match = NULL, $position = "both") {
		if(is_array($data)) {
			$count  = count($data) - 1;
			$_where = NULL;
			$i      = 0;
			
			foreach($data as $field => $value) {
				if($i === $count) {
					if($position === "both") {
						$_where .= "$field LIKE '%$match%'";
					} elseif($position === "before") {
						$_where .= "$field LIKE '%$match'";
					} elseif($postion === "after") {
						$_where .= "$field LIKE '$match%'";
					}
				} else {
					if($position === "both") {
						$_where .= " AND $field LIKE '%$match%'";
					} elseif($position === "before") {
						$_where .= " AND $field LIKE '%$match'";
					} elseif($postion === "after") {
						$_where .= " AND $field LIKE '$match%'";
					}	
				}
			}
		} else {
			if(is_null($this->where)) {
				if($position === "both") {
					$this->where  = "WHERE $data LIKE '%$match%'";
				} elseif($position === "before") {
					$this->where  = "WHERE $data LIKE '%$match'";
				} elseif($position === "after") {
					$this->where  = "WHERE $data LIKE '$match%'";
				}
			} else {
				if($position === "both") {
					$this->where .= " AND $data LIKE '%$match%'";	
				} elseif($position === "before") {
					$this->where .= " AND $data LIKE '%$match'";
				} elseif($position === "after") {
					$this->where .= " AND $data LIKE '$match%'";
				}
			}
		}
	}	
   	/*not like   */	
	public function notLike($data, $match = FALSE, $position = "both") {
		if(is_array($data)) {
			$count  = count($data) - 1;
			$_where = NULL;
			$i      = 0;
			
			foreach($data as $field => $value) {
				if($i === $count) {
					if($position === "both") {
						$_where .= "$field NOT LIKE '%$match%'";
					} elseif($position === "before") {
						$_where .= "$field NOT LIKE '%$match'";
					} elseif($postion === "after") {
						$_where .= "$field NOT LIKE '$match%'";
					}
				} else {
					if($position === "both") {
						$_where .= " AND $field NOT LIKE '%$match%'";
					} elseif($position === "before") {
						$_where .= " AND $field NOT LIKE '%$match'";
					} elseif($postion === "after") {
						$_where .= " AND $field NOT LIKE '$match%'";
					}	
				}
			}
			
			if(!is_null($this->where)) {
				$this->where .= " OR $field NOT IN ($values)";
			}
		} else {
			if(!is_null($this->where)) {
				$this->where .= " OR $field NOT IN ('$data')";
			}
		}
	}
   	/*or like */	
	public function orLike($data, $match = FALSE, $position = "both") {
		if(is_array($data)) {
			$count  = count($data) - 1;
			$_where = NULL;
			$i      = 0;
			
			foreach($data as $field => $value) {
				if($i === $count) {
					if($position === "both") {
						$_where .= "$field LIKE '%$match%'";
					} elseif($position === "before") {
						$_where .= "$field LIKE '%$match'";
					} elseif($postion === "after") {
						$_where .= "$field LIKE '$match%'";
					}
				} else {
					if($position === "both") {
						$_where .= " $field LIKE '%$match%' OR";
					} elseif($position === "before") {
						$_where .= " $field LIKE '%$match' OR";
					} elseif($postion === "after") {
						$_where .= " $field LIKE '$match%' OR";
					}	
				}
			}
			
			if(!is_null($this->where)) {
				$this->where .= " OR $field NOT IN ($values)";
			}
		} else {
			if(!is_null($this->where)) {
				$this->where .= " OR $field NOT IN ('$data')";
			}
		}
	}
   	/*or where in*/	
	public function orWhereIn($field, $data) {
		if(is_array($data)) {
			for($i = 0; $i <= count($data) - 1; $i++) {
				if($i === count($data) - 1) {
					$values .= "'$data[$i]'";	
				} else {
					$values .= "'$data[$i]', ";
				}
			}
			
			if(!is_null($this->where)) {
				$this->where .= " OR $field IN ($values)";
			}
		} else {
			if(!is_null($this->where)) {
				$this->where .= " OR $field IN ('$data')";
			}
		}
	}
   	/*Not in*/	
	public function orWhereNotIn($field, $data) {
		if(is_array($data)) {
			for($i = 0; $i <= count($data) - 1; $i++) {
				if($i === count($data) - 1) {
					$values .= "'$data[$i]'";	
				} else {
					$values .= "'$data[$i]', ";
				}
			}
			
			if(!is_null($this->where)) {
				$this->where .= " OR $field NOT IN ($values)";
			}
		} else {
			if(!is_null($this->where)) {
				$this->where .= " OR $field NOT IN ('$data')";
			}
		}
	}	
/*Consulta libre*/	
	public function query($query) {
		$db= new MySQL();
		print_r("Consulta Query".$query."</br>");
		$rg=$db->consulta($query);
		return $rg;
// 		$this->free();
	}
	
	private function data($query) {
			if($query === "") {
				return FALSE;
			}
			if($this->Rs!=null){$this->Rs = $this->query($query);}
		//	$this->Rs = $this->query($query);
			
			if($this->rows() === 0) {
				return FALSE;
			} else {
				while($row = $this->fetch($this->rows())) {
					$rows[] = $row;
				}
			}
	
			$this->free();
	
			if($this->encode) {
				$data = isset($rows) ? $this->encoding($rows) : FALSE;
			} else {
				$data = isset($rows) ? $rows : FALSE;
			}
	
			return $data;
	}	

	private function data_BAK($query) {
		print_r("Consulta Data ".$query."</br>");
			if($query === "") {
				return FALSE;	
			}
			
			$this->Rs = $this->query($query);
			
			if($this->rows() === 0) {
				return FALSE;			
			} else {
				while($row = $this->fetch($this->rows())) {
					$rows[] = $row;	
				}
			}	
			$this->free();
			$data = isset($rows) ? $rows : FALSE;
			print_R("</br> Retorno Data : ",$data);
			return $data;
	}
	public function rows() {
		return (!$this->Rs) ? FALSE : $this->rows();	
	}	
	public function fetch($count = 0) {
		print_r("</br>Valor Count del Fetch : ",$count);
		return (!$this->Rs) ? FALSE : $this->Consultas->fetch($count);
	}		
	public function free(){
	 	return ($this->Rs) ? $this->Rs->free() : FALSE;
	}
	public function encode($encode = TRUE) {
		$this->encode = $encode;
	}
	private function encoding($rows) {
		$this->encode = TRUE;
		
		if(is_object($rows)) { 
			$array[] = get_object_vars($rows);
	
			$key1  = array_keys($array);
			$size1 = sizeof($key1);			
			
			for($i = 0; $i < $size1; $i++) {
				$key2  = array_keys($array[$i]);
				$size2 = sizeof($key2);
				
				for($j = 0; $j < $size2; $j++) {	
					if($array[$i][$key2[$j]] === "1") {
						if(stristr($key2[$j], "ID")) {
							$data[$i][$key2[$j]] = 1;
						} else {
							$data[$i][$key2[$j]] = TRUE;
						}
					} elseif($array[$i][$key2[$j]] === "0") {
						$data[$i][$key2[$j]] = FALSE;
					} else {
						$data[$i][$key2[$j]] = encode($array[$i][$key2[$j]]);								
					}
				}
			}
			
			return $data;			
		} elseif(is_array($rows)) {
			$key1  = array_keys($rows);
			$size1 = sizeof($key1);			
			
			for($i = 0; $i < $size1; $i++) {
				$key2  = array_keys($rows[$i]);
				$size2 = sizeof($key2);
				
				for($j = 0; $j < $size2; $j++) {				
					if($rows[$i][$key2[$j]] === "1") {
						if(stristr($key2[$j], "ID")) {
							$data[$i][$key2[$j]] = 1;
						} else {
							$data[$i][$key2[$j]] = TRUE;
						}
					} elseif($rows[$i][$key2[$j]] === "0") {
						$data[$i][$key2[$j]] = FALSE;
					} else {
						$data[$i][$key2[$j]] = encode($rows[$i][$key2[$j]]);								
					}								
				}
			}
			
			return $data;
		} else {
			return FALSE;
		}				
	}
			
}
?>