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
        $user = json_decode($response, true);

        return response()->json($user);
    }
}
