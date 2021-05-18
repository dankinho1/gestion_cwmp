<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParametrosController extends Controller
{
    public $mainip = '192.168.0.101';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $se = $request->ser;
        $vp = $request->ipdhcp;
        $ssid = $request->ssid;
        $r = Auth::user()->roles_id;
        echo $se;
        echo $vp;
        echo $ssid;
        $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.SSID", "'.$ssid.'", "xsd:string"]]}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l = count($obj);
        $l2 = count($obj2);
        //print_r($obj);
        //print_r($objpost);
        if(!$obj) {
            echo "OBJ2 EX";
            return view('cpe.tr143mod', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";
            return view('cpe.tr098mod', ['id' => $r, 'obj' => $obj, 'l' => $l]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verpar(Request $request)
    {
        //
        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $se = $request->ser;
        $r = Auth::user()->roles_id;
          echo $id;

          /*
        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $post = '{"name": "refreshObject", "objectName": "Device"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost2 = json_decode($output);*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l = count($obj);
        $l2 = count($obj2);
        //print_r($obj);
        //print_r($obj2);
        if(!$obj) {
            echo "OBJ2 EX";
            return view('cpe.tr143', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";
            return view('cpe.tr098', ['id' => $r, 'obj' => $obj, 'l' => $l]);
        }
    }

    public function modpar(Request $request)
    {
        //
        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $se = $request->ser;
        $r = Auth::user()->roles_id;
        echo $id;

        /*$post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $post = '{"name": "refreshObject", "objectName": "Device"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost2 = json_decode($output);*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l = count($obj);
        $l2 = count($obj2);
        //print_r($obj);
        //print_r($obj2);
        if(!$obj) {
            echo "OBJ2 EX";
            return view('cpe.tr143mod', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";
            return view('cpe.tr098mod', ['id' => $r, 'obj' => $obj, 'l' => $l]);
        }
    }
}
