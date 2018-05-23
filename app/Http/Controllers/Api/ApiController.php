<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vaptcha\Vaptcha;

class ApiController extends Controller
{
    private $vaptcha;

    public function __construct(){
        $this->vaptcha = new Vaptcha(getenv('VAPTCHA_VID'), getenv('VAPTCHA_KEY')); // 这里替换成前面获取到的vid与key
    }

    public function response($status, $msg, $data){
        return response()->json([
            'status' =>  $status,
            'msg' => $msg,
            'data' => $data
        ], $status);
    }

    public function responseSuccess($data){
        return $this->response(200, 'success', $data);
    }

    public function getChallenge(Request $request){
        $data = $this->vaptcha->getChallenge($request->sceneid);
        return $this->responseSuccess($data);
    }

    public function getDownTime(Request $request) {
        $data = $this->vaptcha->downTime($request->data);
        return response()->json($data);
    }

    public function getVaptcha(Request $request)
    {
        $data = $request -> all();
        $response = $this -> vaptcha ->validate($data['challenge'],$data['token']);
        return response() -> json(['status' => $response]);
    }
}