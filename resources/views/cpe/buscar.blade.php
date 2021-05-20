@extends('layouts.app')

@section('content')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <br /><br />
    <div class="container" style="width:600px;">
        <h2 align="center">Buscar por Contrato</h2>
        <br /><br />
        <form action='{{ route('rescpe') }}' method='POST' role='form'>
            {{ csrf_field() }}
            <label>Contrato</label>
            <input type="text" name="dat" id="dat" class="form-control input-lg" autocomplete="off" placeholder="Escribir Contrato" />
            <button type='submit' class='btn btn-outline-primary'>Buscar</button>
        </form>
    </div>
        <div class="container" style="width:600px;">
            <h2 align="center">Buscar por Telefono</h2>
            <br /><br />
            <form action='{{ route('rescpe') }}' method='POST' role='form'>
                {{ csrf_field() }}
                <label>Telefono</label>
                <input type="text" name="dat" id="dat" class="form-control input-lg" autocomplete="off" placeholder="Escribir Telefono" />
                <button type='submit' class='btn btn-outline-primary'>Buscar</button>
            </form>
        </div>
        <div class="container" style="width:600px;">
            <h2 align="center">Buscar por numero Serial</h2>
            <br /><br />
            <form action='{{ route('rescpe') }}' method='POST' role='form'>
                {{ csrf_field() }}
                <label>Serial</label>
                <input type="text" name="dat" id="dat" class="form-control input-lg" autocomplete="off" placeholder="Escribir Serial" />
                <button type='submit' class='btn btn-outline-primary'>Buscar</button>
            </form>
        </div>
        <br><br><center><a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Volver</a>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Pagina Principal</a><br>
        </center>
@endsection
