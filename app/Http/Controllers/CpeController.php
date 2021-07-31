<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\ModemCPE;
use Illuminate\Support\Facades\Auth;

class CpeController extends Controller
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
        $ctto = $request->ctto;
        $telf = $request->telf;
        $ser = $request->ser;
        $dcpe = ModemCPE::all();
        $f=0;
        foreach($dcpe as $dcp) {
            if($dcp->contrato==$ctto) {
                echo '<script language="javascript">alert("El contrato ya esta registrado");</script>';
                $f=1;
                break;
            } elseif ($dcp->telefono==$telf) {
                echo '<script language="javascript">alert("El telefono ya esta registrado");</script>';
                $f=2;
                break;
            }
        }

        $i=0;
        $link = mysqli_connect( "172.21.22.136", "norah3","Norah123", "sistemas" )or( "Error :" . mysqli_error( $link ) );

        $lia1=mysqli_query($link,"SELECT * FROM activos_ports WHERE ctto=".$ctto);
        while ( $reg1 = mysqli_fetch_array( $lia1 ) ) {
            $nodo[$i] = $reg1[ 'nodo' ];
            $i++;
        }
        $co = count($nodo);

        if($f==0) {
            $modemcpe = new ModemCPE();
            $modemcpe->serial = $ser;
            $modemcpe->contrato = $ctto;
            $modemcpe->telefono = $telf;
            $modemcpe->nodo = $nodo[0];
            $modemcpe->save();
        }

        return redirect()->route('home2');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cpe = ModemCPE::find($id);
        $cpe->serial = $request->ser;
        $cpe->contrato = $request->ctto;
        $cpe->telefono = $request->telf;
        $cpe->save();

        return redirect()->route('home2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        ModemCPE::destroy($id);

        return redirect()->route('home2');
    }

    public function listed()
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
        echo $id;
        $modemcpe = new ModemCPE();
        $u = ModemCPE::all();
        $l = count($u);
        echo $l;

        return view('cpe.listed', ['id' => $id, 'ctto' => $ctto, 'telf' => $telf, 'co' => $co, 'obj' => $u, 'l' => $l]);
    }

    public function listdes()
    {
        $id = Auth::user()->roles_id;
        echo $id;
        $modemcpe = new ModemCPE();
        $u = ModemCPE::all();
        $l = count($u);
        echo $l;

        return view('cpe.listdes', ['id' => $id, 'obj' => $u, 'l' => $l]);
    }
}
