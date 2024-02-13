<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KinerjaPredikatController extends Controller
{
    function predikat(Request $request){
        try {
            if ($request->filled('perilaku') && $request->filled('hasilKerja')) {
                $perilaku = (int)$request['perilaku']+1;
                $hasilKerja = (int)$request['hasilKerja']+1;

                $count = $perilaku * $hasilKerja;
                if ($count === 9) {
                    $res = 'Sangat Baik';
                }elseif ($count === 1) {
                    $res = 'Sangat Kurang';
                }elseif ($count === 4 || $count === 6) {
                    $res = 'Baik';
                }elseif ($perilaku === 1) {
                    $res = 'Kurang / miscondunct';
                }else{
                    $res = 'Butuh Perbaikan';
                }
            }

            return response()->json(['message'=>$res]);

            
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
        }
    }
}
