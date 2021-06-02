@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div id="dom-target">

                    <table data-toggle="table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Contrato</th>
                            <th>Telefono</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($i=0; $i<$l; $i++) {
                            echo "<tr>";
                            echo "<td>".$obj[$i]->_deviceId->_SerialNumber."</td>";
                            foreach($dcpe as $cpe) {
                                if($cpe->serial==$obj[$i]->_deviceId->_SerialNumber) {
                                    echo "<td>".$cpe->contrato."</td>";
                                    echo "<td>".$cpe->telefono."</td>";
                                    $u=1;
                                    break;
                                } else $u=0;
                            }
                            if($u!=1) {
                                echo "<td style='color:red;'>No registrado</td>";
                                echo "<td style='color:red;'>No registrado</td>";
                            }
                            $u=0;
                            $lidate = date('Y-m-d H:i:s', strtotime($obj[$i]->_lastInform));
                            $now2 = \Carbon\Carbon::now()->subMinutes(10);
                            if ($lidate >= $now2) {
                                echo "<td style='color:green;'>Activo</td>";
                            } else {
                                echo "<td style='color:red;'>Inactivo</td>";
                            }
                            echo "<td><form onsubmit='";
                            if ($lidate < $now2) {
                                echo "nocpe(); return false; ";
                            }
                            echo "' action='".route('verpar')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='id' name='id' value='".$obj[$i]->_id."'><input type='hidden' id='ser' name='ser' value='".$obj[$i]->_deviceId->_SerialNumber."'><button type='submit' class='btn btn-outline-primary'>Ver Parametros</button></form></td>";
                            echo "<td><form onsubmit='";
                            if ($lidate < $now2) {
                                echo "nocpe(); return false; ";
                            }
                            echo "' action='".route('modpar')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='id' name='id' value='".$obj[$i]->_id."'><input type='hidden' id='ser' name='ser' value='".$obj[$i]->_deviceId->_SerialNumber."'><button type='submit' class='btn btn-outline-primary'>Modificar Parametros</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Volver</a>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Pagina Principal</a><br>
        </div>
    </div>

    <script>
        function nocpe() {
            alert('CPE no esta activo');
        }
    </script>
@endsection
