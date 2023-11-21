<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function listProductsPagination(Request $request){

        $urlValorx = 'http://valorx.net/Magicxpi4.12/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23ListItems&Compania=0054&Sucursal=02';

        $response = Http::post($urlValorx, $data = [
            "lista_precio" => $request->lista_precio,
            "pagina" => $request->pagina,
            "filtroxnombre" => $request->filtroxnombre
        ]);
        //$response = str_replace('b"""', "", $response);
        $response = str_replace("\n", "", $response);
        $response = str_replace("\r", "", $response);
        //$response = str_replace(",,", ",", $response);
        //if ($response->successful()) {
            //$body = $response->body();
            $data = iconv('ISO-8859-1', 'UTF-8', $response);//utf8_decode($response);
            $products = json_decode($data, true);
            //dd($products);

        return response()->json(['data' => $products]);
            //$products = $products['items'];
    }

    public function searchClient(Request $request){
        $urlValorx = "http://www.valorx.net/Magicxpi4.12/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23Shopper&Compania=0078&Sucursal=01";

        $response = Http::post($urlValorx, $data = [
            "nrodocid" => $request->nrodocid,
            //"phone" => $request->phone,
            //"email" => $request->email
        ]);

        //$response = str_replace("\n", "", $response);


        $data = iconv('ISO-8859-1', 'UTF-8', $response);
        $data = str_replace("ï»¿", "", $data);
        $client = json_decode($data, true);

        return response()->json(['data' => $client]);
    }
}
