@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    Serial: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value }}<br>
    Version del Hardware: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->HardwareVersion->_value }}<br>
    Version del Software: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SoftwareVersion->_value }} {{ $obj[0]->InternetGatewayDevice->DeviceInfo->AdditionalSoftwareVersion->_value }}<br>
    Descripcion del CPE: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->Description->_value }}<br>
    Fabricante: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->Manufacturer->_value }}<br>
    OUI del Fabricante: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ManufacturerOUI->_value }}<br>
    Modelo: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ModelName->_value }}<br>
    Firmware: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ModemFirmwareVersion->_value }}<br>
    Clase: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ProductClass->_value }}<br>
    Tiempo desde el ultimo reinicio: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->UpTime->_value }} s<br>
    <br>
    Red WAN: {{ $obj[0]->InternetGatewayDevice->WANDevice->{1}->WANConnectionDevice->{1}->WANIPConnection->{1}->AddressingType->_value }}<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{1}->WANConnectionDevice->{1}->WANIPConnection->{1}->ConnectionStatus->_value=='Connected') Conectado
    @endif<br>
    <br>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        SSID: <input type="text" id="ssid" name="ssid" value="{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->SSID->_value }}"><br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
@endsection
