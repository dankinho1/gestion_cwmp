@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">


            <div class="card">
                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cpe-tab" data-toggle="tab" href="#cpe" role="tab" aria-controls="cpe" aria-selected="true">Buscar CPE</a>
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
                        <a class="nav-link" id="registrarusu-tab" data-toggle="tab" href="#registrarusu" role="tab" aria-controls="registrarusu" aria-selected="false">Registro de Usuarios</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cpe" role="tabpanel" aria-labelledby="cpe-tab">
                        <br><br>
                        <a type="button" href="{{ route('vercpe') }}" class="btn btn-outline-primary">Ver lista de CPE</a>
                        <a type="button" href="{{ route('reg') }}" class="btn btn-outline-primary">Buscar CPE</a><br>
                    </div>
                    @if($id!="2")
                    <div class="tab-pane fade" id="estadistica" role="tabpanel" aria-labelledby="estadistica-tab">
                        trurrfg
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
                            ?>
                            <tr>
                            <td>{{ $obj[$i]->_deviceId->_SerialNumber }}</td>
                            <td>Item 2</td>
                            <td>$2</td>
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
                            <td><button type="button" class="btn btn-outline-primary">Actualizar CPE</button></td>
                            </tr>
                            <?php
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
                                ?>
                                <tr>
                                <td>{{ $obj[$i]->_deviceId->_SerialNumber }}</td>
                                <td>
                                    <select name="ctto" id="ctto">
                                    @for ($ii = 0; $ii < $co; $ii++)
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
                                    <form action='{{ route('verpar') }}' method='POST' role='form'>
                                        {{ csrf_field() }}
                                        <input type='hidden' id='ser' name='ser' value='{{ $obj[$i]->_deviceId->_SerialNumber }}'>
                                        <button type='submit' class='btn btn-outline-primary'>Registrar CPE</button>
                                    </form>
                                </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="registrarusu" role="tabpanel" aria-labelledby="registrarusu-tab">
                        jklj<br>
                        <a class="nav-link" href="{{ route('reg') }}">{{ __('Registrar Nuevo Usuario') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
