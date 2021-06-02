<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\ModemCPE;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public $mainip = '172.21.22.136';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Get users grouped by age
        $groups = DB::table('users')
            ->select('roles_id', DB::raw('count(*) as total'))
            ->groupBy('roles_id')
            ->pluck('total', 'roles_id')->all();
        $act = array(0 => 'activos', 1 => 'inactivos');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices?projection=_lastInform");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($output);
        $objl = count($obj);
        $inf[0] = 0;
        $inf[1] = 0;
        for($i=0;$i<$objl;$i++) {
            $lidate = date('Y-m-d H:i:s', strtotime($obj[$i]->_lastInform));
            $now2 = \Carbon\Carbon::now()->subMinutes(10);
            if ($lidate >= $now2) {
                $inf[0] = $inf[0] + 1;
            } else {
                $inf[1] = $inf[1] + 1;
            }
        }

// Generate random colours for the groups
        for ($i=0; $i<=count($groups); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
// Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = ($act);
        $chart->dataset = ($inf);
        $chart->colours = $colours;
        return view('charts.index', compact('chart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }

    public function nodos()
    {
        //
        //
        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "soia" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM nodos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $nodo[$i] = $reg1[ 'nodoid' ];
            $i++;
        }
        $co = count($nodo);

        $groups = DB::table('users')
            ->select('roles_id', DB::raw('count(*) as total'))
            ->groupBy('roles_id')
            ->pluck('total', 'roles_id')->all();
        $act = array(0 => 'activos', 1 => 'inactivos');

        $modemcpe = new ModemCPE();
        $u = ModemCPE::all();
        $l = count($u);
        echo $co;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://" . $this->mainip . ":7557/devices?projection=_lastInform,_deviceId._SerialNumber");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($output);
            $objl = count($obj);
        for($i=0;$i<$l;$i++) {
            $act[$u[$i]->nodo]=0;
            for($j=0;$j<$objl;$j++) {
                if ($u[$i]->serial == $obj[$j]->_deviceId->_SerialNumber) {
                    $lv[$i] = $obj[$j]->_lastInform;
                }
            }
        }

        for($k=0;$k<$co;$k++) {
            $inf[$k] = 0;
            for($j=0;$j<$l;$j++) {
                if ($nodo[$k]==$u[$j]->nodo) {
                        $lidate = date('Y-m-d H:i:s', strtotime($lv[$j]));
                        $now2 = \Carbon\Carbon::now()->subMinutes(10);
                        if ($lidate < $now2) {
                            $inf[$k] = $inf[$k] + 1;
                        }
                }
            }
        }

// Generate random colours for the groups
        for ($i=0; $i<=$co; $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
// Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = ($nodo);
        $chart->dataset = ($inf);
        $chart->colours = $colours;
        return view('charts.nodos', compact('chart'));
    }
}
