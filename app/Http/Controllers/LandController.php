<?php

namespace App\Http\Controllers;

use App\Http\Requests\LandCreateRequest;
use App\Models\Land;
use App\Models\Picture;
use DateTime;
use Illuminate\Http\Request;

class LandController extends Controller
{
    /**
     * get all lands.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $lands = Land::all();
        foreach ($lands as $land) {
            foreach ($land->pictures as $picture) {
                if ($picture->favori == true) {
                    $land->picture_favoris = $picture;
                }
            }
        }
        return response()->json(['land' => $lands]);
    }

    /**
     * get one land.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOne($id)
    {
        $land = Land::find($id);
        $land->pictures;
        return response()->json(['land' => $land]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(LandCreateRequest $request)
    {

        $validate = $request->validated();
        $validate['owner'] = $request->owner ?? null;
        $land = Land::create($validate);

        // for image upload on create land
        if ($request->image) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $nameImage = $land->id . 'land' . uniqid();
            $nameImageForPath = $land->id . 'land' . uniqid() . '.' . $extension;

            $path = $request->file('image')->storeAs(
                'public/images/lands',
                $nameImageForPath
            );

            $picture = Picture::create([
                'name' => $nameImage,
                'picture_url' => $path,
                'favori' => true,
            ]);

            $land->pictures()->save($picture);
        }

        return response()->json(['land' => $land]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $land = Land::create($request->all());
        return redirect()->route('lands.index', [$land]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $land = Land::findOrFail($id);
        return response()->json(['land' => $land]);
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
        $landId = Land::find($id);
        $landId->update([
            'name' => $request->name,
            'owner' => $request->owner,
            'presentation' => $request->presentation,
            'description' => $request->description,
            'group' => $request->group,
            'prims' => $request->prims,
            'remaining_prims' => $request->remaining_prims,
            'date_buy' => $request->date_buy,
        ]);

        return response()->json(['land' => $landId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $landId = Land::find($id);
        $landId->delete();
    }
}
