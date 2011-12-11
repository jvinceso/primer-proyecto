<?php
class Application_Model_Includes{
    public function query2array($array_re,$campo_value, $campo_texto){
        $array_temp;
        for($i=0;$i<sizeof($array_re);$i++){
           //aca Pones el Id del campo que quieres pasar al array
           //$array_temp[$array_re[$i]['iTiUsuarioIdTipoUsuario']]=($array_re[$i]['vDescripcion']);
           $array_temp[$array_re[$i][$campo_value]]=($array_re[$i][$campo_texto]);
        }
        return $array_temp;
    }
    public function querytoeach($valor,$campo){//valor
        $temp;
        foreach($valor as $aux){
            $temp[] = $aux[$campo];
        }
        return $temp;
        
    }
    public function dateadd($operacion, $date, $dd=0, $mm=0, $yy=0, $hh=0, $mn=0, $ss=0){ //Recibe el tipo de operación, la fecha, dias, meses, años, horas, minutos, segundos a sumar o restar.
       if($operacion=="resta"){
           $date_r = getdate(strtotime($date));
           $resultado = date("Y-m-d H:i:s", mktime(($date_r["hours"]-$hh),($date_r["minutes"]-$mn),($date_r["seconds"]-$ss),($date_r["mon"]-$mm),($date_r["mday"]-$dd),($date_r["year"]-$yy)));
           return $resultado;
       }
       else{
           $date_r = getdate(strtotime($date));
           $resultado = date("Y-m-d H:i:s", mktime(($date_r["hours"]+$hh),($date_r["minutes"]+$mn),($date_r["seconds"]+$ss),($date_r["mon"]+$mm),($date_r["mday"]+$dd),($date_r["year"]+$yy)));
           return $resultado;
       }
   }
    public function crearCarpeta(){
        $filename="archivos/".$id;
        if(file_exists($filename)){
            return "0";
        }
        else{
            mkdir($filename,0777);
            return "1";
        }
    }
    public function timestampToDate($timestamp){
        $dias = array('','Lun','Mar','Mie','Jue','Vie','Sab','Dom');
        $meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic');
        
        $diasem = date("N",$timestamp);
        $dia = date("j",$timestamp);
        $mes = date("n",$timestamp);
        $anual = date("Y",$timestamp);
        
        return $dias[$diasem].', '.$dia.' '.$meses[$mes].' '.$anual;
        
    }
    
}
