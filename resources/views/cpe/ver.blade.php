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
                            <th>Opciones</th>
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
                            <td><form action='".route('modpar')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='ser' name='ser' value='".$obj[$i]->_deviceId->_SerialNumber."'><button type='submit' class='btn btn-outline-primary'>Modificar Parametros</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
