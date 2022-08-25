<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateProfilRequest;
use App\Services\UserUpdateProfil\UserUpdateProfilService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * instance of UserUpdateProfilService
     *
     * @var [type]
     */
    public $userUpdateProfilService;

    /**
     * init class
     */
    public function __construct()
    {
        $this->userUpdateProfilService = new UserUpdateProfilService();
    }

    /**
     * get profil of user current
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getProfil(Request $request): JsonResponse
    {
        return response()->json(['userProfil' => $request->user()]);
    }

    /**
     * update profil user current
     *
     * @param UserUpdateProfilRequest $request
     * @return JsonResponse
     */
    public function updateProfil(UserUpdateProfilRequest $request): JsonResponse
    {
        $validate = $request->validated();

        // if email => deconnect user, send email verification
        // else update profil user
        if (
            $request->user()->email !== $validate['email'] &&
            $request->user() instanceof MustVerifyEmail
        ) {
            $userUpdated = $this->userUpdateProfilService
                ->userUpdateProfilVerifiedEmail($request->user(), $validate);
            $request->user()->tokens()->delete();
            return response()->json(['authenticated' => false], 200);
        } else {
            $userUpdated = $this->userUpdateProfilService
                ->userUpdateProfil($request->user(), $validate);
            return response()->json(['userUpdated' => $userUpdated], 200);
        }
    }
}
