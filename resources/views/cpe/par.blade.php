@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div id="dom-target">
                    <?php
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.101:7557/devices/");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $r = substr($output,0,-2);
                    $r = substr($r,2);
                    $obj = json_decode($output);
                    // print_r($obj);
                    $l = count($obj);
                    //    echo "<br>".$obj->InternetGatewayDevice->DeviceInfo->ModelName->_value;
                    ?>
                </div>


            </div>
        </div>
    </div>

    <script>
        var txt = document.getElementById("dom-target");
        var obj = JSON.parse(txt.textContent);
        var nn=obj.length;
        document.getElementById("gg").innerHTML = nn;
        var g = [];
        for (var i=0, n=obj.length;i<n;i++) {
            g[i] = obj[i]._id;
            document.getElementById("demo["+i+"]").innerHTML = g[i];
        }
    </script>
@endsection
