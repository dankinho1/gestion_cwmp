<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chart;
use App\Models\ModemCPE;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $mainip = '172.21.22.136';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_cttos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $ctto[$i] = $reg1[ 'ctto_adsl' ];
            $telf[$i] = $reg1[ 'telf' ];
            $i++;
        }
        $co = count($ctto);
        echo $co;

        $id = Auth::user()->roles_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/provisions/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l2 = count($obj2);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/presets/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj3 = json_decode($output);
        $l3 = count($obj3);

        $usu = User::all();
        $lusu = count($usu);
        $mod = ModemCPE::all();
        $lmod = count($mod);
        echo count($mod);
        return view('home', ['id' => $id, 'ctto' => $ctto, 'telf' => $telf, 'co' => $co, 'obj' => $obj, 'l' => $l, 'usu' => $usu, 'lusu' => $lusu, 'mod' => $mod, 'lmod' => $lmod, 'obj2' => $obj2, 'l2' => $l2, 'obj3' => $obj3, 'l3' => $l3]);
    }

    public function home2()
    {
        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_cttos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $ctto[$i] = $reg1[ 'ctto_adsl' ];
            $telf[$i] = $reg1[ 'telf' ];
            $i++;
        }
        $co = count($ctto);
        echo $co;

        $id = Auth::user()->roles_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/provisions/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l2 = count($obj2);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/presets/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj3 = json_decode($output);
        $l3 = count($obj3);

        $usu = User::all();
        $lusu = count($usu);
        $mod = ModemCPE::all();
        $lmod = count($mod);
        echo count($mod);

        // Get cpes grouped by state
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
            $now2 = \Carbon\Carbon::now()->subMinutes(6);
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
        return view('charts.index', ['id' => $id, 'ctto' => $ctto, 'telf' => $telf, 'chart' => $chart, 'co' => $co, 'obj' => $obj, 'l' => $l, 'usu' => $usu, 'lusu' => $lusu, 'mod' => $mod, 'lmod' => $lmod, 'obj2' => $obj2, 'l2' => $l2, 'obj3' => $obj3, 'l3' => $l3, 'inf' => $inf]);
    }

    public function gestion()
    {
        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_cttos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $ctto[$i] = $reg1[ 'ctto_adsl' ];
            $telf[$i] = $reg1[ 'telf' ];
            $i++;
        }
        $co = count($ctto);
        echo $co;

        $id = Auth::user()->roles_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/provisions/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l2 = count($obj2);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/presets/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj3 = json_decode($output);
        $l3 = count($obj3);

        $usu = User::all();
        $lusu = count($usu);
        $mod = ModemCPE::all();
        $lmod = count($mod);
        echo count($mod);
        return view('cpe.gestion', ['id' => $id, 'ctto' => $ctto, 'telf' => $telf, 'co' => $co, 'obj' => $obj, 'l' => $l, 'usu' => $usu, 'lusu' => $lusu, 'mod' => $mod, 'lmod' => $lmod, 'obj2' => $obj2, 'l2' => $l2, 'obj3' => $obj3, 'l3' => $l3]);
    }

    public function principalregla()
    {
        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_cttos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $ctto[$i] = $reg1[ 'ctto_adsl' ];
            $telf[$i] = $reg1[ 'telf' ];
            $i++;
        }
        $co = count($ctto);
        echo $co;

        $id = Auth::user()->roles_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/provisions/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l2 = count($obj2);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/presets/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj3 = json_decode($output);
        $l3 = count($obj3);

        $usu = User::all();
        $lusu = count($usu);
        $mod = ModemCPE::all();
        $lmod = count($mod);
        echo count($mod);
        return view('reglas.principalregla', ['id' => $id, 'ctto' => $ctto, 'telf' => $telf, 'co' => $co, 'obj' => $obj, 'l' => $l, 'usu' => $usu, 'lusu' => $lusu, 'mod' => $mod, 'lmod' => $lmod, 'obj2' => $obj2, 'l2' => $l2, 'obj3' => $obj3, 'l3' => $l3]);
    }

    public function listprin()
    {
        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_cttos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $ctto[$i] = $reg1[ 'ctto_adsl' ];
            $telf[$i] = $reg1[ 'telf' ];
            $i++;
        }
        $co = count($ctto);
        echo $co;

        $id = Auth::user()->roles_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/devices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $r = substr($output,0,-2);
        $r = substr($r,2);
        $obj = json_decode($output);
        $l = count($obj);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/provisions/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj2 = json_decode($output);
        $l2 = count($obj2);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/presets/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $obj3 = json_decode($output);
        $l3 = count($obj3);

        $usu = User::all();
        $lusu = count($usu);
        $mod = ModemCPE::all();
        $lmod = count($mod);
        echo count($mod);
        return view('cpe.listprin', ['id' => $id, 'ctto' => $ctto, 'telf' => $telf, 'co' => $co, 'obj' => $obj, 'l' => $l, 'usu' => $usu, 'lusu' => $lusu, 'mod' => $mod, 'lmod' => $lmod, 'obj2' => $obj2, 'l2' => $l2, 'obj3' => $obj3, 'l3' => $l3]);
    }
}
