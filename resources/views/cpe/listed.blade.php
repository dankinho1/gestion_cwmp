@extends('layouts.app')

@section('content')
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
    ?>
    <tr>
        <form action='{{ route('regcpe.update',$i+1) }}' method='POST'>
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <td>{{ $obj[$i]->serial }}</td>
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
                <input type='hidden' id='ser' name='ser' value='{{ $obj[$i]->serial }}'>
                <button type='submit' class='btn btn-outline-primary'>Editar</button>
            </td>
        </form>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
@endsection
