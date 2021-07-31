@extends('home2')

@section('content2')

<div class="app-main__inner">
    <!-- cuadrados de colores-->
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Equipos activos</div>
                        <div class="widget-subheading">conectados al servidor</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $inf[0] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Equipos inactivos</div>
                        <div class="widget-subheading">sin conexion al servidor</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $inf[1] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total</div>
                        <div class="widget-subheading">registrados en el sistema total</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $inf[0]+$inf[1] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin cuadrados de colores-->
    <!-- cuadros estadisticos -->
    <div class="row">
        <div class="col-md-12 col-lg-10">
            <div class="mb-3 card">
                @yield('graph1')
            </div>
        </div>
    </div>
    <!-- fin cuadros estadisticos-->
    <!-- usuarios activos -->
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Usuarios activos
                </div>
                @yield('usu2')
            </div>
        </div>
    </div>
    <!-- fin usuarios activos -->
</div>
@endsection
