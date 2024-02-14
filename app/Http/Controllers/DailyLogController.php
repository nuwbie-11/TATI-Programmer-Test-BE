<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyLogController extends Controller
{

    public function create(Request $request)
    {
        try {
            $user = User::select('name')->where('id', $request['user_id'])->get();

            if ($request->has("is_active")) {
                return response()->json(['message' => 'failed', 'data' => []]);
            }

            $data = $request->input();
            $data['name'] = $user[0]['name'];
            $data["is_active"] = 'yes';
            $data["is_pending"] = 'yes';
            $data["is_rejected"] = 'no';
            $data["is_approved"] = 'no';
            $data["log_at"] = Carbon::now();
            $res = DailyLog::create($data);
            return response()->json(['message' => 'success', 'data' => $data]);
        } catch (\Exception $th) {
            return response()->json(['message' => $th, 'data' => []]);
        }
    }

    public function approve(Request $request, $id)
    {
        try {
            //code...
            // $row = DailyLog::where('id',$id)->get();
            $data = $request->input();
            $data['is_pending'] = 'no';
            $res = DailyLog::where([['id', $id]])->update($data);
            return response()->json(['message' => 'success', 'data' => $res]);
        } catch (\Exception $th) {
            return response()->json(['message' => $th, 'data' => []]);
        }
    }

    public function list(Request $request)
    {
        try {
            //code...
            $data = DB::table('daily_logs as model');
            $data = $data->select('*');

            if (!empty($request->user_id)) {
                $data = $data->where('model.user_id', $request->user_id);
            }

            if ($request->filled('is_pending')) {
                $data = $data->where('is_pending', $request['is_pending']);
            }
            if ($request->filled('is_rejected')) {
                $data = $data->where('is_rejected', $request['is_rejected']);
            }
            if ($request->filled('is_approved')) {
                $data = $data->where('is_approved', $request['is_approved']);
            }

            $data = $data->where('model.is_active', 'yes')->get();
            return response()->json(['message' => 'success', 'data' => $data]);
        } catch (\Exception $th) {
            return response()->json(['message' => $th, 'data' => []]);
        }
    }
}
