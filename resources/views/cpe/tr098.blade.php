@extends('cpe.par')

@section('tr')
    <h2>Datos Tecnicos</h2>
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
    <h2>Conexiones WAN</h2>
<?php
if(isset($eeipl)) {
    for($i=0; $i<$eel;$i++) {
?>
Red WAN PPPoE {{ $ee3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>
Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
<?php
 }
    }
    if(isset($eeipl)) {
    for($i=0; $i<$eeipl;$i++) {
?>
    Red WAN IP {{ $ee3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->Name->_value }}<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
    <br>
    <h2>Datos Tecnicos</h2>
    Velocidad Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->DownstreamCurrRate->_value }}<br>
    Velocidad Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->UpstreamCurrRate->_value }}<br>
    SNR Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->SNRMpbds->_value }}<br>
    SNR Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->SNRMpbus->_value }}<br>
    Atenuacion Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->DownstreamAttenuation->_value }}<br>
    Atenuacion Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->UpstreamAttenuation->_value }}<br>
<?php
    }
    }
?>

@endsection
