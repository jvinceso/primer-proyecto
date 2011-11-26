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
    function querytoeach($valor,$campo){//valor
        $temp;
        foreach($valor as $aux){
            $temp[] = $aux[$campo];
        }
        return $temp;
        
    }


}
