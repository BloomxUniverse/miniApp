<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request){
        $header             = $request->headers->all();
        $requestShopify     = Request::create($header['referer'][0]);
        $queryParameters    = $request->query();
        return view('welcome',['name'=>$request->shop]);
    }
    
    private function getShopName(Request $request):string{
        $header             = $request->headers->all();
        $requestShopify     = Request::create($header['referer'][0]);
        return $requestShopify['shop'];
    }
    
    public function getPageList(Request $request){
        $shop = $this->getShopName($request);
        $data = User::where('name',$shop)->first();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $data->password
        ])->get('https://'.$shop.'/admin/api/2024-01/pages.json');
        
        return response()->json($response->body(),200 , [], JSON_PRETTY_PRINT);
    }
    
    public function createPage(Request $request){
        $shop = $this->getShopName($request);
        $data = User::where('name',$shop)->first();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $data->password
        ])->post('https://'.$shop.'/admin/api/2024-01/pages.json',[
                "page"=>[
                    "title"=>$request->title,
                    "body_html"=>$request->body
                    ]
            ]);
        
        return response()->json($response->body(),200 , [], JSON_PRETTY_PRINT);
    }
}
