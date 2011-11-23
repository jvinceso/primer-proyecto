<?php
class PortalAlumno{
	private $conexion;
	private $total_consultas;
	
		public function PortalAlumno(){
			if(!isset($this->conexion)){

			}
		}
		 
		public function menu(){
			$db = new MySQL();			
			$resultado = $db->consulta("SELECT * FROM menu WHERE estado='A' and Tipo = 'A'");
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
		
		public function tiposUsuario(){
			$db = new MySQL();			
			$resultado = $db->consulta("SELECT * FROM tipousuario WHERE estado='A'");
			$filas=$db->num_rows($resultado);
			
			echo "<select class='chzn-select' name='language_list' onchange='javascript: jumpMenu('parent',this,0);' style='display: none; '>
					<option value='/tesiss/index.php?language=bulgarian'>Elegir</option>";
			if ($filas> 0) 
			{
			   while ($row = mysql_fetch_assoc($resultado)) 
			   {
					echo "<option value=''>".$row['vDescripcion']."</option>";
			   }
			   echo "</select>";
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
