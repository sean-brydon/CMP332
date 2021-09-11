<?php
require_once './Controller/ResponseController.php';

class Helpers
{
    public function isValidDate($date, $format = 'Y-m-d')
    {
        return DateTime::createFromFormat($format, $date);
    }
   
    
    public function arrayToXML($array) { 
        $xml = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $xml .= "<$key>";
                $xml .= $this->arrayToXML($value);
                $xml .= "</$key>";
            } else {
                $xml .= "<$key>$value</$key>";
            }
        }
        return $xml;
    } 

    public static function CheckAuth(){
        $decodedJWT = AuthManager::DecodeJWT();
        if(empty($decodedJWT)){
            return false;
        }
        return true;
    }
}
?>

