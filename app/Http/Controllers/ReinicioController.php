<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReinicioController extends Controller
{
    public $mainip = '172.21.22.136';
    //
    public function reinicio(Request $request)
    {
        //
        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $r = Auth::user()->roles_id;
        echo $id;
        $post = '{ "name": "reboot" }';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $id = Auth::user()->roles_id;
        echo $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);
        return redirect()->route('home');
    }

    public function factoryreset(Request $request)
    {
        //
        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $r = Auth::user()->roles_id;
        echo $id;
        $post = '{"name": "factoryReset"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $id = Auth::user()->roles_id;
        echo $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);
        return redirect()->route('home');
    }

    public function ping(Request $request)
    {
        //
        $id = $request->idd;
        $id = str_replace("%","%25",$id);
        $se = $request->se;
        $r = Auth::user()->roles_id;


        /*$post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.DeviceInfo"}';
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
        /*print_r($obj[0]->InternetGatewayDevice->WANDevice->{3}->WANConnectionDevice->{1}->WANIPConnection);
        if(isset($obj[0]->InternetGatewayDevice->WANDevice->{3}->WANConnectionDevice->{1}->WANIPConnection->{5})) {
            echo 'true';
        } else echo 'false';*/
        //print_r($obj2);
        /*$o=0;
        $oo=0;
        $oo2=0;
        $oo3=0;
        $ooip=0;
        $ooip2=0;
        $ooip3=0;
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
                        if (isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANIPConnection->{$kk})) {
                            $eeip[$oo] = $ii;
                            $eeip2[$oo2] = $jj;
                            $eeip3[$oo3] = $kk;
                            $ooip2++;
                            $ooip3++;
                            $ooip++;
                        }
                    }
                }
            }
            $o++;
        }
        //print_r($ee2);
        if($obj) {
            if(isset($ee)) $eel = count($ee);
            else {
                $eel = 0;
                $ee = 0;
                $ee2 = 0;
                $ee3 = 0;
            }
            if(isset($eeip)) $eeipl = count($eeip);
            else {
                $eeipl = 0;
                $eeip = 0;
            }
        }*/
        //if(!$obj) {
        //    echo "OBJ2 EX";
        //    return view('cpe.tr143', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        //}
        //if(!$obj2) {
        //    echo "OBJ1 EX";
            return view('cpe.ping', ['id' => $r, 'obj' => $obj, 'l' => $l, 'se' => $se/*, 'ee' => $ee, 'ee2' => $ee2, 'ee3' => $ee3, 'eel' => $eel, 'eeip' => $eeip, 'eeip2' => $eeip2, 'eeip3' => $eeip3, 'eeipl' => $eeipl*/]);
        //}
    }

    public function pings(Request $request)
    {
        //
        $id = $request->id;
        $se = $request->se;
        $id = str_replace("%","%25",$id);
        $r = Auth::user()->roles_id;
        $post = '{ "name": "setParameterValues", "parameterValues": [["InternetGatewayDevice.IPPingDiagnostics.Host","172.21.22.136"], ["InternetGatewayDevice.IPPingDiagnostics.NumberOfRepetitions","4"], ["InternetGatewayDevice.IPPingDiagnostics.Timeout","5"], ["InternetGatewayDevice.IPPingDiagnostics.DataBlockSize","32"], ["InternetGatewayDevice.IPPingDiagnostics.DSCP","0"], ["InternetGatewayDevice.IPPingDiagnostics.DiagnosticsState","Requested"]]}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objping = json_decode($output);

        $post = '{ "name": "getParameterValues", "parameterNames": ["InternetGatewayDevice.IPPingDiagnostics"]}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output2 = curl_exec($ch);
        curl_close($ch);
        $objping2 = json_decode($output2);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D&projection=InternetGatewayDevice.IPPingDiagnostics.DiagnosticsState");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpingstatus = json_decode($output);

        while($objpingstatus[0]->InternetGatewayDevice->IPPingDiagnostics->DiagnosticsState->_value!="Complete") {
            $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.IPPingDiagnostics"}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objs = json_decode($output);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D&projection=InternetGatewayDevice.IPPingDiagnostics.DiagnosticsState,InternetGatewayDevice.IPPingDiagnostics.MaximumResponseTime,InternetGatewayDevice.IPPingDiagnostics.MinimumResponseTime,InternetGatewayDevice.IPPingDiagnostics.SuccessCount,InternetGatewayDevice.IPPingDiagnostics.AverageResponseTime");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpingstatus = json_decode($output);

            if ($objpingstatus[0]->InternetGatewayDevice->IPPingDiagnostics->DiagnosticsState->_value == "Complete") {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                $r = substr($output,0,-2);
                $r = substr($r,2);
                $obj = json_decode($output);
                $l = count($obj);
                return view('cpe.pingser', ['id' => $id, 'obj' => $obj, 'objps' => $objpingstatus, 'l' => $l, 'se' => $se]);
            }
        }
    }

    public function pingb(Request $request)
    {
        //
        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $r = Auth::user()->roles_id;
        echo $id;
        $post = '{"name": "factoryReset"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $id = Auth::user()->roles_id;
        echo $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);
        return redirect()->route('home');
    }
}
