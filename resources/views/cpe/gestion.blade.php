@extends('home2')

@section('content2')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
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
        for ($j=0; $j<$lmod; $j++) {
        if($obj[$i]->_deviceId->_SerialNumber==$mod[$j]->serial){
        ?>
        <tr>
            <td>{{ $obj[$i]->_deviceId->_SerialNumber }}</td>
            <td>{{ $mod[$j]->contrato }}</td>
            <td>{{ $mod[$j]->telefono }}</td>
            <td>
                <form onsubmit="return confirm('ADVERTENCIA: Reiniciar el equipo puede llevar a fallas de conexion con el servidor. Esta seguro de que quiere reiniciar?');" action='{{ route('reinicio') }}' method='POST' role='form'>
                    {{ csrf_field() }}
                    <input type='hidden' id='id' name='id' value='{{ $obj[$i]->_id }}'>
                    <button type='submit' class='btn btn-outline-primary'>Reiniciar CPE</button>
                </form>
            </td>
            <td>
                <form onsubmit="return confirm('ADVERTENCIA: Reiniciar el equipo puede llevar a fallas de conexion con el servidor. Esta seguro de que quiere reiniciar?');" action='{{ route('factoryreset') }}' method='POST' role='form'>
                    {{ csrf_field() }}
                    <input type='hidden' id='id' name='id' value='{{ $obj[$i]->_id }}'>
                    <button type='submit' class='btn btn-outline-primary'>Reseteo de Fabrica</button>
                </form>
            </td>
            <td>
                <form action='{{ route('archivo') }}' method='POST' role='form'>
                    {{ csrf_field() }}
                    <input type='hidden' id='idd' name='idd' value='{{ $obj[$i]->_id }}'>
                    <input type='hidden' id='class' name='class' value='{{ $obj[$i]->_deviceId->_ProductClass }}'>
                    <button type="submit" class="btn btn-outline-primary">Actualizar CPE</button>
                </form>
            </td>
            <td>
                <?php
                if (isset($obj[$i]->InternetGatewayDevice->IPPingDiagnostics)||isset($obj[$i]->Device->IP->Diagnostics)) {
                    echo "<form onsubmit='return true;";
                }
                else {
                    echo "<form onsubmit='noping(); return false;'";
                }
                echo "' action='".route('ping')."' method='POST' role='form'>";
                ?>
                {{ csrf_field() }}
                <input type='hidden' id='idd' name='idd' value='{{ $obj[$i]->_id }}'>
                <input type='hidden' id='se' name='se' value='{{ $obj[$i]->_deviceId->_SerialNumber }}'>
                <button type="submit" class="btn btn-outline-primary">Prueba Ping</button>
                </form>
            </td>
        </tr>
        <?php
        }
        }
        }
        ?>
        </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function noping() {
            alert('CPE no tiene esta funcion disponible');
        }
    </script>
@endsection
