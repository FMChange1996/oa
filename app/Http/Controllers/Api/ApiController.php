<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Vaptcha\Vaptcha;

class ApiController extends Controller
{

    public function getVaptcha()
    {
        $vid = getenv('VAPTCHA_VID');
        $key = getenv('VAPTCHA_KEY');
        $v = new Vaptcha($vid,$key);
        return $v -> getChallenge();
    }
}