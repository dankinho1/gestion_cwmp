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
            <form action='{{ route('regcpe.destroy',$obj[$i]->id) }}' method='POST'>
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <td>{{ $obj[$i]->serial }}</td>
                <td>{{--  @for ( $ii = 0; $ii < $co; $ii++) --}}
                        {{-- $ctto[$ii] --}}9
                        {{--  @endfor --}}
                </td>
                <td>
                        {{--    @for ($ii = 0; $ii < $co; $ii++)  --}}
                        {{-- $telf[$ii] --}}9
                        {{--   @endfor --}}
                </td>
                <td>
                    <input type='hidden' id='ser' name='ser' value='{{ $obj[$i]->serial }}'>
                    <button type='submit' class='btn btn-outline-primary'>Eliminar</button>
                </td>
            </form>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
@endsection
