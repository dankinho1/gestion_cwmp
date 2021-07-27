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

                        <br><br>
                        <div class="links">
                            <form action="{{ route('subira') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <input type="file" name="file" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">Subir Archivo</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
