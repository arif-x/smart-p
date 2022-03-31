<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Session;

class AuthController extends Controller
{
    public function register(Request $request){
        $check = User::where('email', $request->email)->first();

        if(!empty($check)){
            return response()->json([
                'status' => false,
                'message'=>'Gagal Daftar, Email Sudah Digunakan'
            ], 200);
        } else {

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $id_user = User::where('email', $request->email)->value('id_user');
            $status = User::where('email', $request->email)->value('status');
            $role = User::where('email', $request->email)->value('role');

            $data = [
                'id_user' => $id_user,
                'email' => $request->email,
                'password' => $request->password,
                'status' => $status,
                'role' => $role
            ];

            return response()->json([
                'status' => true,
                'message'=>'Berhasil Daftar',
                'data' => [$data]
            ], 200);
        }
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status' => false,
                'message' => 'Gagal Login'
            ], 200);
        } else {
            $id_user = User::where('email', $request->email)->value('id_user');
            $status = User::where('email', $request->email)->value('status');
            $role = User::where('email', $request->email)->value('role');

            $data = [
                'id_user' => $id_user,
                'email' => $request->email,
                'password' => $request->password,
                'status' => $status,
                'role' => $role
            ];

            return response()->json([
                'status' => true,
                'message'=>'berhasil login',
                'data' => [$data]
            ], 200);
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        $response = [
            'status'=> true,
            'message'=>'berhasil logout',
        ];
        return response($response,201);
    }

    public function guest(){
        return response()->json([
            'error' => 'login dulu ya'
        ], 401);
    }
}