@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">


            <div class="card">
                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cpe-tab" data-toggle="tab" href="#cpe" role="tab" aria-controls="cpe" aria-selected="true">Parametros CPE</a>
                    </li>
                    @if($id=="1"||$id=="5")
                    <li class="nav-item">
                        <a class="nav-link" id="estadistica-tab" data-toggle="tab" href="#estadistica" role="tab" aria-controls="estadistica" aria-selected="false">Cuadros Estadisticos</a>
                    </li>
                    @endif
                    @if($id!="2"&&$id!="5")
                    <li class="nav-item">
                        <a class="nav-link" id="gestion-tab" data-toggle="tab" href="#gestion" role="tab" aria-controls="gestion" aria-selected="true">Gestion de CPE</a>
                    </li>
                    @endif
                    @if($id=="1"||$id=="3")
                    <li class="nav-item">
                        <a class="nav-link" id="registrarcpe-tab" data-toggle="tab" href="#registrarcpe" role="tab" aria-controls="registrarcpe" aria-selected="true">Registro de CPE</a>
                    </li>
                    @endif
                    @if($id=="1")
                        <li class="nav-item">
                            <a class="nav-link" id="aprov-tab" data-toggle="tab" href="#aprov" role="tab" aria-controls="aprov" aria-selected="false">Autoprovision</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" id="registrarusu-tab" data-toggle="tab" href="#registrarusu" role="tab" aria-controls="registrarusu" aria-selected="false">Registro de Usuarios</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cpe" role="tabpanel" aria-labelledby="cpe-tab">
                        <br><br>
                        <a type="button" href="{{ route('vercpe') }}" class="btn btn-outline-primary">Ver lista de CPE</a>
                        <a type="button" href="{{ route('buscpe') }}" class="btn btn-outline-primary">Buscar CPE</a><br>
                    </div>
                    @if($id!="2")
                    <div class="tab-pane fade" id="estadistica" role="tabpanel" aria-labelledby="estadistica-tab">
                        <a type="button" href="{{ route('charts') }}" class="btn btn-outline-primary">CPEs activos e inactivos</a>
                    </div>
                    @endif
                    <div class="tab-pane fade" id="gestion" role="tabpanel" aria-labelledby="gestion-tab">
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
                                <form action='{{ route('reinicio') }}' method='POST' role='form'>
                                    {{ csrf_field() }}
                                    <input type='hidden' id='id' name='id' value='{{ $obj[$i]->_id }}'>
                                    <button type='submit' class='btn btn-outline-primary'>Reiniciar CPE</button>
                                </form>
                            </td>
                                <td>
                                    <form action='{{ route('factoryreset') }}' method='POST' role='form'>
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
                            </tr>
                            <?php
                                }
                            }
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="registrarcpe" role="tabpanel" aria-labelledby="registrarcpe-tab">
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
                                $v1[$i]=$obj[$i]->_deviceId->_SerialNumber;
                            }
                            for ($j=0; $j<$lmod; $j++) {
                                $v2[$j]=$mod[$j]->serial;
                            }
                            $dif = array_diff($v1, $v2);
                            $difl = count($dif);
                            foreach ($dif as $diff) {
                            for ($i=0; $i<$l; $i++) {
                            if($diff==$obj[$i]->_deviceId->_SerialNumber){
                                ?>
                                <tr>
                                    <form action='{{ route('regcpe.store') }}' method='POST' role='form'>
                                        {{ csrf_field() }}
                                <td>{{ $obj[$i]->_deviceId->_SerialNumber }}</td>
                                <td>
                                    <select name="ctto" id="ctto">
                                     @for ( $ii = 0; $ii < $co; $ii++)
                                            <option value="{{ $ctto[$ii] }}">{{ $ctto[$ii] }}</option>
                                    @endfor
                                    </select>
                                </td>
                                <td>
                                    <select name="telf" id="telf">
                                        @for ($ii = 0; $ii < $co; $ii++)
                                            <option value="{{ $telf[$ii] }}">{{ $telf[$ii] }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                        <input type='hidden' id='ser' name='ser' value='{{ $obj[$i]->_deviceId->_SerialNumber }}'>
                                        <button type='submit' class='btn btn-outline-primary'>Registrar CPE</button>
                                </td>
                                    </form>
                                </tr>
                            <?php
                                }
                            }
                            }
                            ?>
                            </tbody>
                        </table>
                        <br><br>
                        <form action='{{ route('listed') }}' role='form'>
                            {{ csrf_field() }}
                            <button type='submit' class='btn btn-outline-primary'>Editar CPEs</button>
                        </form>

                        <form action='{{ route('listdes') }}' role='form'>
                            {{ csrf_field() }}
                            <button type='submit' class='btn btn-outline-primary'>Eliminar CPEs</button>
                        </form>
                        <br>
                    </div>
                    <div class="tab-pane fade" id="aprov" role="tabpanel" aria-labelledby="aprov-tab">
                        <br><br>
                        <a type="button" href="{{ route('cregla') }}" class="btn btn-outline-primary">Crear Regla</a>
                        <a type="button" href="{{ route('aregla') }}" class="btn btn-outline-primary">Asignar Regla</a><br>
                    </div>
                    <div class="tab-pane fade" id="registrarusu" role="tabpanel" aria-labelledby="registrarusu-tab">
                        <table data-toggle="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Nivel de Usuario</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i<$lusu; $i++) {
                                if(isset($usu[$i]->id)){
                            ?>
                            <tr>
                                <td>{{ $usu[$i]->name }}</td>
                                <td>{{ $usu[$i]->email }}</td>
                                <td>{{ $usu[$i]->roles->name }}</td>
                                <td>
                                    <form action='{{ route('users.edit',$usu[$i]->id) }}' method='GET' role='form'>
                                        {{ csrf_field() }}
                                        <input type='hidden' id='id' name='id' value='{{ $usu[$i]->id }}'>
                                        <button type='submit' class='btn btn-outline-primary'>Editar</button>
                                    </form>
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Do you really want to submit the form?');" action='{{ route('users.destroy',$usu[$i]->id) }}' method='POST' role='form'>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type='hidden' id='idd' name='idd' value='{{ $obj[$i]->_id }}'>
                                        <input type='hidden' id='class' name='class' value='{{ $obj[$i]->_deviceId->_ProductClass }}'>
                                        <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            }
                            }
                            ?>
                            </tbody>
                        </table>
                        <br><br>
                        <a type="button" href="{{ route('users.index') }}" class="btn btn-outline-primary">Registrar Nuevo Usuario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
