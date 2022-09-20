<?php 
class Encrypt extends CApplicationComponent{
    private  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
    private function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
    public  function encode($value){ 
        if(!$value){return false;}
        $text = $value;
        $encode1 = $this->safe_b64encode($value);
        $encode2 = $this->safe_b64encode($encode1);
        $encode3 = $this->safe_b64encode($encode2);
        return trim($encode3); 
    }
    public function decode($value){
        if(!$value){return false;}
        $text = $value;
        $decode1 = $this->safe_b64decode($value);
        $decode2 = $this->safe_b64decode($decode1);
        $decode3 = $this->safe_b64decode($decode2);
        return trim($decode3); 
    }
}
?>