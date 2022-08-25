<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\UserUpdateProfilRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\UpdateForgotPasswordRequest;
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
     * * 403 [update_password, authenticated, message]
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
            return response()->json([
                'update_password' => true,
                'authenticated' => false
            ], 200);
        } else {
            return response()->json([
                'update_password' => false,
                'authenticated' => true,
                'message' => 'Un probleme est survenu veuillez vous reconnecter'
            ], 403);
        }
    }

    /**
     * forgot password for user cibling with email and send email
     * * 200 [message, send_email]
     * * 403 [message, send_email]
     * * 422 [message, errors => nameofinput]
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        // validate and get user cibling with email
        $validate = $request->validated();
        $user = User::where('email', $validate['email'])->first();

        // send email with token
        if ($user) {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            // return response json
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'message' => 'Demande de réinitialisation du mot de passe envoyé',
                    'send_email' => true,
                ], 200);
            } else {
                return response()->json([
                    'message' => "Impossible d'envoyer la demande, une erreur est survenu",
                    'send_email' => false,
                ], 403);
            }
        } else {
            return response()->json([
                'message' => "Impossible d'envoyer la demande",
                'send_email' => false,
            ], 403);
        }
    }

    /**
     * redirect to page front for renitialise password
     *
     * @param Request $request
     * @param [type] $token
     * @return void
     */
    public function redirectForgotPassword(Request $request, $token)
    {
        return request()->wantsJson()
            ? new JsonResponse('', 204)
            : redirect(url(env('APP_FRONT_URL_UPDATE_FORGOT_PASSWORD') . '?token=' . $token . '?email=' . $request->email));
    }

    /**
     * update password after forgot password
     * * 200 [update_password, message, authenticated]
     * * 422 [message, errors => nameofinput]
     * * 403 [update_password, authenticated, message]
     *
     * @return JsonResponse
     */
    public function updateForgotPassword(UpdateForgotPasswordRequest $request): JsonResponse
    {
        $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'update_password' => true,
                'message' => 'Mot de passe réinitialisé',
                'authenticated' => false
            ], 200);
        } else {
            return response()->json([
                'update_password' => false,
                'message' => 'Une erreur est survenu',
                'authenticated' => false
            ], 403);
        }
    }
}
