<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParametrosController extends Controller
{
    public $mainip = '172.21.22.136';
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

        return redirect()->route('home');
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
        echo $l;
        //print_r($obj[0]->InternetGatewayDevice->WANDevice->{1}->WANConnectionDevice->{1});
        //print_r($obj2);
        $o=0;
        $oo=0;
        $oo2=0;
        $oo3=0;
        while($o<$l) {
        for ($ii=1; $ii<=10; $ii++) {
        for ($jj=1; $jj<=10; $jj++) {
            for ($kk = 1; $kk <= 10; $kk++) {
                if (isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANPPPConnection->{$kk})) {
                    $ee[$oo] = $ii;
                    $ee2[$oo2] = $jj;
                    $ee3[$oo3] = $kk;
                    $oo2++;
                    $oo3++;
                    $oo++;
                }
            }
        }
        }
            $o++;
        }
        //print_r($ee2);
        if($obj) {
            $eel = count($ee);
        }
        if(!$obj) {
            echo "OBJ2 EX";
            return view('cpe.tr143', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";
            return view('cpe.tr098', ['id' => $r, 'obj' => $obj, 'l' => $l, 'ee' => $ee, 'ee2' => $ee2, 'ee3' => $ee3, 'eel' => $eel]);
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
        $o=0;
        $oo=0;
        $oo2=0;
        while($o<$l) {
            for ($ii=1; $ii<=10; $ii++) {
                for ($jj=1; $jj<=10; $jj++) {
                    if(isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj})){
                        $ee[$oo]=$ii;
                        $ee2[$oo2]=$jj;
                        $oo2++;
                        $oo++;
                    }
                }
            }
            $o++;
        }
        $eel=count($ee);
        if(!$obj) {
            echo "OBJ2 EX";
            return view('cpe.tr143mod', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";
            return view('cpe.tr098mod', ['id' => $r, 'obj' => $obj, 'l' => $l, 'ee' => $ee, 'ee2' => $ee2, 'eel' => $eel]);
        }
    }
}
