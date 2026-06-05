<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTRO
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),

            'email' => $request->input('email'),

            'password' => Hash::make(
                $request->input('password')
            ),

            'role' => 'cliente',
        ]);

        return response()->json([
            'message' => 'Usuario registrado'
        ]);
    }

    // LOGIN
    public function login(Request $request)
    {
        $user = User::where(
            'email',
            $request->input('email')
        )->first();

        if (
            !$user ||
            !Hash::check(
                $request->input('password'),
                $user->password
            )
        ) {

            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        $token = $user
            ->createToken('api-token')
            ->plainTextToken;

        return response()->json([

            'token' => $token,

            'user' => [

                'id' => $user->id,

                'name' => $user->name,

                'email' => $user->email,

                'role' => $user->role,
            ]
        ]);
    }

    // USER
    public function user(Request $request)
    {
        return response()->json(
            $request->user()
        );
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Logout correcto'
        ]);
    }

    // LOGIN GOOGLE
public function googleLogin(Request $request)
{
    $user = User::where(
        'email',
        $request->email
    )->first();

    if (!$user) {

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => null,

            'role' => 'cliente',
        ]);
    }

    $token = $user
        ->createToken('api-token')
        ->plainTextToken;

    return response()->json([

        'token' => $token,

        'user' => [

            'id' => $user->id,

            'name' => $user->name,

            'email' => $user->email,

            'role' => $user->role,
        ]
    ]);
}
}