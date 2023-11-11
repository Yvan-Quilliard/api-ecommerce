<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/',
            'password_confirmation' => 'required|same:password'
        ], [
            'first_name.required' => 'Le nom est requis.',
            'last_name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'email.unique' => 'L\'adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit comporter au moins :min caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.',
            'password_confirmation.required' => 'La confirmation du mot de passe est requise.',
            'password_confirmation.same' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        if ($validator->fails()) {
            return $this->respondJson(false, $validator->errors()->all(), 400);
        }

        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $token = $user->createToken('JWT Authentication Token')->accessToken;

            return $this->respondJson(true, 'Inscription réussie !', 200, ['token' => $token, 'user' => $user]);
        } catch (Exception $e) {
            return $this->respondJson(false, 'Erreur lors de l\'inscription', 500, ['exception' => $e]);
        }
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken('JWT Authentication Token')->accessToken;

            $rememberToken = Str::random(10);
            $user->setRememberToken($rememberToken);

            $user->save();

            return $this->respondJson(true, 'Authentification réussie !', 200, ['token' => $token, 'user' => $user]);
        } else {
            return $this->respondJson(false, 'Authentification échouée',401);
        }
    }
}
