<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::all();
        foreach ($clubs as $club) {
            foreach ($club->pictures as $picture){
               if($picture->favori == true && $picture->picturable_id == $club->id) {
                $club->picture = $picture;
                }
            }
        }     
        return response()->json(['clubs' => $clubs]);
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
        $club = Club::create($request->all());
        return redirect()->route('club.index', [$club]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $club =  Club::find($id);
        foreach ($club->pictures as $picture){
            if($picture->picturable_type == 'club') {
             $club->picture = $picture;
            }
        }
        return response()->json(['club' => $club]);
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
        $clubId = Club::find($id);
        $clubId->update([
            'name' => $request->name,
            'owner' => $request->owner,
        ]);

        return response()->json(['club' => $clubId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clubId = Club::find($id);
        $clubId->delete();
    }
}
