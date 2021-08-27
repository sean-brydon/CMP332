<?php

class Post {
    public function GetBodyContents(){
        return json_decode(file_get_contents('php://input'),true);
    }
}