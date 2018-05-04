<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class ExpressController extends Controller
{
    public function send()
    {
        $client = new Client();
        $url ='http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
        $RequestData = json_encode([
            'ShipperCode' => '',
            'LogisticCode' => ''
        ]);
        $body = array(
            'RequestData' => $RequestData,
            'EBusinessID' => getenv('KDN_APP_ID'),
            'RequestType' => '1002',
            'DataType' => '2',
        );
        $body['DataSign'] = urlencode(base64_encode(md5($RequestData.getenv('KDN_APP_KEY'))));
        $response = $client -> request('POST',$url,['form_params' => ['body' => $body]]);
        //dd($response);
        echo (string) $response -> getbody();

    }
}