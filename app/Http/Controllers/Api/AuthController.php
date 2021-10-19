<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Notifications\ResetPassword;
use App\PasswordReset;
use App\User;
use App\UserRole;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="API Auth Endpoints"
 * )
 */
class AuthController extends ApiController
{
    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
                'verifyEmail',
                'resendVerifyEmail',
                'passwordRecover',
                'passwordFindReset',
                'passwordReset',
                'refresh'
            ]
        ]);
    }

    /**
     * @OA\POST(
     *   path="/api/auth/register",
     *   summary="Register as new user",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="Returns created new user",
     *     @OA\JsonContent(
     *       type="object",
     *       required={"email", "first_name", "last_name", "password", "password_confirmation", "accept_terms_conditions"},
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         description="User email",
     *       ),
     *       @OA\Property(
     *         property="first_name",
     *         type="string",
     *         description="User first name",
     *       ),
     *       @OA\Property(
     *         property="last_name",
     *         type="string",
     *         description="User last name",
     *       ),
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         description="User password",
     *       ),
     *       @OA\Property(
     *         property="password_confirmation",
     *         type="string",
     *         description="User password confirmation",
     *       ),
     *       @OA\Property(
     *         property="accept_terms_conditions",
     *         type="boolean",
     *         description="User accept the terms and conditions",
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response="201",
     *     description="Successful book created",
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Validation error",
     *   ),
     * )
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
            // 'name' => 'required|between:2,100',
            'first_name' => 'required',
            'last_name' => 'required',
            'accept_terms_conditions' => 'required|boolean|accepted',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|string|min:6',
        ]);

        if ($validator->fails()) {
            return \response()->json([
                'message' => __('Validation error'),
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $user = User::create(array_merge(
                $validator->validated(),
                [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'password' => bcrypt($request->password)
                ]
            ));

            $userRole = UserRole::whereCode('user')->first();

            if ($userRole) {
                $user->assignRole($userRole->code);
            }

            $user->sendEmailVerificationNotification();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
        DB::commit();


        return response()->json([
            'message' => __('Successfully registered'),
            'user' => $user
        ], 201);
    }

    /**
     * @OA\POST(
     *   path="/api/auth/login",
     *   summary="Login as user",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="Returns JWT and ACL user",
     *     @OA\JsonContent(
     *       type="object",
     *       required={"email", "password"},
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         description="User email",
     *       ),
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         description="User password",
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response="201",
     *     description="Successful book created",
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Validation error",
     *   ),
     *   @OA\Response(
     *     response="401",
     *     description="Authentication failed",
     *   ),
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => __('Validation error'),
                'errors' => $validator->errors()
            ], 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json([
                'message' => __('Email or password not valid'),
                'errors' => [
                    'authentication' => __('Unauthorized')
                ]
            ], 401);
        }

        $data = $this->createNewToken($token);

        $acl = $this->getAccessControlData();

        $user = auth()->user();

        $returnData = [
            'type' => 'bearer',
            'token' => $data->original['access_token'],
            'refresh_token' => null,
            'user' => $user,
            'acl' => $acl
        ];

        return \response()->json([
            'message' => __('Logged in successfully'),
            'data' => $returnData,
        ]);
    }

    /**
     * @OA\GET(
     *   path="/api/auth/profile",
     *   tags={"Auth"},
     *   security={{"bearer":{}}},
     *   summary="Get authentidcated user info",
     *   description="Returns user authenticated data",
     *   @OA\Response(
     *     response=200,
     *     description="Authenticated user data."
     *   ),
     *   @OA\Response(
     *    response=401,
     *    description="Reponse error."
     *   )
     * )
     */
    public function profile()
    {
        if (!\auth()->user()) {
            return response()->json([
                'message' => __('Not authorized'),
            ], 401);
        }

        $user = User::with('profile')->find(auth()->user()->getAuthIdentifier());

        return response()->json([
            'message' => __('Profile obtained successfully'),
            'data' => [
                'user' => $user,
                'acl' => $this->getAccessControlData()
            ]
        ]);
    }

    /**
     * @OA\POST(
     *   path="/api/auth/logout",
     *   summary="Logout the user",
     *   tags={"Auth"},
     *   security={{"bearer":{}}},
     *   @OA\Response(
     *     response="200",
     *     description="Successful user loged out",
     *   ),
     *   @OA\Response(
     *     response="401",
     *     description="Authentication failed",
     *   ),
     * )
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return response()->json([
            'message' => __('Successfully logged out')
        ]);
    }

    /**
     * @OA\GET(
     *   path="/api/auth/refresh",
     *   tags={"Auth"},
     *   security={{"bearer":{}}},
     *   summary="Get a refreshed token",
     *   description="Returns a refreshed token",
     *   @OA\Response(
     *     response=200,
     *     description="Refreshed token."
     *   ),
     *   @OA\Response(
     *    response=401,
     *    description="Reponse error."
     *   )
     * )
     */
    public function refresh()
    {
        $data = null;

        try {
            $data = $this->createNewToken(auth()->refresh());
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }

        return \response()->json([
            'message' => __('Token refreshed successfully'),
            'data' => $data->original
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken(string $token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @OA\GET(
     *      path="/api/auth/email/verify/{userId}",
     *      tags={"Auth"},
     *      summary="Veryfy the user",
     *      description="Returns a message indicating that the user was verified",
     *      @OA\Parameter(
     *          name="userId",
     *          description="User ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful user verified"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function verifyEmail($userId, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'message' => __('Invalid or expired verification'),
            ], 401);
        }

        $user = User::findOrFail($userId);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        if (env('APP_ENV') == 'local') {
            return redirect(config('app.url_front') . '/auth/login/' . Str::random(8));
        } else {
            return redirect('auth/login' . Str::random(8));
        }

        return response()->json([
            'message' => __('Email verified successfully')
        ]);
    }

    /**
     * @OA\POST(
     *   path="/api/auth/email/resend",
     *   summary="Resend email verification",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="User email",
     *     @OA\JsonContent(
     *       type="object",
     *       required={"email"},
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         description="User email",
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Successful resend verification email",
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Validation error response",
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Error response",
     *   ),
     * )
     */
    public function resendVerifyEmail(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => __('Validation error'),
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->get('email'))->first();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => __('Email is already verified')
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => __('New verification email send')
        ]);

    }

    /**
     * Get access control data (roles and permissions)
     *
     * @return array
     */
    private function getAccessControlData(): array
    {
        $acl = [
            'roles' => [],
            'permissions' => []
        ];

        $user = User::with('roles.permissions')->find(auth()->user()->getAuthIdentifier());

        foreach ($user->roles as $role) {
            $acl['roles'][] = $role->code;
            foreach ($role->permissions as $permission) {
                foreach ($acl['permissions'] as $aclPermission) {
                    if ($aclPermission == $permission->code) {
                        continue 2;
                    }
                }

                $acl['permissions'][] = $permission->code;
            }
        }

        return $acl;
    }

    /**
     * @OA\POST(
     *   path="/api/auth/reset-password",
     *   summary="Send a email whit recover password instructions",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="User email",
     *     @OA\JsonContent(
     *       type="object",
     *       required={"email"},
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         description="User email",
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Successful send email",
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Validation error response",
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Error response",
     *   ),
     * )
     */
    public function passwordRecover(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->get('email'))->first();

        if (!$user) {
            return $this->responseError(__('No encontramos usuarios con ese correo.'), [], 422);
        }

        $passwordReset = PasswordReset::whereEmail($user->email)->first();

        if ($passwordReset) {
            $passwordReset->update([
                'token' => Str::random(16),
            ]);
        } else {
            $passwordReset = PasswordReset::create([
                'email' => $user->email,
                'token' => Str::random(16),
            ]);
        }

        if ($user && $passwordReset) {

            $token = $passwordReset->token;

            try {
                $user->notify(new ResetPassword($token));
            } catch (\Exception $exception) {
                return $this->responseError('No pudimos enviar el email, intenta mas tarde.');
            }
            return $this->responseSuccess('Enviamos un email para que restablezcas tu contraseña');
        }

        return $this->responseError('Error al enviar el email', null);
    }

    /**
     * @OA\GET(
     *      path="/api/auth/reset-password/{token}",
     *      tags={"Auth"},
     *      summary="Find the user reset password request",
     *      description="Returns a message indicating that the user reset password request was finded",
     *      @OA\Parameter(
     *          name="token",
     *          description="User password reset token",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *            type="string"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful user verified"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function passwordFindReset($token)
    {
        $passwordReset = null;
        try {
            $passwordReset = PasswordReset::where('token', $token)->first();
            if (null == $passwordReset) {
                return $this->responseError('No encontramos una solicitud de recuperación de contraseña valida');
            }
        } catch (\Exception $exception) {
            return $this->responseError('No encontramos una solicitud de recuperación de contraseña valida');
        }

        return $this->responseSuccess('Solicitud de recuperación de contraseña valida', $passwordReset->toArray());
    }

    /**
     * @OA\PUT(
     *   path="/api/auth/reset-password",
     *   summary="Update the user password",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="New user password and reset token",
     *     @OA\JsonContent(
     *       type="object",
     *       required={"password", "token"},
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         description="New user password",
     *       ),
     *       @OA\Property(
     *         property="token",
     *         type="string",
     *         description="User reset password request token",
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Successful password updated",
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Validation error response",
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Error response",
     *   ),
     * )
     */
    public function passwordReset(Request $request)
    {
        $passwordReset = PasswordReset::where('token', $request->get('token'))->first();

        if (!$passwordReset) {
            return $this->responseError('No encontramos una solicitud de recuperación de contraseña valida');
        }

        try {

            $user = User::where('email', $passwordReset->email)->first();

            $user->update(
                [
                    'password' => bcrypt($request->get('password'))
                ]
            );

            try {
                PasswordReset::where('token', $request->get('token'))->delete();
            } catch (\Exception $exception) {
                return $this->responseError($exception->getMessage());
            }


        } catch (\Exception $exception) {
            return $this->responseError('No pudimos restablecer tu contraseña.', $exception);
        }

        return $this->responseSuccess('Por favor ingresa con tu nueva contraseña!');

    }
}
