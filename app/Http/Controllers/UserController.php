<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request)
    {
        try {
            if ($request->has("level")) {
                return response()->json(['message' => 'failed', 'data' => []]);
            }

            $data = $request->input();
            // $data['password'] = bcrypt($data['password']);


            $res = User::create($data);
            return response()->json(['message' => 'success', 'data' => $res]);
        } catch (\Exception $err) {
            return response()->json(['message' => $err, 'data' => []]);
        }
    }

    public function auth(Request $request)
    {
        try {
            //code...
            if ($request->filled('email')) {
                $user = User::where('email', $request['email'])->first();
            }
            if (!$user || !Hash::check($request['password'], $user['password'])) {
                return response()->json(['message' => 'Unauthorized', 'data' => []]);
            }
            $user = $user->select('id','name', 'email', 'level')->where('email', $request['email'])->first();
            return response()->json(['message' => 'success', 'data' => $user]);
        } catch (\Exception $err) {
            return response()->json(['message' => $err, 'data' => []]);
        }
    }

    public function read($id)
    {
        try {

            $data = DB::table('users as model');
            $data = $data->select('model.id', 'model.name', 'model.email')
                ->where('model.id', $id)
                ->first();


            return response()->json(['message' => 'success', 'data' => $data]);
        } catch (\Exception $err) {
            return response()->json(['message' => $err, 'data' => []]);
        }
    }
}
