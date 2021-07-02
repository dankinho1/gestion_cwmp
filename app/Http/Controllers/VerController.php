<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ModemCPE;

class VerController extends Controller
{
    public $mainip = '172.21.22.136';

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $rid = Auth::user()->roles_id;
        echo $rid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        // print_r($obj);
        $l = count($obj);
        $dcpe = ModemCPE::all();
        //    echo "<br>".$obj->InternetGatewayDevice->DeviceInfo->ModelName->_value;
        return view('cpe.ver', ['id' => $rid, 'obj' => $obj, 'l' => $l, 'dcpe' => $dcpe]);
    }

    public function buscar(Request $request)
    {
        $r = Auth::user()->roles_id;
        echo $r;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        // print_r($obj);
        $l = count($obj);
        //    echo "<br>".$obj->InternetGatewayDevice->DeviceInfo->ModelName->_value;
        return view('cpe.buscar', ['id' => $r, 'obj' => $obj, 'l' => $l]);
    }

    public function rescpe(Request $request)
    {
        $dat = $request->dat;
        foreach (ModemCPE::all() as $cpe) {
            if ($cpe->serial == $dat) {
                $dat2 = $dat;
                break;
            }
            if ($cpe->contrato == $dat) {
                $dat2 = $cpe->serial;
                break;
            }
            if ($cpe->telefono == $dat) {
                $dat2 = $cpe->serial;
                break;
            }
            $dat2=0;
        }
            echo $dat2;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22Device.DeviceInfo.SerialNumber%22%3A%22".$dat2."%22%7D");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $obj = json_decode($output);
            $l = count($obj);

            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$dat2."%22%7D");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $obj2 = json_decode($output);

            // print_r($obj);
            $l2 = count($obj2);
            $dcpe = ModemCPE::all();

            if(!$obj) {
                echo "OBJ2 EX";
                return view('cpe.ver', ['id' => $r, 'obj' => $obj2, 'l' => $l2, 'dcpe' => $dcpe]);
            }
            if(!$obj2) {
                echo "OBJ1 EX";
                return view('cpe.ver', ['id' => $r, 'obj' => $obj, 'l' => $l, 'dcpe' => $dcpe]);
            }
    }
}
