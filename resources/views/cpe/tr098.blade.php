@extends('cpe.par')

@section('tr')
    <h1>Datos Generales</h1>
    <div class="container-fluid">
        <div class="card">
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
    </div>
    </div>
    <h1>Conexiones WAN</h1>
<?php
if(isset($eel)) {
    for($i=0; $i<$eel;$i++) {
?>
    <div class="container-fluid">
        <div class="card">
    <h3>Conexion PPP {{ $ee3[$i] }}</h3>
Red WAN PPPoE {{ $ee3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>
    Direccion IP: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ExternalIPAddress->_value }}<br>
    Tipo de Conexion: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionType->_value=='IP_Bridged') Bridge
    @elseif($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionType->_value=='IP_Routed') Enrutado
    @else Desconectado
    @endif<br>
    Cuenta: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Username->_value }}<br>
    Gateway: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->RemoteIPAddress->_value }}<br>
    DNS: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->DNSServers->_value }}<br>
    NAT: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
            <br>
            <h2>Datos Tecnicos ADSL</h2>
            Estado conexion fisica: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANCommonInterfaceConfig->PhysicalLinkStatus->_value }}<br>
            Tipo de Conexion: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANCommonInterfaceConfig->WANAccessType->_value }}<br>
            Direccion MAC: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANEthernetInterfaceConfig->MACAddress->_value }}<br>
            Tipo de Modulacion: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->ModulationType->_value }}<br>
            Velocidad Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->DownstreamCurrRate->_value }}<br>
            Velocidad Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->UpstreamCurrRate->_value }}<br>

            Atenuacion Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamAttenuation->_value }}<br>
            Atenuacion Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamAttenuation->_value }}<br>
            <br>
        </div>
    </div><br>
<?php
 }
    }
    if(isset($eeipl)) {
    for($i=0; $i<$eeipl;$i++) {
?>
    <div class="container-fluid">
        <div class="card">
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
    <h2>Datos Tecnicos ADSL</h2>
    Estado conexion fisica: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANCommonInterfaceConfig->PhysicalLinkStatus->_value }}<br>
    Tipo de Conexion: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANCommonInterfaceConfig->WANAccessType->_value }}<br>
    Direccion MAC: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANEthernetInterfaceConfig->MACAddress->_value }}<br>
    Tipo de Modulacion: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->ModulationType->_value }}<br>
    Velocidad Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamCurrRate->_value }}<br>
    Velocidad Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamCurrRate->_value }}<br>

    Atenuacion Bajada: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamAttenuation->_value }}<br>
    Atenuacion Subida: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamAttenuation->_value }}<br>
    <br>
        </div>
    </div><br>
<?php
    }
    }
?>

    <h1>Conexiones LAN</h1>

    <div class="container-fluid">
        <div class="card">
                    Gateway LAN: {{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->IPInterface->{1}->IPInterfaceIPAddress->_value }}<br>
                    Rango de direcciones DHCP<br>
            Primera IP: {{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->MinAddress->_value }}<br>
    Ultima IP: {{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->MaxAddress->_value }}<br><br>
    <h2>Host LAN Conectados</h2>
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>Host</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Interface</th>
                    <th>Direccion MAC</th>
                </tr>
                </thead>
                <tbody>
    @for($i = 0; $i < $lho; $i++)
        <tr>
            <td>{{ $hov[$i] }}</td>
            <td>{{ $ho[$i]['HostName']['_value'] }}</td>
            <td>{{ $ho[$i]['IPAddress']['_value'] }}</td>
    @if(isset($ho[$i]['InterfaceType']['_value']))
                <td>{{ $ho[$i]['InterfaceType']['_value'] }}</td>
        @else
                <td>Desconocido</td>
    @endif
            <td>{{ $ho[$i]['MACAddress']['_value'] }}</td>
        </tr>
    @endfor
                </tbody>
            </table>
            <br>
        </div>
    </div>

    <h1>Conexiones Wi-Fi</h1>

    <div class="container-fluid">
        <div class="card">
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>Direccion MAC</th>
                    <th>SSID</th>
                    <th>Canal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->BSSID->_value }}</td>
                    <td>{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->SSID->_value }}</td>
                    <td>{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->Channel->_value }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
