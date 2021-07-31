@extends('home2')

@section('content2')
<div class="container">
    <div class="card">
    <div class="row">
        <div class="col-sm">
            <br><br>
            <center>
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>Regla</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $i<$l2; $i++) {
                if(isset($obj2[$i]->_id)){
                ?>
                <tr>
                    <td>{{ $obj2[$i]->_id }}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <form action='{{ route('regla.edit',$obj2[$i]->_id) }}' method='GET' role='form'>
                            {{ csrf_field() }}
                            <input type='hidden' id='id' name='id' value='{{ $obj2[$i]->_id }}'>
                            <button type='submit' class='btn btn-outline-primary'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form onsubmit="return confirm('Quiere eliminar la regla?');" action='{{ route('regla.destroy',$obj2[$i]->_id) }}' method='POST' role='form'>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type='hidden' id='idd' name='idd' value='{{ $obj2[$i]->_id }}'>
                            <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                }
                ?>
                </tbody>
            </table>
            </center>
        </div>
        <div class="col-sm">
            <br><br>
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>Reglas asignadas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $i<$l3; $i++) {
                if(isset($obj3[$i]->_id)){
                ?>
                <tr>
                    <td>{{ $obj3[$i]->_id }}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <form action='{{ route('earegla', $obj3[$i]->_id) }}' method='GET' role='form'>
                            {{ csrf_field() }}
                            <input type='hidden' id='id' name='id' value='{{ $obj3[$i]->_id }}'>
                            <button type='submit' class='btn btn-outline-primary'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form onsubmit="return confirm('Quiere eliminar la regla?');" action='{{ route('daregla',$obj3[$i]->_id) }}' method='POST' role='form'>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type='hidden' id='idd' name='idd' value='{{ $obj3[$i]->_id }}'>
                            <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
