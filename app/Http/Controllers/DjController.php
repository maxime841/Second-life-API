<?php

namespace App\Http\Controllers;

use App\Models\Dj;
use Illuminate\Http\Request;

class DjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $djs = Dj::all();
        foreach ($djs as $dj) {
            foreach ($dj->pictures as $picture){
               if($picture->favori == true && $picture->picturable_id == $dj->id) {
                $dj->picture = $picture;
                }
            }
        }     
        return response()->json(['djs' => $djs]);
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
        $dj = Dj::create($request->all());
        return redirect()->route('dj.index', [$dj]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dj =  Dj::find($id);
        foreach ($dj->pictures as $picture){
            if($picture->picturable_type == 'dj') {
             $dj->picture = $picture;
            }
        }
        return response()->json(['club' => $dj]);
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
        $djId = Dj::find($id);
        $djId->update([
            'name' => $request->name,
            'style' => $request->style,
            'date_entrance' => $request->date_entrance,
        ]);

        return response()->json(['dj' => $djId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $djId = Dj::find($id);
        $djId->delete();
    }
}
