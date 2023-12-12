<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function orderSave(Request $request){
        //url
        $urlValorx = 'http://www.valorx.net/XMap.Services/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23Orders&Compania='.$request->compania.'&Sucursal='.$request->sucursal;

        $response = Http::post($urlValorx, $data = $request->order);
        $response = preg_replace('/^\xEF\xBB\xBF/', '', $response);
        //$response = str_replace("\r", "", $response);
        //$data = iconv('ISO-8859-1', 'UTF-8', $response);
        $order = json_decode($response, true);
        //dd($order);
        //$order = json_decode($response->body(), true);

        return response()->json($order);
    }
}
