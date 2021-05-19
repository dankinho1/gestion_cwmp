<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ModemCPE;

class HomeController extends Controller
{
    public $mainip = '192.168.0.102';
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
        /*$i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_cttos");
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $ctto[$i] = $reg1[ 'ctto_adsl' ];
            $telf[$i] = $reg1[ 'telf' ];
            $i++;
        }
        $co = count($ctto);
        echo $co;*/

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
        $usu = User::all();
        $lusu = count($usu);
        $mod = ModemCPE::all();
        $lmod = count($mod);
        echo $lusu;
        return view('home', ['id' => $id, /*'ctto' => $ctto, 'telf' => $telf, 'co' => $co,*/ 'obj' => $obj, 'l' => $l, 'usu' => $usu, 'lusu' => $lusu, 'mod' => $mod, 'lmod' => $lmod]);
    }
}
