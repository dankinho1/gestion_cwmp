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
                            <th>Clase</th>
                            <th>OUI</th>
                            <th>Opciones</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($i=0; $i<$l; $i++) {
                            echo "<tr>";
                            echo "<td>".$obj[$i]->_id."</td>";
                            echo "<td>".$obj[$i]->metadata->productClass."</td>";
                            echo "<td>".$obj[$i]->metadata->oui."</td>";
                            echo "<td>".$obj[$i]->metadata->fileType."</td>";
                            echo "<td><form action='".route('actu')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='id' name='id' value='".$obj[$i]->_id."'><input type='hidden' id='idd' name='idd' value='".$idd."'><button type='submit' class='btn btn-outline-primary'>Actualizar</button></form></td>
                            <td><form action='".route('borraractu')."' method='POST' role='form'>".csrf_field()."<input type='hidden' id='id' name='id' value='".$obj[$i]->_id."'><input type='hidden' id='idd' name='idd' value='".$idd."'><button type='submit' class='btn btn-outline-primary'>Borrar Archivo</button></form></td>";
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
