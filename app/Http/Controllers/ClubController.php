<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ClubCreateRequest;
use App\Http\Requests\ClubUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    /**
     * get all clubs.
     * * 200 [clubs]
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(): JsonResponse
    {
        $clubs = Club::all();
        foreach ($clubs as $club) {
            foreach ($club->pictures as $picture) {
                if ($picture->favori == true) {
                    $club->picture = $picture;
                }
            }
        }
        return response()->json(['clubs' => $clubs], 200);
    }

    /**
     * get one land.
     * * 200 [land]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOne($id): JsonResponse
    {
        $club = Club::find($id);
        foreach ($club->pictures as $picture) {
            if ($picture->favori == true) {
                $club->picture = $picture;
            }
        }
        return response()->json(['club' => $club], 200);
    }

    /**
     * create land and add image if input image exist.
     * * 201 [land]
     * * 422 [message, errors=>nameinput]
     * * 401 [message]
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClubCreateRequest $request): JsonResponse
    {

        $validate = $request->validated();
        $club = Club::create($validate);

        // for image upload on create club
        if ($request->image) {
            $file = $request->file('image');
            $extension = $file->extension();
            $nameImage = $club->id . 'club' . uniqid() . '.' . $extension;

            $path = $request->file('image')->storeAs(
                'public/images/clubs',
                $nameImage
            );

            $picture = Picture::create([
                'name' => $nameImage,
                'picture_url' => $path,
                'favori' => true,
            ]);

            $club->pictures()->save($picture);
        }

        $club->pictures;

        return response()->json(['club' => $club], 201);
    }

    /**
     * Update the specified resource in storage.
     * * 200 [land]
     * * 422 [message, errors=>nameinput]
     * * 401 [message]
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClubUpdateRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $club = Club::find($request->id);
        $club->forceFill($validate)->save();
        $club->pictures;

        return response()->json(['club' => $club], 200);
    }

    /**
     * upload all images
     * * 200 [land]
     * * 401 [message]
     * * 422 [message, errors=>nameinput]
     *
     * @return JsonResponse
     */
    public function uploadFiles(Request $request)
    {
        $request->validate(['images' => 'required']);
        $club = Club::find($request->id);

        foreach ($request->file('images') as $image) {
            $extension = $image->extension();
            $nameImage = $club->id . 'club' . uniqid() . '.' . $extension;

            $path = $image->storeAs(
                'public/images/clubs',
                $nameImage
            );

            $picture = Picture::create([
                'name' => $nameImage,
                'picture_url' => $path,
                'favori' => false,
            ]);

            $club->pictures()->save($picture);
        }

        $club->pictures;
        return response()->json(['club' => $club]);
    }

    /**
     * delete land.
     * * 200 [message, delete]
     * * 401 [message]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request): JsonResponse
    {
        $club = Club::find($request->id);
        Log::channel('stderr')->info('club selectionner', [$club]);
        if ($club->djs()) {
            return response()->json([
                'message' => 'Ce club contient des djs, impossible de le supprimer',
                'delete' => false,
            ], 200);
        }

        else if ($club->dancers()) {
            return response()->json([
                'message' => 'Ce club contient des danseurs, impossible de le supprimer',
                'delete' => false,
            ], 200);
        }

        else if ($club->parties()) {
            return response()->json([
                'message' => 'Ce club contient des soirées, impossible de le supprimer',
                'delete' => false,
            ], 200);
        }

        // delete all image file in project
        foreach ($club->pictures as $picture) {
            Storage::delete($picture->picture_url);
        }
        // delete all image in database
        $club->pictures()->delete();
        // delete club
        $club->delete();

        return response()->json([
            'message' => 'Le club a bien été supprimé',
            'delete' => true,
        ], 200);
    }
}