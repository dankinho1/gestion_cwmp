@extends('cpe.par')

@section('tr')
    <h1>Datos Generales</h1>
    <div class="card">
    CPE ID: {{ $obj[0]->_id }}<br>
    Serial: {{ $obj[0]->Device->DeviceInfo->SerialNumber->_value }}<br>
    Version del Hardware: {{ $obj[0]->Device->DeviceInfo->HardwareVersion->_value }}<br>
    Version del Software: {{ $obj[0]->Device->DeviceInfo->SoftwareVersion->_value }}<br>
    Descripcion del CPE: {{ $obj[0]->Device->DeviceInfo->Description->_value }}<br>
    Fabricante: {{ $obj[0]->Device->DeviceInfo->Manufacturer->_value }}<br>
    OUI del Fabricante: {{ $obj[0]->Device->DeviceInfo->ManufacturerOUI->_value }}<br>
    Modelo: {{ $obj[0]->Device->DeviceInfo->ModelName->_value }}<br>
    Clase: {{ $obj[0]->Device->DeviceInfo->ProductClass->_value }}<br>
    </div>
    <br>
    <br>
    <h1>Conexiones WAN</h1>
    <div class="card">
    <h2>Interfaces</h2>
        <?php
        for($i=0;$i<$eel2;$i++) {
        ?>
        Interface: {{ $ee[$i] }} <br>
        Direccion IPv4: {{ $ee2[$i] }} <br>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Habilitar: <select id="int{{ $ee[$i] }}" name="int{{ $ee[$i] }}"><option value="true" selected>habilitar</option><option value="false">deshabilitar</option></select> (estado actual: {{ $obj[0]->Device->IP->Interface->{$ee[$i]}->IPv4Address->{$ee2[$i]}->Status->_value }})<br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
        Tipo de IP: <input type="text" id="tip" name="tip" value="{{ $obj[0]->Device->IP->Interface->{$ee[$i]}->IPv4Address->{$ee2[$i]}->AddressingType->_value }}" disabled><br>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Direccion IP: <input type="text" id="addip" name="addip" value="{{ $obj[0]->Device->IP->Interface->{$ee[$i]}->IPv4Address->{$ee2[$i]}->IPAddress->_value }}"><br>
        Mascara de Subred: <input type="text" id="msub" name="msub" value="{{ $obj[0]->Device->IP->Interface->{$ee[$i]}->IPv4Address->{$ee2[$i]}->SubnetMask->_value }}"><br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <input type='hidden' id='ct2' name='ct2' value='{{ $ee2[$i] }}'>
        <input type='hidden' id='ct' name='ct' value='{{ $ee[$i] }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
    <br>----------------------------------------------------------------------------------------<br>
        <?php
        }
        ?>
    </div>
        <br>
    <div class="card">
        <h2>DHCP</h2>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        IP DHCP: <input type="text" id="ipdhcp" name="ipdhcp" value="{{ $obj[0]->Device->DHCPv4->Server->Pool->{4}->IPRouters->_value }}"><br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
    </div>
@endsection
