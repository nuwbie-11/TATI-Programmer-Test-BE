<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    function greets(){
        return response()->json(['message' => "Hello World"]);
    }

    function helloworld(Request $request){
        try {
            $res = [];      
            if ($request->filled("number")) {
                $number = $request["number"];
            };
            for ($i=1; $i <= $number ; $i++) { 
                if (($i%4===0) && ($i%5===0) ) {
                    $res[]="helloworld";
                } elseif ($i%4===0) {
                    $res[]="hello";
                } elseif ($i%5===0) {
                    $res[]="world";
                } else {
                    $res[]=$i;
                }
            }
            return response()->json(['message'=>$res]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
        }
    }
}
