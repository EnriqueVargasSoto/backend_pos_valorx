<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request){
        //url
        $urlLogin = 'http://www.valorx.net/XMap.Services/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23XMapLogin&Compania='.$request->compania.'&Sucursal='.$request->sucursal;

        //llamada al login
        $response = Http::post($urlLogin, $data = [
            "tipologueo" => $request->tipologueo,
            "usuario" => $request->usuario,
            "password" => $request->password
        ]);
        $response = str_replace("\n", "", $response);
        $response = str_replace("\r", "", $response);
        $data = iconv('ISO-8859-1', 'UTF-8', $response);
        //dd($response->json());
        $user = json_decode($data, true);
        //dd($user);
        return response()->json($user);
    }
}
