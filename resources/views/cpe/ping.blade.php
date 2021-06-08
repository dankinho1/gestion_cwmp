@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    @if(isset($obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value))
    Serial: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value }}<br>
    @else
        Serial: {{ $obj[0]->Device->DeviceInfo->SerialNumber->_value }}<br>
        @endif

        <form action='{{ route('pings') }}' method='POST' role='form'>
            {{ csrf_field() }}
            @if(isset($obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value))
                <input type='hidden' id='tr' name='tr' value='98'>
            @else
                <input type='hidden' id='tr' name='tr' value='181'>
                @endif
            <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
            <input type='hidden' id='se' name='se' value='{{ $se }}'>
            <button type='submit' class='btn btn-outline-primary'>Ping a servidor</button>
        </form>
        <form action='{{ route('pingb') }}' method='POST' role='form'>
            {{ csrf_field() }}
            @if(isset($obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value))
                <input type='hidden' id='tr' name='tr' value='98'>
            @else
                <input type='hidden' id='tr' name='tr' value='181'>
            @endif
            <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
            <input type='hidden' id='se' name='se' value='{{ $se }}'>
            <button type='submit' class='btn btn-outline-primary'>Ping a Router BRAS</button>
        </form>

@endsection
