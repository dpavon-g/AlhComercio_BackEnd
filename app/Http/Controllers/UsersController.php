<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  // Para encriptar la contraseña
use Illuminate\Support\Facades\Validator;  // Para validar los datos
use \Firebase\JWT\JWT;


class UsersController extends Controller
{
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function createJWT($user)
    {
        $secretKey = env('JWT_SECRET_KEY');

        // Datos que quieres incluir en el payload del JWT
        $payload = array(
            "iat" => time(), // Fecha de emisión del token
            "exp" => time() + 3600, // Fecha de expiración (1 hora)
            "user_id" => $user["id"], // El ID del usuario
            "username" => $user["email"] // Nombre de usuario (puedes incluir más información)
        );

        // Definir el algoritmo de firma (HS256 es el estándar)
        $algorithm = 'HS256';

        // Generar el token JWT
        $jwt = JWT::encode($payload, $secretKey, $algorithm);

        return (string)$jwt;

    }

    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function checkLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $user = $this->getUserByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $jwt = $this->createJWT($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'jwt' => $jwt,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
