<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ExpressController extends Controller
{
    public function seach($number)
    {
        $client = new Client();
        $url = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
        $RequestData = json_encode([
            'LogisticCode' => $number
        ]);
        $DataSign = urlencode(base64_encode(md5($RequestData . getenv('KDN_APP_KEY'))));
        $response = $client->request('POST', $url, ['form_params' => [
            'RequestData' => $RequestData,
            'EBusinessID' => getenv('KDN_APP_ID'),
            'RequestType' => '2002',
            'DataType' => '2',
            'DataSign' => $DataSign
        ]])->getbody();
        $response = json_decode($response->getContents());
        $code = $response->Shippers[0]->ShipperCode;
        $shippername = $response->Shippers[0]->ShipperName;
        $RequestData1 = json_encode([
            'ShipperCode' => $code,
            'LogisticCode' => $number
        ]);
        $DataSign1 = urlencode(base64_encode(md5($RequestData1 . getenv('KDN_APP_KEY'))));
        $response1 = $client->request('POST', $url, ['form_params' => [
            'RequestData' => $RequestData1,
            'EBusinessID' => getenv('KDN_APP_ID'),
            'RequestType' => '1002',
            'DataType' => '2',
            'DataSign' => $DataSign1
        ]])->getbody();
        $response1 = json_decode($response1->getContents());
        $traces = $response1->Traces;
        return view('home/order/express_search', ['shippername' => $shippername, 'number' => $number, 'table' => $traces]);
    }

    //渲染物流记录查询页面
    public function search_num()
    {
        return view('home/express/seach');
    }

    public function SyExpNo(Request $request)
    {
        $ExpNo = $request -> all()['ExpNo'];
        $client = new Client();
        $url = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
        $RequestData = json_encode([
            'LogisticCode' => $ExpNo
        ]);
        $DataSign = urlencode(base64_encode(md5($RequestData . getenv('KDN_APP_KEY'))));
        $response = $client->request('POST', $url, ['form_params' => [
            'RequestData' => $RequestData,
            'EBusinessID' => getenv('KDN_APP_ID'),
            'RequestType' => '2002',
            'DataType' => '2',
            'DataSign' => $DataSign
        ]])->getbody();
        return $response -> getContents();
    }

    public function SearchTrackByExpNo(Request $request)
    {
        $data = $request -> all();
        $ExpCode = $data['ExpCode'];
        $ExpNo = $data['ExpNo'];
        $client = new Client();
        $url = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
        $RequestData = json_encode([
            'ShipperCode' => $ExpCode,
            'LogisticCode' => $ExpNo
        ]);
        $DataSign = urlencode(base64_encode(md5($RequestData . getenv('KDN_APP_KEY'))));
        $response = $client->request('POST', $url, ['form_params' => [
            'RequestData' => $RequestData,
            'EBusinessID' => getenv('KDN_APP_ID'),
            'RequestType' => '1002',
            'DataType' => '2',
            'DataSign' => $DataSign
        ]])->getbody();
        return $response -> getContents();

    }
}