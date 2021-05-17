<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivosController extends Controller
{
    public $mainip = '172.21.22.136';
    //

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $class = $request->class;
        $idd = $request->idd;
        $r = Auth::user()->roles_id;
        echo $r;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/files/?query=%7B%22metadata.productClass%22%3A%22".$class."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        // print_r($obj);
        $l = count($obj);
        //    echo "<br>".$obj->InternetGatewayDevice->DeviceInfo->ModelName->_value;
        return view('cpe.archivos', ['id' => $r, 'obj' => $obj, 'l' => $l, 'idd' => $idd]);
    }

    public function actu(Request $request)
    {
        $id = $request->id;
        $idd = $request->idd;
        echo $id;

        $post = '{ "name": "download", "file": "'.$id.'"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$idd."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        return redirect()->route('home');
    }

    public function borraractu(Request $request)
    {
        $id = $request->id;
        $idd = $request->idd;
        echo $id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/files/".$id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        return redirect()->route('home');
    }
}
