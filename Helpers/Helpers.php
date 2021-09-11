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
        // We try and catch here to ensure token isnt expired or invalid
        try{
            $decodedJWT = AuthManager::DecodeJWT();
        }catch(Exception $e){
            return false;
        }

// If no token retrn false
        if(empty($decodedJWT)){
            return false;
        }
        
        return true;
    }
}
?>

