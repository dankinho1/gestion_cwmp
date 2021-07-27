@extends('cpe.par')

@section('tr')
    <h1>Datos Generales</h1>
    <div class="card">
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
    </div>
    <br>
    <div class="card">
    <?php
    for($i=0; $i<$eel;$i++) {
    ?>
        <b>Red WAN:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br>
        <b>Estado:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') Conectado
    @endif<br>
    <?php
    }
    ?>
    </div>
    <br>
    <h2>Wi-Fi</h2>
    <div class="card">
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
    </div>

    <h2>Conexiones WAN</h2>
    <div class="card">
    <?php
    if(isset($eel)) {
    for($i=0; $i<$eel;$i++) {
    ?>
    <h3>Conexion PPP {{ $ee3[$i] }}</h3>
        <b>Red WAN PPPoE {{ $ee3[$i] }}:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->Name->_value }}<br><br>

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

        <b>Estado:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$ee[$i]}->WANConnectionDevice->{$ee2[$i]}->WANPPPConnection->{$ee3[$i]}->ConnectionStatus->_value=='Connected') En uso
    @else Desconectado
    @endif<br><br>
    <?php
    }
    }
    echo "</div><br>";
    echo "<div class='card'>";
    if(isset($eeipl)) {
    for($i=0; $i<$eeipl;$i++) {
    ?>
    <h3>Conexion IP {{ $i+1 }}</h3>
        <b>Red WAN IP {{ $eeip3[$i] }}:</b> {{ $obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->Name->_value }}<br><br>

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

        <b>NAT:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->NATEnabled->_value=='1') Habilitado
    @else Desconectado
    @endif<br>
        <b>Estado:</b> @if($obj[0]->InternetGatewayDevice->WANDevice->{$eeip[$i]}->WANConnectionDevice->{$eeip2[$i]}->WANIPConnection->{$eeip3[$i]}->ConnectionStatus->_value=='Connected') En uso
    @else Desconectado
    @endif<br>
    <br>
    --------------------------------------------------------------------------<br><br>
    <?php
    }
    }
    ?>
    </div>
@endsection
