@extends('home2')

@section('content2')
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
                <td>  {{ $obj[$i]->contrato }}
                </td>
                <td>
                        {{ $obj[$i]->telefono }}
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
