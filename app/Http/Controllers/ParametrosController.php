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

        //Parametros TR-181
        if(isset($request->ct)) {
            $ct = $request->ct;
            $ct2 = $request->ct2;
            $addip = $request->addip;
            $msub = $request->msub;
            $post = '{"name":"setParameterValues", "parameterValues":[["Device.IP.Interface.'.$ct.'.IPv4Address.'.$ct2.'.IPAddress", "'.$addip.'", "xsd:string"], ["Device.IP.Interface.'.$ct.'.IPv4Address.'.$ct2.'.SubnetMask", "'.$msub.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
        }
        $vp = $request->ipdhcp;
        $r = Auth::user()->roles_id;
        echo $se;
        echo $vp;
        //echo $ssid;

        //Parametros TR-098
        if(isset($request->ssid)) {
            $ssid = $request->ssid;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.SSID", "'.$ssid.'", "xsd:string"], ["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.X_BROADCOM_COM_WlanAdapter.WlVirtIntfCfg.1.WlSsid", "A'.$ssid.'A", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->passwlan)) {
            $passwlan = $request->passwlan;
            $idpass = $request->idpass;
            if($idpass==1) $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.PreSharedKey.1.KeyPassphrase", "'.$passwlan.'", "xsd:string"], ["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.X_BROADCOM_COM_WlanAdapter.WlVirtIntfCfg.1.WlWpaPsk", "A'.$passwlan.'A", "xsd:string"]]}';
            elseif ($idpass==2) $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.X_TP_PreSharedKey", "'.$passwlan.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->canwlan)) {
            $canwlan = $request->canwlan;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.Channel", "'.$canwlan.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->dip)) {
            $dip = $request->dip;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANIPConnection.'.$v13.'.ExternalIPAddress", "'.$dip.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->dga)) {
            $dga = $request->dga;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANIPConnection.'.$v13.'.DefaultGateway", "'.$dga.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->ddns)) {
            $ddns = $request->ddns;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANIPConnection.'.$v13.'.DNSServers", "'.$ddns.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }

        if(isset($request->dppp)) {
            $dppp = $request->dppp;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANPPPConnection.'.$v13.'.ExternalIPAddress", "'.$dppp.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->ddnsp)) {
            $ddnsp = $request->ddnsp;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANPPPConnection.'.$v13.'.DNSServers", "'.$ddnsp.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->cppp)) {
            $cppp = $request->cppp;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANPPPConnection.'.$v13.'.Username", "'.$cppp.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }
        if(isset($request->pappp)) {
            $pappp = $request->pappp;
            $v11 = $request->v11;
            $v12 = $request->v12;
            $v13 = $request->v13;
            $post = '{"name":"setParameterValues", "parameterValues":[["InternetGatewayDevice.WANDevice.'.$v11.'.WANConnectionDevice.'.$v12.'.WANPPPConnection.'.$v13.'.Password", "'.$pappp.'", "xsd:string"]]}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objpost = json_decode($output);
        }

        return redirect()->route('home2');
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
        ini_set('max_execution_time', 180);

        $id = $request->id;
        $id = str_replace("%","%25",$id);
        $se = $request->ser;
        $r = Auth::user()->roles_id;


        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.DeviceInfo"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost = json_decode($output);

        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.LANHostConfigManagement.IPInterface.1.IPInterfaceIPAddress"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.LANHostConfigManagement.MinAddress"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.LANHostConfigManagement.MaxAddress"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.BSSID"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.SSID"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.Channel"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $objactt2 = json_decode($output);

        $post = '{"name": "refreshObject", "objectName": "Device"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $objpost2 = json_decode($output);

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
        $o=0;
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

                    if (!isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANPPPConnection->{$kk}->Name->_value)) {
                        echo "UPDATING";
                        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.WANDevice.'.$ii.'"}';
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                        $output = curl_exec($ch);
                        curl_close($ch);
                        $r = substr($output, 0, -2);
                        $r = substr($r, 2);
                        $objpost = json_decode($output);

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);
                        $r = substr($output,0,-2);
                        $r = substr($r,2);
                        $obj = json_decode($output);
                    }

                    $oo2++;
                    $oo3++;
                    $oo++;
                }
                if (isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANIPConnection->{$kk})) {
                    $eeip[$ooip] = $ii;
                    $eeip2[$ooip2] = $jj;
                    $eeip3[$ooip3] = $kk;

                    if (!isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANIPConnection->{$kk}->Name->_value)) {
                        echo "UPDATING";
                        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.WANDevice.'.$ii.'"}';
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                        $output = curl_exec($ch);
                        curl_close($ch);
                        $r = substr($output, 0, -2);
                        $r = substr($r, 2);
                        $objpost = json_decode($output);

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);
                        $r = substr($output,0,-2);
                        $r = substr($r,2);
                        $obj = json_decode($output);
                    }

                    $ooip2++;
                    $ooip3++;
                    $ooip++;
                }
            }
        }
        }
            $o++;
        }
        //print_r($ooip);
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
        }
        if(!$obj) {
            echo "OBJ2 EX";

            return view('cpe.tr143', ['id' => $r, 'obj' => $obj2, 'l' => $l2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";

            $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1.Hosts.Host"}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/".$id."/tasks?timeout=3000&connection_request");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objactt = json_decode($output);

            /*if(!isset($obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->MinAddress->_value)) {
                echo "RTTT";
                $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.1"}';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $output = curl_exec($ch);
                curl_close($ch);
                $objactt2 = json_decode($output);
            }*/

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D&projection=InternetGatewayDevice.LANDevice.1.Hosts.Host");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $r = substr($output,0,-2);
            $r = substr($r,2);
            $objhost = json_decode($output);
            $nhost = $objhost[0]->InternetGatewayDevice->LANDevice->{1}->Hosts->Host;
            $ar = json_decode(json_encode($nhost), true);
            $lhost = count($ar);
            $u=0;
            for($i=0;$i<1000;$i++) {
                if(isset($ar[$i])) {
                    $ho[$u]=$ar[$i];
                    $hov[$u]=$i;
                    $u++;
                }
            }
            if(isset($ho)) $lho=count($ho);
            else {
                $lho = 0;
                $ho = 0;
                $hov = 0;
            }

            return view('cpe.tr098', ['id' => $r, 'obj' => $obj, 'l' => $l, 'ho' => $ho, 'hov' => $hov, 'lho' => $lho, 'ee' => $ee, 'ee2' => $ee2, 'ee3' => $ee3, 'eel' => $eel, 'eeip' => $eeip, 'eeip2' => $eeip2, 'eeip3' => $eeip3, 'eeipl' => $eeipl]);
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

        $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.DeviceInfo"}';
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
        $objpost2 = json_decode($output);

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

            $o=0;
            $oo=0;
            $oo2=0;
            $oo3=0;
            while($o<$l2) {
                for ($ii=1; $ii<=10; $ii++) {
                    for ($jj=1; $jj<=10; $jj++) {
                        for ($kk = 1; $kk <= 10; $kk++) {
                            if (isset($obj2[$o]->Device->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANPPPConnection->{$kk})) {
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

            $o=0;
            $oo=0;
            $oo2=0;
            while($o<$l2) {
                for ($ii=1; $ii<=20; $ii++) {
                    for ($jj = 1; $jj <= 20; $jj++) {
                        if (isset($obj2[$o]->Device->IP->Interface->{$ii}->IPv4Address->{$jj})) {
                                $ee[$oo] = $ii;
                                $ee2[$oo2] = $jj;
                                $oo2++;
                                $oo++;
                        }
                    }
                }
                $o++;
            }
            if($obj2 && $ee) {
                $eel2 = count($ee);
            } else $eel2=0;
            return view('cpe.tr143mod', ['id' => $r, 'obj' => $obj2, 'l' => $l2, 'ee' => $ee, 'ee2' => $ee2, 'eel2' => $eel2]);
        }
        if(!$obj2) {
            echo "OBJ1 EX";

            $o=0;
            $oo=0;
            $oo2=0;
            while($o<$l) {
                for ($ii=1; $ii<=10; $ii++) {
                    for ($jj=1; $jj<=10; $jj++) {
                            if (isset($obj[$o]->InternetGatewayDevice->LANDevice->{$ii}->WLANConfiguration->{$jj})) {
                                $eew[$oo] = $ii;
                                $eew2[$oo2] = $jj;

                                if (!isset($obj[$o]->InternetGatewayDevice->LANDevice->{$ii}->WLANConfiguration->{$jj}->Status->_value)) {
                                    echo "UPDATING";
                                    $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.LANDevice.'.$ii.'"}';
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                                    $output = curl_exec($ch);
                                    curl_close($ch);
                                    $r = substr($output, 0, -2);
                                    $r = substr($r, 2);
                                    $objpost = json_decode($output);

                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $output = curl_exec($ch);
                                    curl_close($ch);
                                    $r = substr($output,0,-2);
                                    $r = substr($r,2);
                                    $obj = json_decode($output);
                                }

                                $oo2++;
                                $oo++;
                        }
                    }
                }
                $o++;
            }

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

                                if (!isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANPPPConnection->{$kk}->Name->_value)) {
                                    echo "UPDATING";
                                    $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.WANDevice.'.$ii.'"}';
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                                    $output = curl_exec($ch);
                                    curl_close($ch);
                                    $r = substr($output, 0, -2);
                                    $r = substr($r, 2);
                                    $objpost = json_decode($output);

                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $output = curl_exec($ch);
                                    curl_close($ch);
                                    $r = substr($output,0,-2);
                                    $r = substr($r,2);
                                    $obj = json_decode($output);
                                }
                                $oo2++;
                                $oo3++;
                                $oo++;
                            }
                        }
                    }
                }
                $o++;
            }

            $o=0;
            $ooip=0;
            $ooip2=0;
            $ooip3=0;
            while($o<$l) {
                for ($ii=1; $ii<=10; $ii++) {
                    for ($jj=1; $jj<=10; $jj++) {
                        for ($kk = 1; $kk <= 10; $kk++) {
                            if (isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANIPConnection->{$kk})) {
                                $eeip[$ooip] = $ii;
                                $eeip2[$ooip2] = $jj;
                                $eeip3[$ooip3] = $kk;
                                if (!isset($obj[$o]->InternetGatewayDevice->WANDevice->{$ii}->WANConnectionDevice->{$jj}->WANIPConnection->{$kk}->Name->_value)) {
                                    echo "UPDATING";
                                    $post = '{"name": "refreshObject", "objectName": "InternetGatewayDevice.WANDevice.'.$ii.'"}';
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices/" . $id . "/tasks?timeout=3000&connection_request");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                                    $output = curl_exec($ch);
                                    curl_close($ch);
                                    $r = substr($output, 0, -2);
                                    $r = substr($r, 2);
                                    $objpost = json_decode($output);

                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/?query=%7B%22InternetGatewayDevice.DeviceInfo.SerialNumber%22%3A%22".$se."%22%7D");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $output = curl_exec($ch);
                                    curl_close($ch);
                                    $r = substr($output,0,-2);
                                    $r = substr($r,2);
                                    $obj = json_decode($output);
                                }

                                $ooip2++;
                                $ooip3++;
                                $ooip++;
                            }
                        }
                    }
                }
                $o++;
            }

            if (isset($ee)) $eel = count($ee);
            else {
                $eel = 0;
                $ee = 0;
                $ee2 = 0;
                $ee3 = 0;
            }

            if (isset($eeip)) $eeipl = count($eeip);
            else {
                $eeipl = 0;
                $eeip = 0;
            }

            if (isset($ee)) $eewl = count($eew);
            else {
                $eewl = 0;
                $eew = 0;
                $eew2 = 0;
            }
            return view('cpe.tr098mod', ['id' => $r, 'obj' => $obj, 'l' => $l, 'ee' => $ee, 'ee2' => $ee2, 'ee3' => $ee3, 'eel' => $eel, 'eeip' => $eeip, 'eeip2' => $eeip2, 'eeip3' => $eeip3, 'eeipl' => $eeipl, 'eew' => $eew, 'eew2' => $eew2, 'eewl' => $eewl]);
        }
    }

}
