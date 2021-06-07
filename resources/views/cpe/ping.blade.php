@extends('cpe.par')

@section('tr')
    CPE ID: {{ $obj[0]->_id }}<br>
    Serial: {{ $obj[0]->InternetGatewayDevice->DeviceInfo->SerialNumber->_value }}<br>

        <form action='{{ route('pings') }}' method='POST' role='form'>
            {{ csrf_field() }}
            <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
            <input type='hidden' id='se' name='se' value='{{ $se }}'>
            <button type='submit' class='btn btn-outline-primary'>Ping a servidor</button>
        </form>
        <form action='{{ route('pingb') }}' method='POST' role='form'>
            {{ csrf_field() }}
            <input type='hidden' id='id' name='id' value='{{ $obj[0]->_id }}'>
            <button type='submit' class='btn btn-outline-primary'>Ping a Router BRAS</button>
        </form>

@endsection
