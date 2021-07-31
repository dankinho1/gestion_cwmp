@extends('home2')

@section('content2')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
<center>
    <table>
        <thead>
        <tr>
            <th>Serial</th>
            <th>Contrato</th>
            <th>Telefono</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<$l; $i++) {
            $v1[$i]=$obj[$i]->_deviceId->_SerialNumber;
        }
        if(count($mod)!=0) {
            for ($j=0; $j<$lmod; $j++) {
                $v2[$j]=$mod[$j]->serial;
            }
        } else {
            $v2[0]=0;
        }
        $dif = array_diff($v1, $v2);
        $difl = count($dif);
        foreach ($dif as $diff) {
        for ($i=0; $i<$l; $i++) {
        if($diff==$obj[$i]->_deviceId->_SerialNumber){
        ?>
        <tr>
            <form action='{{ route('regcpe.store') }}' method='POST' role='form'>
                {{ csrf_field() }}
                <td>{{ $obj[$i]->_deviceId->_SerialNumber }}</td>
                <td>
                    <select name="ctto" id="ctto">
                        @for ( $ii = 0; $ii < $co; $ii++)
                            <option value="{{ $ctto[$ii] }}">{{ $ctto[$ii] }}</option>
                        @endfor
                    </select>
                </td>
                <td>
                    <select name="telf" id="telf">
                        @for ($ii = 0; $ii < $co; $ii++)
                            <option value="{{ $telf[$ii] }}">{{ $telf[$ii] }}</option>
                        @endfor
                    </select>
                </td>
                <td>
                    <input type='hidden' id='ser' name='ser' value='{{ $obj[$i]->_deviceId->_SerialNumber }}'>
                    <button type='submit' class='btn btn-outline-primary'>Registrar CPE</button>
                </td>
            </form>
        </tr>
        <?php
        }
        }
        }
        ?>
        </tbody>
    </table>
    <br><br>
    <form action='{{ route('listed') }}' role='form'>
        {{ csrf_field() }}
        <button type='submit' class='btn btn-outline-primary'>Editar CPEs</button>
    </form>

    <form action='{{ route('listdes') }}' role='form'>
        {{ csrf_field() }}
        <button type='submit' class='btn btn-outline-primary'>Eliminar CPEs</button>
    </form>
</center>
<br>
                </div>
            </div>
        </div>
    </div>
@endsection
