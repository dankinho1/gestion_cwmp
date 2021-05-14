<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParametrosController extends Controller
{
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
        $se = $request->ser;
        $vp = $request->ipdhcp;
        $r = Auth::user()->roles_id;
        echo $se;
        echo $vp;
        $post = '{"name":"setParameterValues", "parameterValues":[["Device.DHCPv4.Server.Pool.4.IPRouters", "'.$vp.'", "xsd:string"]]}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:7557/devices/E48D8C-hAP%2520mini-7CCB08ADDAA1/tasks?connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l = count($obj);
        $l2 = count($obj2);
        //print_r($obj);
        print_r($objpost);
        /*if(!$obj) {
            echo "OBJ2 EX";
            return view('cpe.tr143mod', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";
            return view('cpe.tr098mod', ['id' => $r, 'obj' => $obj, 'l' => $l]);
        }*/
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
        $se = $request->ser;
        $r = Auth::user()->roles_id;
          echo $se;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
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
        $se = $request->ser;
        $r = Auth::user()->roles_id;
        echo $se;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://172.21.22.136:7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
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
