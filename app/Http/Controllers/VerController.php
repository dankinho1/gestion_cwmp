<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $r = Auth::user()->roles_id;
        echo $r;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        // print_r($obj);
        $l = count($obj);
        //    echo "<br>".$obj->InternetGatewayDevice->DeviceInfo->ModelName->_value;
        return view('cpe.ver', ['id' => $r, 'obj' => $obj, 'l' => $l]);
    }
}
