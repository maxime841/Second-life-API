<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $house = House::all();
        $picture = DB::table('pictures')
        ->where('favori', '=', 'true')
        ->where('tag', '=', 'house')
        ->get();
        
        return response()->json(['house', $house, $picture]);
        
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
        $house = House::create($request->all());
        return redirect()->route('houses.index', [$house]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house =  House::find($id);
        return response()->json(['house' => $house]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::findOrFail($id);
        return response()->json(['house' => $house]);
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
        $houseId = House::find($id);
        $houseId->update([
            'name' => $request->name,
            'owner' => $request->owner,
            'presentation' => $request->presentation,
            'description' => $request->description,
            'group' => $request->group,
            'prims' => $request->prims,
            'remaining_prims' => $request->remaining_prims,
        ]);

        return response()->json(['house' => $houseId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $houseId = House::find($id);
        $houseId->delete();
    }
}
