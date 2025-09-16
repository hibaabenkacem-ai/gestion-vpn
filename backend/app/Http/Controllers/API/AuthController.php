<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nom'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);

        $user = User::create([
            'nom'=>$data['nom'],
            'prenom'=>$request->prenom,
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'service'=>$request->service,
            'fonction'=>$request->fonction,
            'role'=>$request->role ?? 'employe'
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['user'=>$user,'token'=>$token],201);
    }

    public function login(Request $request)
    {
        $cred = $request->validate(['email'=>'required|email','password'=>'required']);
        $user = User::where('email', $cred['email'])->first();
        if(!$user || !Hash::check($cred['password'],$user->password)){
            return response()->json(['message'=>'invalid credentials'],401);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['user'=>$user,'token'=>$token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'logged out']);
    }
}
