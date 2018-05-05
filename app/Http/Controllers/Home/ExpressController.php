<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;


class ExpressController extends Controller
{
//    public function seach()
//    {
//        $client = new Client();
//        $url ='http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
//        $RequestData = json_encode([
//            'ShipperCode' => 'YD',
//            'LogisticCode' => '3101727621208'
//        ]);
//        $DataSign = urlencode(base64_encode(md5($RequestData . getenv('KDN_APP_KEY'))));
//        $response = $client->request('POST', $url, ['form_params' => [
//            'RequestData' => $RequestData,
//            'EBusinessID' => getenv('KDN_APP_ID'),
//            'RequestType' => '1002',
//            'DataType' => '2',
//            'DataSign' => $DataSign
//        ]])->getbody();
//        $response = json_decode($response->getContents());
//        dd($response);
//
//    }

    //渲染物流记录查询页面
    public function search_num()
    {
        return view('home/express/seach');
    }
}