<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Picture::all();

        $picture_filtered_land = $pictures->filter(function($value){
                return $value->tag === 'land';
        });
        return response()->json(['land' => $picture_filtered_land]);
       
        /*switch($pictures){
            case  $pictures->tag  === 'land':
                Log::channel('stderr')->info('tag_land', [$pictures]);
               // $picture_filtered_land = $pictures->filter(function($value){
                //    return $value->tag === 'land' && $value->picturable_id === 'land_id';
                //});
                $picture_filtered_land = Picture::all();
                Log::channel('stderr')->info('pictures_land', [$picture_filtered_land]); 
                return response()->json(['land' => $picture_filtered_land]);
                break;

            /*case $pictures->tag === 'house':
                $picture_filtered_club = $pictures->filter(function($value){
                    return $value->tag === 'club' && $value->picturable_id === 'club_id';
                });
                return response()->json(['club' => $picture_filtered_club]);
                break; 

            case $pictures->tag === 'club':
                $picture_filtered_club = $pictures->filter(function($value){
                    return $value->tag === 'club' && $value->picturable_id === 'club_id';
                });
                return response()->json(['club' => $picture_filtered_club]);
                break;

            case $pictures->tag === 'dj':
                $picture_filtered_dj = $pictures->filter(function($value){
                    return $value->tag === 'dj' && $value->picturable_id === 'dj_id';
                });
                return response()->json(['dj' => $picture_filtered_dj]);
                break;

            case $pictures->tag === 'dancer':
                $picture_filtered_dancer = $pictures->filter(function($value){
                    return $value->tag === 'dancer' && $value->picturable_id === 'dancer_id';
                });
                return response()->json(['dancer' => $picture_filtered_dancer]);
                break;
        }*/
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
