<?php

namespace App\Libraries;

use Exception;
use \Firebase\JWT\JWT;
use CodeIgniter\HTTP\IncomingRequest;

class Authjwt
{
    // This function converts a string into slug format
    public function getToken($data)
    {
        $key = $this->getSecretKey();
        $iat = time(); // current timestamp value
        $nbf = $iat + 0;
        $exp = $iat + 2628000;

        $payload = array(
            "iss" => base_url(),
            "aud" => base_url(),
            "iat" => $iat, // issued at
            "nbf" => $nbf, //not before in seconds
            "exp" => $exp, // expire time in seconds
            "data" => $data,
        );

        $jwt = JWT::encode($payload, $key);
        return $jwt;
    }

    public function verifyToken()
    {
        $request = service('request');
        $key = $this->getSecretKey();
        if ($request->hasHeader('Authorization')) {
            $authHeader = $request->getHeader("Authorization");
            $authHeader = $authHeader->getValue();
            $token = $authHeader;
        } else {
            $token = "";
        }


        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {

                return $decoded;
            }
        } catch (Exception $ex) {

            return false;
        }
    }

    private function getSecretKey()
    {
        return 'SOMERANDOMSTRING';
    }
}
