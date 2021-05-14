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
Red WAN: {{ $obj[0]->InternetGatewayDevice->WANDevice->{3}->WANConnectionDevice->{1}->WANIPConnection->{1}->AddressingType->_value }}<br>
Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{3}->WANConnectionDevice->{1}->WANIPConnection->{1}->ConnectionStatus->_value=='Connected') Conectado
@endif<br>
@endsection
