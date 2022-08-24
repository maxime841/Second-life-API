<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_land()
    {
        $pictures = Picture::all();
        $picture_filtered_land = $pictures->filter(function($value){
            return $value->picturable_type === 'land';
        });  
    return response()->json(['land' => $picture_filtered_land]); 
    }

    public function index_house()
    {
        $pictures = Picture::all();
        $picture_filtered_house = $pictures->filter(function($value){
            return $value->tag === 'house';
        });
        return response()->json(['house' => $picture_filtered_house]); 
    }

    public function index_club()
    {
        $pictures = Picture::all();
        $picture_filtered_club = $pictures->filter(function($value){
            return $value->tag === 'club';
        });
        return response()->json(['club' => $picture_filtered_club]); 
    }

    public function index_dj()
    {
        $pictures = Picture::all();
        $picture_filtered_dj = $pictures->filter(function($value){
            return $value->tag === 'dj';
        });
        return response()->json(['dj' => $picture_filtered_dj]); 
    }

    public function index_dancer()
    {
        $pictures = Picture::all();
        $picture_filtered_dancer = $pictures->filter(function($value){
            return $value->tag === 'dancer';
        });
        return response()->json(['dancer' => $picture_filtered_dancer]); 
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
        //Storage::disk('public')->put('image', $request->file('upload'));
        //die();
        $picture = Picture::create($request->all());
        
        return response()->json(['picture' => $picture]);
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
}
