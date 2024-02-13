<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ProvinsiController extends Controller
{


    public function create(Request $request)
    {
        try {
            if ($request->has("is_active")) {
                return response()->json(['message' => 'failed', 'data' => []]);
            }

            $data = $request->input();
            $data["is_active"] = 'yes';
            $res = Provinsi::create($data);
            return response()->json(['message' => 'success', 'data' => $res]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th, 'data' => []]);
        }
    }

    public function list(Request $request)
    {
        try {

            $data = DB::table('provinsis as model');
            $data = $data->select('*');
            // $queries = [
            //     ['is_active', 'yes'],
            //   ];

            //   search
            if (!empty($request->q)) {
                $data = $data->where(function ($query) use ($request) {
                    $query->orWhere('model.nama_provinsi', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('model.nama_gubernur', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('model.deskripsi', 'LIKE', '%' . $request->q . '%');
                });
            }

            $data = $data->where('model.is_active', 'yes')->get();
            return response()->json(['message' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th, 'data' => []]);
        }
    }


    public function read(Request $request, $id)
    {
        try {

            $data = DB::table('provinsis as model');
            $data = $data->select('*');


            $data = $data->where('model.id', $id)->first();
            return response()->json(['message' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th, 'data' => []]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
        

            $data = $request->input(); 
            
            $res = Provinsi::where([['id', $id]])->update($data);
            return response()->json(['message' => 'success', 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e, 'data' => []]);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $data["is_active"] = 'no';
            
            $res = Provinsi::where([['id', $id]])->update($data);
            return response()->json(['message' => 'success', 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e, 'data' => []]);
        }
    }
}
