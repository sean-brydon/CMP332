<?php
use Firebase\JWT\JWT;

class AuthManager 
{
    // In a real world example this key would be stored in a .env file. Packages like composer dotenv allow this to be easily implemented.
    // For organisation sake for this project this key will just be stored in this class.
    const JWT_PRIVATE_KEY = "CMP332_Project";


    public function IssueJWT($user){
        $date = new DateTime();
        $payload = array(
            "iat" => $date->getTimestamp(),
            "sub" =>$user['id'],
            "username" => $user['username']
        );
        // return encoded jwt
        return JWT::encode($payload, self::JWT_PRIVATE_KEY);
    }

    // function to decode a jwt
    public function DecodeJWT($jwt){
        return JWT::decode($jwt, self::JWT_PRIVATE_KEY);
    }
}
