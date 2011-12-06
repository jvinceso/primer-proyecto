<?php
class PortalDocente{
	private $conexion;
	private $total_consultas;
	
		public function PortalDocente(){
			if(!isset($this->conexion)){

			}
		}
		 
		public function menu(){
			$db = new MySQL();			
			$resultado = $db->consulta("SELECT * FROM menu WHERE estado='A' and Tipo='D'");
			$filas=$db->num_rows($resultado);

			if ($filas> 0) 
			{
			   while ($row = mysql_fetch_assoc($resultado)) 
			   {
					if((basename($_SERVER[PHP_SELF])==$row['url'])){
						echo "<li id='current'>";
					}
					else{
						echo "<li>";
					}
					echo "<a href=".$row['url']." target='_top'>
						<span id='tab_active'>".$row['Descripcion']."</span>";
					echo "</a></li>";
			   }
			}
		}
		
		public function fetch_array($consulta){ 
			return mysql_fetch_array($consulta);
		}
		
		public function num_rows($consulta){ 
			return mysql_num_rows($consulta);
		}
		
		public function getTotalConsultas(){
			return $this->total_consultas;
		}
}?>
