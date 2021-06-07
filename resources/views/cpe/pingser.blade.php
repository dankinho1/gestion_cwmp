@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    Serial: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value }}<br>

    <h2>Resultado Ping</h2>
    Estado: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->DiagnosticsState->_value }}<br>
    Paquetes recibidos exitosamente: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->SuccessCount->_value }}<br>
    Tiempo de respuesta maximo: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->MaximumResponseTime->_value }}<br>
    Tiempo de respuesta minimo: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->MinimumResponseTime->_value }}<br>
    Tiempo promedio: {{ $objps[0]->InternetGatewayDevice->IPPingDiagnostics->AverageResponseTime->_value }}<br>

@endsection
