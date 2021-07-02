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
    <?php
    for($i=0; $i<$eel;$i++) {
    ?>
    Red WAN: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') Conectado
    @endif<br>
    <?php
    }
    ?>
    <br>
    <h2>Wi-Fi</h2>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        SSID: <input type="text" id="ssid" name="ssid" value="{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->SSID->_value }}"><br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        @if(isset($obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->PreSharedKey->{1}->KeyPassphrase->_value))
            Password Wi-Fi: <input type="text" id="passwlan" name="passwlan" value="{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->PreSharedKey->{1}->KeyPassphrase->_value }}"><br>
            <input type='hidden' id='idpass' name='idpass' value='1'>
        @elseif(isset($obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->X_TP_PreSharedKey->_value))
            Password Wi-Fi: <input type="text" id="passwlan" name="passwlan" value="{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->X_TP_PreSharedKey->_value }}"><br>
            <input type='hidden' id='idpass' name='idpass' value='2'>
        @endif
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>
    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Canal: <input type="text" id="canwlan" name="canwlan" value="{{ $obj[0]->InternetGatewayDevice->LANDevice->{1}->WLANConfiguration->{1}->Channel->_value }}"><br>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    <h2>Conexiones WAN</h2>
    <?php
    if(isset($eel)) {
    for($i=0; $i<$eel;$i++) {
    ?>
    <h3>Conexion PPP {{ $ee3[$i] }}</h3>
    Red WAN PPPoE {{ $ee3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Direccion IP: <input type="text" id="dppp" name="dppp" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ExternalIPAddress->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $ee[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $ee2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $ee3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        DNS: <input type="text" id="ddnsp" name="ddnsp" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->DNSServers->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $ee[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $ee2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $ee3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Cuenta PPPoE: <input type="text" id="cppp" name="cppp" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Username->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $ee[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $ee2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $ee3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Password Cuenta PPPoE: <input type="text" id="pappp" name="pappp" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Password->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $ee[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $ee2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $ee3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') En uso
    @else Desconectado
    @endif<br><br>
    <?php
    }
    }
    if(isset($eeipl)) {
    for($i=0; $i<$eeipl;$i++) {
    ?>
    <h3>Conexion IP {{ $i+1 }}</h3>
    Red WAN IP {{ $eeip3[$i] }}: {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->Name->_value }}<br>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Direccion IP: <input type="text" id="dip" name="dip" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ExternalIPAddress->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $eeip[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $eeip2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $eeip3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        Gateway: <input type="text" id="dga" name="dga" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->DefaultGateway->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $eeip[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $eeip2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $eeip3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    <form action='{{ route('parametros.store') }}' method='POST' role='form'>
        {{ csrf_field() }}
        DNS: <input type="text" id="ddns" name="ddns" value="{{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->DNSServers->_value }}"><br>
        <input type='hidden' id='v11' name='v11' value='{{ $eeip[$i] }}'>
        <input type='hidden' id='v12' name='v12' value='{{ $eeip2[$i] }}'>
        <input type='hidden' id='v13' name='v13' value='{{ $eeip3[$i] }}'>
        <input type='hidden' id='ser' name='ser' value='{{ $obj[0]->_deviceId->_SerialNumber }}'>
        <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
        <button type='submit' class='btn btn-outline-primary'>Cambiar</button>
    </form>

    NAT: @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
    Estado: @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionStatus->_value=='Connected') En uso
    @else Desconectado
    @endif<br>
    <br>
    --------------------------------------------------------------------------<br><br>
    <?php
    }
    }
    ?>
@endsection
