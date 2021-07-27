@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div id="dom-target">
                    <div class="card">

                    <table data-toggle="table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Contrato</th>
                            <th>Telefono</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                            @if($id!=5)
                                <th></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $u=0;
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
                            $lidate = date('Y-m-d H:i:s', strtotime($obj[$i]->_lastInform));
                            $now2 = \Carbon\Carbon::now()->subMinutes(5);
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
                            if($id!=5) {
                            echo "<td><form onsubmit='";
                            if ($lidate < $now2) {
                                echo "nocpe(); return false; ";
                            }
                            if($u!=1) {
                                echo "noreg(); return false; ";
                            }
                            echo "' action='".route('modpar')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='id' name='id' value='".$obj[$i]->_id."'><input type='hidden' id='ser' name='ser' value='".$obj[$i]->_deviceId->_SerialNumber."'><button type='submit' class='btn btn-outline-primary'>Modificar Parametros</button></form></td>";
                            }
                            echo "</tr>";
                            $u=0;
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <br>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Volver</a>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Pagina Principal</a><br>
        </div>
    </div>

    <script>
        function nocpe() {
            alert('CPE no esta activo');
        }

        function noreg() {
            alert('CPE no esta registrado');
        }
    </script>
@endsection
