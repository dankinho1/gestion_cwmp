@extends('cpe.par')

@section('tr')
    <?php
    $horas = floor($obj[0]->Device->DeviceInfo->UpTime->_value/ 3600);
    $minutos = floor(($obj[0]->Device->DeviceInfo->UpTime->_value - ($horas * 3600)) / 60);
    $segundos = $obj[0]->Device->DeviceInfo->UpTime->_value - ($horas * 3600) - ($minutos * 60);
    ?>
    <h1>Datos Generales</h1>
    <div class="card">
        <b>CPE ID:</b> {{ $obj[0]->_id }}<br>
        <b>Serial:</b> {{ $obj[0]->Device->DeviceInfo->SerialNumber->_value }}<br>
        <b>Version del Hardware:</b> {{ $obj[0]->Device->DeviceInfo->HardwareVersion->_value }}<br>
        <b>Version del Software:</b> {{ $obj[0]->Device->DeviceInfo->SoftwareVersion->_value }}<br>
        <b>Descripcion del CPE:</b> {{ $obj[0]->Device->DeviceInfo->Description->_value }}<br>
        <b>Fabricante:</b> {{ $obj[0]->Device->DeviceInfo->Manufacturer->_value }}<br>
        <b>OUI del Fabricante:</b> {{ $obj[0]->Device->DeviceInfo->ManufacturerOUI->_value }}<br>
        <b>Modelo:</b> {{ $obj[0]->Device->DeviceInfo->ModelName->_value }}<br>
        <b>Clase:</b> {{ $obj[0]->Device->DeviceInfo->ProductClass->_value }}<br>
        <b>Tiempo desde el ultimo reinicio:</b> {{ $horas }} h {{ $minutos }} m {{ $segundos }} s<br>
    <br>
    </div>
@endsection
