<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\Authjwt;
 
class Userauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if user not logged in
        $authjwt = new Authjwt();

        if($payload = $authjwt->verifyToken()){
            //set session
            session()->setFlashdata('jwtpayload',$payload->data);
        }else{
            $response = service('response');
$response->setStatusCode(401);
$response->setBody(json_encode(array("error"=>"Unautorized!")));
        return $response;
        
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
