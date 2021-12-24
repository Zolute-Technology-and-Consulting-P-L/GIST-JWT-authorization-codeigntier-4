<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Libraries\Authjwt;

class Example extends ResourceController{
  public function __construct()
    {
    }
  
  public function generateToken(){
     $authjwt = new Authjwt();

    $token = $authjwt->getToken(array("id" => 123, "clientID" => 133233));
    echo $token;
  }
  
  public function verifyToken(){
   $payload = $session->getFlashdata('jwtpayload');
    echo $payload;
  }
}
