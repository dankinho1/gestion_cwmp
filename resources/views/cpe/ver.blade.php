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

                    <table data-toggle="table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Contrato</th>
                            <th>Telefono</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($i=0; $i<$l; $i++) {
                            echo "<tr>";
                            echo "<td>".$obj[$i]->_deviceId->_SerialNumber."</td>";
                            echo "<td>Item 2</td>";
                            echo "<td>$2</td>";
                            echo "<td><form action='".route('verpar')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='ser' name='ser' value='".$obj[$i]->_deviceId->_SerialNumber."'><button type='submit' class='btn btn-outline-primary'>Ver Parametros</button></form></td>
                            <td><a type='button' href='".route('home')."' class='btn btn-outline-primary'>Modificar Parametros</a></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

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
