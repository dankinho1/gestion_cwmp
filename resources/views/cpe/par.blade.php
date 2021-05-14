@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div id="dom-target">

                    @yield('tr')

                </div>


            </div>
        </div>
    </div>

    <script>
        var txt = document.getElementById("dom-target");
        var obj = JSON.parse(txt.textContent);
        var nn=obj.length;
        document.getElementById("gg").innerHTML = nn;
        var g = [];
        for (var i=0, n=obj.length;i<n;i++) {
            g[i] = obj[i]._id;
            document.getElementById("demo["+i+"]").innerHTML = g[i];
        }
    </script>
@endsection
