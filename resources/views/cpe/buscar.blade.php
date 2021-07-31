@extends('home2')

@section('content2')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <br /><br />
    <div class="container" style="width:600px;">
        <h2 align="center">Buscador de CPE</h2>
        <br /><br />
        <form action='{{ route('rescpe') }}' method='POST' role='form'>
            {{ csrf_field() }}
            <label>Buscar</label>
            <input type="text" name="dat" id="dat" class="form-control input-lg" autocomplete="off" placeholder="Introducir Serial, Contrato o Telefono" />
            <!-- <br><select class="form-control input-lg" name="busp" id="busp">
                <option value="1">Serial</option>
                <option value="2">Contrato</option>
                <option value="3">Telefono</option>
            </select> -->
            <br><center><button type='submit' class='btn btn-outline-primary'>Buscar</button></center>
        </form>
    </div>

        <br><br><center><a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Volver</a>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Pagina Principal</a><br>
        </center>
@endsection
