<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReglaController extends Controller
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
        $name = $request->name;
        $code = $request->code;
        $post = $code;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/provisions/".$name);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $objpost = json_decode($output);

        return redirect()->route('home');
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
    }

    public function cregla()
    {

        return view('reglas.cregla', ['id' => 0]);
    }

    public function aregla()
    {

        return view('reglas.aregla', ['id' => 0]);
    }

    public function store2(Request $request)
    {
        //
        $name = $request->name;
        $event = $request->event;
        $precondition = $request->precondition;
        $regla = $request->regla;
        $post = '{"weight": 0, "channel":"'.$name.'", "precondition": "'.$precondition.'", "events": {"'.$event.'": true}, "configurations": [{"type": "provision", "name": "'.$regla.'", "args": null}]}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$this->mainip.":7557/presets/".$name);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($ch);
        curl_close($ch);
        $objpost = json_decode($output);

        return redirect()->route('home');
    }
}
