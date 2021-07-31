@extends('home3')

@section('graph1')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading my-2">CPEs activos e inactivos</div>
                <div class="col-lg-8">
                    <canvas id="userChart" class="rounded shadow"></canvas>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- CHARTS -->
<script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
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
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>
@endsection

@section('usu2')
    <div class="table-responsive">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Usuario</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Nivel de Usuario</th>
                <th class="text-center">Accciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $i<$lusu; $i++) {
                if(isset($usu[$i]->id)){
                    ?>
            <tr>
                <td class="text-center text-muted">#{{ $usu[$i]->id }}</td>
                <td>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img width="40" class="rounded-circle" src="{{ url('/js/assets/images/avatars/unkn.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">{{ $usu[$i]->name }}</div>
                                <div class="widget-subheading opacity-7">Web Developer</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">{{ $usu[$i]->email }}</td>
                <td class="text-center">
                    <div class="badge badge-warning">{{ $usu[$i]->roles->name }}</div>
                </td>
                <td class="text-center">
                    <form action='{{ route('users.edit',$usu[$i]->id) }}' method='GET' role='form'>
                        {{ csrf_field() }}
                        <input type='hidden' id='id' name='id' value='{{ $usu[$i]->id }}'>
                    <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Editar</button>
                    </form>
                </td>
                <td class="text-center">
                    <form onsubmit="return confirm('Quiere eliminar el usuario?');" action='{{ route('users.destroy',$usu[$i]->id) }}' method='POST' role='form'>
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type='hidden' id='id' name='id' value='{{ $usu[$i]->id }}'>
                    <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Eliminar</button>
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
@endsection
