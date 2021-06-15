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
if(isset($eel)) {
    for($i=0; $i<$eel;$i++) {
?>
    <h3>Conexion PPP {{ $ee3[$i] }}</h3>
Red WAN PPPoE {{ $ee3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>
    Direccion IP: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ExternalIPAddress->_value }}<br>
    Tipo de Conexion: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionType->_value=='IP_Bridged') Bridge
    @elseif($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionType->_value=='IP_Routed') Enrutado
    @else Desconectado
    @endif<br>
    Gateway: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->RemoteIPAddress->_value }}<br>
    DNS: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->DNSServers->_value }}<br>
    NAT: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
<?php
 }
    }
    if(isset($eeipl)) {
    for($i=0; $i<$eeipl;$i++) {
?>
    <h3>Conexion IP {{ $i+1 }}</h3>
    Red WAN IP {{ $eeip3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->Name->_value }}<br>
    Tipo de Conexion: @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionType->_value=='IP_Bridged') Bridge
    @elseif($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionType->_value=='IP_Routed') Enrutado
        @else Desconectado
    @endif<br>
    Direccion IP: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ExternalIPAddress->_value }}<br>
    Gateway: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->DefaultGateway->_value }}<br>
    DNS: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->DNSServers->_value }}<br>
    NAT: @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
    <br>
    <h2>Datos Tecnicos</h2>
    Estado conexion fisica: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANCommonInterfaceConfig->PhysicalLinkStatus->_value }}<br>
    Tipo de Conexion: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANCommonInterfaceConfig->WANAccessType->_value }}<br>
    Direccion MAC: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANEthernetInterfaceConfig->MACAddress->_value }}<br>
    Tipo de Modulacion: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->ModulationType->_value }}<br>
    Velocidad Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamCurrRate->_value }}<br>
    Velocidad Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamCurrRate->_value }}<br>
    SNR Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->SNRMpbds->_value }}<br>
    SNR Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->SNRMpbus->_value }}<br>
    Atenuacion Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamAttenuation->_value }}<br>
    Atenuacion Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamAttenuation->_value }}<br>
    --------------------------------------------------------------------------<br><br>
<?php
    }
    }
?>

    <h2>Host LAN Conectados</h2>
    @for($i = 0; $i < $lho; $i++)
    Host {{ $hov[$i] }}:<br>
    Direccion IP: {{ $ho[$i]['IPAddress']['_value'] }}<br>
    Interface: {{ $ho[$i]['InterfaceType']['_value'] }}<br>
    Direccion MAC: {{ $ho[$i]['MACAddress']['_value'] }}<br>
    ------------------------<br>
    @endfor

@endsection
