<?php

namespace App\Http\Controllers;

use App\Models\Tell;
use Illuminate\Http\Request;

class TellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tell::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Tell::create($request->all());

        return response('', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tell  $tell
     * @return \Illuminate\Http\Response
     */
    public function show(Tell $tell)
    {
        return $tell;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tell  $tell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tell $tell)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $tell->update($request->all());

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tell  $tell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tell $tell)
    {
        $tell->delete();

        return response('', 204);
    }
}
