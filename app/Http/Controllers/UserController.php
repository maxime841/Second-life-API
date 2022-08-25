<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserUpdateProfilRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\Password\PasswordValidationRules;
use App\Services\UserUpdateProfil\UserUpdateProfilService;

class UserController extends Controller
{
    use PasswordValidationRules;

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
     * * 200 [user_profil]
     * * 401 [message]
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getProfil(Request $request): JsonResponse
    {
        return response()->json(['user_profil' => $request->user()]);
    }

    /**
     * update profil user current
     * * 200 [user_updated]
     * * 200 [authenticated]
     * * 401 [message]
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
            return response()->json(['user_updated' => $userUpdated], 200);
        }
    }

    /**
     * update password for user current
     * * 200 [update_password, authenticated]
     * * 422 [message, errors => nameofinput]
     * * 401 [message]
     *
     * @param [type] $user
     * @param array $input
     * @return JsonResponse
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $user = $request->user();
        $input = $request->input();

        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __("Le mot de passe n'est pas valide."));
            }
        })->validateWithBag('update_password_error');

        if ($request->email == $user->email) {
            $user->forceFill([
                'password' => Hash::make($input['password']),
            ])->save();
            $request->user()->tokens()->delete();
            return response()->json(['update_password' => true, 'authenticated' => false], 200);
        } else {
            return response()->json([
                'update_password' => false,
                'authenticated' => true,
                'message' => 'Un probleme est survenu veuillez vous reconnecter'
            ], 200);
        }
    }
}
