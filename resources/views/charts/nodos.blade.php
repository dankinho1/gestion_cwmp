@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading my-2">CPEs inactivos por nodos</div>
                    <div class="col-lg-10">
                        <canvas id="userChart" class="rounded shadow"></canvas>
                    </div>
                    <br>
                    <div class="col-lg-10">
                        Lista de CPEs inactivos<br><br>
                        @for($i=0;$i<$infsc;$i++)
                            <div class="col-lg-10">
                                En nodo {{ $infn[$i] }}:<br>
                                @for($j=0;$j<$infsc;$j++)
                                    @if($infn[$i]==$infn[$j])
                                        {{ $infs[$j] }}<br>
                                    @endif
                                @endfor
                                <br>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <br><br><center><a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Volver</a>
            <a type="button" href="{{ route('home') }}" class="btn btn-outline-primary">Pagina Principal</a><br>
        </center>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- CHARTS -->
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
// The data for our dataset
            data: {
                labels:  {!!json_encode($chart->labels)!!} ,
                datasets: [
                    {
                        label: 'Estado de CPEs',
                        backgroundColor: {!! json_encode($chart->colours)!!} ,
                        data:  {!! json_encode($chart->dataset)!!} ,
                    },
                ]
            },
// Configuration options go here
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Pie Chart'
                    }
                }
            },
        });
    </script>
@endsection
