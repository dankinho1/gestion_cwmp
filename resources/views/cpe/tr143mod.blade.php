@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    Serial: {{ $obj[0]->Device->DeviceInfo->SerialNumber->_value }}<br>
    Version del Hardware: {{ $obj[0]->Device->DeviceInfo->HardwareVersion->_value }}<br>
    Version del Software: {{ $obj[0]->Device->DeviceInfo->SoftwareVersion->_value }}<br>
    Descripcion del CPE: {{ $obj[0]->Device->DeviceInfo->Description->_value }}<br>
    Fabricante: {{ $obj[0]->Device->DeviceInfo->Manufacturer->_value }}<br>
    OUI del Fabricante: {{ $obj[0]->Device->DeviceInfo->ManufacturerOUI->_value }}<br>
    Modelo: {{ $obj[0]->Device->DeviceInfo->ModelName->_value }}<br>
    Clase: {{ $obj[0]->Device->DeviceInfo->ProductClass->_value }}<br>
    Tiempo desde el ultimo reinicio: {{ $obj[0]->Device->DeviceInfo->UpTime->_value }} s<br>
    <br>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        IP DHCP: <input type="text" id="ipdhcp" name="ipdhcp" value="{{ $obj[0]->Device->DHCPv4->Server->Pool->{4}->IPRouters->_value }}"><br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
@endsection
