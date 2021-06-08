@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    @if(isset($obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value))
    Serial: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value }}<br>

    <h2>Resultado Ping</h2>
    Host: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->Host->_value }}<br>
    Estado: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->DiagnosticsState->_value }}<br>
    Paquetes recibidos exitosamente: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->SuccessCount->_value }}<br>
    Tiempo de respuesta maximo: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->MaximumResponseTime->_value }}<br>
    Tiempo de respuesta minimo: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->MinimumResponseTime->_value }}<br>
    Tiempo promedio: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->AverageResponseTime->_value }}<br>
    @else
        Serial: {{ $obj[0]->Device->DeviceInfo->SerialNumber->_value }}<br>

        <h2>Resultado Ping</h2>
        Host: {{ $objps[0]->Device->IP->Diagnostics->IPPing->Host->_value }}<br>
        Estado: {{ $objps[0]->Device->IP->Diagnostics->IPPing->DiagnosticsState->_value }}<br>
        Paquetes recibidos exitosamente: {{ $objps[0]->Device->IP->Diagnostics->IPPing->SuccessCount->_value }}<br>
        Tiempo de respuesta maximo: {{ $objps[0]->Device->IP->Diagnostics->IPPing->MaximumResponseTime->_value }}<br>
        Tiempo de respuesta minimo: {{ $objps[0]->Device->IP->Diagnostics->IPPing->MinimumResponseTime->_value }}<br>
        Tiempo promedio: {{ $objps[0]->Device->IP->Diagnostics->IPPing->AverageResponseTime->_value }}<br>
    @endif

@endsection
