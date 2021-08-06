<?php

require_once('./Model/Response.php');

class ResponseController
{

//    private $_success;
//    private $_httpStatusCode;
//    private $_messages = array();
//    private $_data;
//    private $_toCache = false;
//    private $_responseData = array();
    public static function ErrorResponse($message,$httpStatusCode=404) {
        $messages = array();
        array_push($messages,$message);
        $response = new Response(false,$httpStatusCode,$messages,null,false);
        $response->send();
    }

    public static function SuccessResponse($message="message",$httpStatusCode=200,$data,$cache=false) {
        $messages = array();
        array_push($messages,$message);
        $response = new Response(true,$httpStatusCode,$messages,$data,$cache);
        $response->send();
    }
}