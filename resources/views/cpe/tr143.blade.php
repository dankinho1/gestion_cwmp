@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    Serial: {{ $obj[0]->Device->DeviceInfo->SerialNumber->_value }}<br>
    Version del Hardware: {{ $obj[0]->Device->DeviceInfo->HardwareVersion->_value }}<br>
    Version del Software: {{ $obj[0]->Device->DeviceInfo->SoftwareVersion->_value }}<br>
    Descripcion del CPE: {{ $obj[0]->Device->DeviceInfo->Description->_value }}<br>
    Fabricante: {{ $obj[0]->Device->DeviceInfo->Manufacturer->_value }}<br>
    OUI del Fabricante: {{ $obj[0]->Device->DeviceInfo->ManufacturerOUI->_value }}<br>
    Modelo: {{ $obj[0]->Device->DeviceInfo->ModelName->_value }}<br>
    Clase: {{ $obj[0]->Device->DeviceInfo->ProductClass->_value }}<br>
    Tiempo desde el ultimo reinicio: {{ $obj[0]->Device->DeviceInfo->UpTime->_value }} s<br>
    <br>
@endsection
