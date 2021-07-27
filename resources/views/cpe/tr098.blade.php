@extends('cpe.par')

@section('tr')
    <h1>Datos Generales</h1>
    <div class="container-fluid">
        <div class="card">
            <?php
            $horas = floor($obj[0]->InternetGatewayDevice->DeviceInfo->UpTime->_value/ 3600);
            $minutos = floor(($obj[0]->InternetGatewayDevice->DeviceInfo->UpTime->_value - ($horas * 3600)) / 60);
            $segundos = $obj[0]->InternetGatewayDevice->DeviceInfo->UpTime->_value - ($horas * 3600) - ($minutos * 60);
            ?>
                <b>CPE ID:</b> {{ $obj[0]->_id }}<br>
                <b>Serial:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value }}<br>
                <b>Version del Hardware:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->HardwareVersion->_value }}<br>
                <b>Version del Software:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SoftwareVersion->_value }} {{ $obj[0]->InternetGatewayDevice->DeviceInfo->AdditionalSoftwareVersion->_value }}<br>
                <b>Descripcion del CPE:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->Description->_value }}<br>
                <b>Fabricante:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->Manufacturer->_value }}<br>
                <b>OUI del Fabricante:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ManufacturerOUI->_value }}<br>
                <b>Modelo:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ModelName->_value }}<br>
                <b>Firmware:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ModemFirmwareVersion->_value }}<br>
                <b>Clase:</b> {{ $obj[0]->InternetGatewayDevice->DeviceInfo->ProductClass->_value }}<br>
                <b>Tiempo desde el ultimo reinicio:</b> {{ $horas }} h {{ $minutos }} m {{ $segundos }} s<br>
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
            <b>Red WAN PPPoE {{ $ee3[$i] }}:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>
            <b>Direccion IP:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ExternalIPAddress->_value }}<br>
            <b>Tipo de Conexion:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionType->_value=='IP_Bridged') Bridge
    @elseif($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionType->_value=='IP_Routed') Enrutado
    @else Desconectado
    @endif<br>
            <b>Cuenta:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Username->_value }}<br>
            <b>Gateway:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->RemoteIPAddress->_value }}<br>
            <b>DNS:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->DNSServers->_value }}<br>
            <b>NAT:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
            <b>Estado:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
            <br>
            <h3>Datos Tecnicos ADSL</h3>
            <b>Estado conexion fisica:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANCommonInterfaceConfig->PhysicalLinkStatus->_value }}<br>
            <b>Tipo de Conexion:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANCommonInterfaceConfig->WANAccessType->_value }}<br>
            <b>Direccion MAC:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANEthernetInterfaceConfig->MACAddress->_value }}<br>
            <b>Tipo de Modulacion:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->ModulationType->_value }}<br>
            <b>Velocidad Bajada:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->DownstreamCurrRate->_value }}<br>
            <b>Velocidad Subida:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->UpstreamCurrRate->_value }}<br>

            <b>Atenuacion Bajada:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->DownstreamAttenuation->_value }}<br>
            <b>Atenuacion Subida:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANDSLInterfaceConfig->UpstreamAttenuation->_value }}<br>
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
            <b>Red WAN IP {{ $eeip3[$i] }}:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->Name->_value }}<br>
            <b>Tipo de Conexion:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionType->_value=='IP_Bridged') Bridge
    @elseif($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionType->_value=='IP_Routed') Enrutado
        @else Desconectado
    @endif<br>
            <b>Direccion IP:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ExternalIPAddress->_value }}<br>
            <b>Gateway:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->DefaultGateway->_value }}<br>
            <b>DNS:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->DNSServers->_value }}<br>
            <b>NAT:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
            <b>Estado:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionStatus->_value=='Connected') En uso
@else Desconectado
@endif<br>
    <br>
    <h3>Datos Tecnicos ADSL</h3>
            <b>Estado conexion fisica:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANCommonInterfaceConfig->PhysicalLinkStatus->_value }}<br>
            <b>Tipo de Conexion:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANCommonInterfaceConfig->WANAccessType->_value }}<br>
            <b>Direccion MAC:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANEthernetInterfaceConfig->MACAddress->_value }}<br>
            <b>Tipo de Modulacion:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->ModulationType->_value }}<br>
            <b>Velocidad Bajada:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamCurrRate->_value }}<br>
            <b>Velocidad Subida:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamCurrRate->_value }}<br>

            <b>Atenuacion Bajada:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->DownstreamAttenuation->_value }}<br>
            <b>Atenuacion Subida:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANDSLInterfaceConfig->UpstreamAttenuation->_value }}<br>
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
            <b>Gateway LAN:</b> {{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->IPInterface->{1}->IPInterfaceIPAddress->_value }}<br>
            <b>Rango de direcciones DHCP</b>
            <b>Primera IP:</b> {{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->MinAddress->_value }}<br>
            <b>Ultima IP:</b> {{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->LANHostConfigManagement->MaxAddress->_value }}<br><br>
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
