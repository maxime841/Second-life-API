<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HouseCreateRequest;
use App\Http\Requests\HouseUpdateRequest;
use App\Models\Land;
use App\Models\Tenant;

class HouseController extends Controller
{
    /**
     * get all.
     * * 200 [houses]
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(): JsonResponse
    {
        $houses = House::all();
        foreach ($houses as $house) {
            if ($house->pictures) {
                foreach ($house->pictures as $picture) {
                    if ($picture->favori == true) {
                        $house->picture_favoris = $picture;
                    }
                }
            }
        }

        return response()->json(['houses' => $houses], 200);
    }

    /**
     * get one.
     * * 200 [house]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOne($id): JsonResponse
    {
        $house =  House::find($id);
        if ($house->pictures) {
            foreach ($house->pictures as $picture) {
                if ($picture->favori == true) {
                    $house->picture_favoris = $picture;
                }
            }
        }
        return response()->json(['house' => $house], 200);
    }

    /**
     * create house.
     * * 200 [house]
     * * 401 [message]
     * * 422 [message, errors->nameinput]
     *
     * @return \Illuminate\Http\Response
     */
    public function create(HouseCreateRequest $request): JsonResponse
    {
        $validate = $request->validated();
        $validate['owner'] = $request->owner ?? null;
        $validate['date_start_rent'] = $request->date_start_rent ?? null;
        $validate['date_end_rent'] = $request->date_end_rent ?? null;
        $house = House::create($validate);
        $land = Land::find($request->id_land);

        // for image upload on create 
        if ($request->image) {
            $file = $request->file('image');
            $extension = $file->extension();
            $nameImage = $house->id . 'house' . uniqid() . '.' . $extension;

            $path = $request->file('image')->storeAs(
                'public/images/houses',
                $nameImage
            );

            $picture = Picture::create([
                'name' => $nameImage,
                'picture_url' => $path,
                'favori' => true,
            ]);

            $house->pictures()->save($picture);
            $land->houses()->save($house);
        }

        $house->pictures;
        $house->land;

        return response()->json(['house' => $house], 201);
    }

    /**
     * update house.
     * * 200 [house]
     * * 401 [message]
     * * 422 [message, errors->nameinput]
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseUpdateRequest $request): JsonResponse
    {
        $validate = $request->validated();
        $validate['owner'] = $request->owner ?? null;
        $validate['date_start_rent'] = $request->date_start_rent ?? null;
        $validate['date_end_rent'] = $request->date_end_rent ?? null;

        $house = House::find($request->id);
        $house->forceFill($validate)->save();
        $house->pictures;

        return response()->json(['house' => $house], 200);
    }

    /**
     * upload all picture for one house
     * * 200 [house]
     * * 401 [message]
     * * 422 [message, errors=>nameinput]
     *
     * @param Request $request
     * @return void
     */
    public function uploadFiles(Request $request)
    {
        $request->validate(['images' => 'required']);
        $house = House::find($request->id);

        foreach ($request->file('images') as $image) {
            $extension = $image->extension();
            $nameImage = $house->id . 'house' . uniqid() . '.' . $extension;

            $path = $image->storeAs(
                'public/images/houses',
                $nameImage
            );

            $picture = Picture::create([
                'name' => $nameImage,
                'picture_url' => $path,
                'favori' => false,
            ]);

            $house->pictures()->save($picture);
        }

        $house->pictures;
        return response()->json(['house' => $house]);
    }

    /**
     * affected land for house
     * * 200 [house]
     * * 401 [message]
     * * 404 [message]
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function affectLandOfHouse(Request $request): JsonResponse
    {
        $house = House::findOrFail($request->idhouse);
        $land = Land::findOrFail($request->idland);

        $land->houses()->save($house);

        $house->pictures;
        $house->land;

        return response()->json(['house' => $house]);
    }

    /**
     * affect tenant for house
     * * 200 [house]
     * * 404 [message]
     * * 401 [message]
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function affectTenantOfHouse(Request $request): JsonResponse
    {
        $house = House::findOrFail($request->idhouse);
        $tenant = Tenant::findOrFail($request->idtenant);

        $tenant->houses()->save($house);

        $house->pictures;
        $house->tenant;

        return response()->json(['house' => $house]);
    }

    /**
     * delete house and delete picture's house.
     * * 200 [house]
     * * 404 [message]
     * * 401 [message]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request): JsonResponse
    {
        $house = House::findOrFail($request->id);
        foreach ($house->pictures as $picture) {
            Storage::delete($picture->picture_url);
        }
        $house->pictures()->delete();
        $house->delete();

        return response()->json(['message' => 'La maison a bien été supprimé'], 200);
    }
}
