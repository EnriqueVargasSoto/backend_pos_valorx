<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function listProductsPagination(Request $request){

        $urlValorx = 'http://valorx.net/Magicxpi4.12/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23ListItems&Compania='.$request->compania.'&Sucursal='.$request->sucursal;

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
        $urlValorx = 'http://www.valorx.net/Magicxpi4.12/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23Shopper&Compania='.$request->compania.'&Sucursal='.$request->sucursal;

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

    public function saveSale(Request $request){
        $urlValorx = 'http://www.valorx.net/Magicxpi4.12/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23Sales&Compania='.$request->compania.'&Sucursal='.$request->sucursal;

        $response = Http::post($urlValorx, $data = [
            "plataforma_origen" => $request->plataforma_origen,//' : '1',
            "usuario" => $request->usuario,//' : 'VENDEDOR1',
            "cod_comprobante" => $request->cod_comprobante,//' : this.client.tipodocid == 'DNI' ? 'BOL' : 'FXV',
            "serie_comprobante" => $request->serie_comprobante,//' : 'B801',
            "fecha_comprobante" => $request->fecha_comprobante,//' : '2023-11-21',
            "vendedor" => $request->vendedor,//' : '10247812',
            "lista_precio" => $request->lista_precio,//' : environment.lista_precio,
            "nro_document_ide" => $request->nro_document_ide,//' : this.client.nrodocide,
            "client" => $request->client,//' : this.client.client,
            "forma_pago" => $request->forma_pago,//' : "001",
            "moneda" => $request->moneda,//' : 'PEN',
            "detalle_sales" => $request->detalle_sales,//' : bodyDetail
        ]);

        //$data = iconv('ISO-8859-1', 'UTF-8', $response);
        /*$response = str_replace("\n", "", $response);
        $response = str_replace("\r", "", $response);
        $response = str_replace("   ", "", $response);
        $response = str_replace(" ", "", $response);*/
        $response = str_replace(':,"', ':"', $response);
        $response = str_replace('"cliente": ,', '"cliente": "",', $response);
        //$data = iconv('ISO-8859-1', 'UTF-8', $response);
        $sale = json_decode($response, true);

        return response()->json($sale);
    }

    public function categories(Request $request){
        $urlValorx = 'http://www.valorx.net/Magicxpi4.12/MgWebRequester.dll?appname=IFSValorX&prgname=HTTP&arguments=-AHTTPVLXRest%23ListCateg&Compania='.$request->compania.'&Sucursal='.$request->sucursal;

        $response = Http::post($urlValorx);

        $categories = json_decode($response, true);


        return response()->json($categories);
    }
}
