<?php

namespace App\Http\Controllers\Api;

use App\Models\CoffeeShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoffeeshopController extends Controller
{
    public function index()
    {
        //get data coffeeshop
        $coffeeshop = CoffeeShop::when(request()->q, function($coffeeshop) {
            $coffeeshop = $coffeeshop->where('name', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data CoffeeShop',
            'data'    => $coffeeshop,
        ], 200);
    }

    public function showByCity($cites_id)
    {
        //get detail data category with campaign
        $coffeeshop = CoffeeShop::with('cities')->where('cities_id', $cites_id)->get();
        
        if($coffeeshop->isEmpty()) {
            // Jika $menu kosong, kembalikan respons 404
            return response()->json([
                'success' => false,
                'message' => 'Data Coffee Shop Tidak Ditemukan!',
            ], 404);
        }else{
            $coffeeshop = $coffeeshop->map(function($shop) {
                $shop['city_name'] = $shop->cities->city_name;
                unset($shop['cities']);
                return $shop;
            });

            //return with response JSON
            return response()->json([
                'success' => true,
                'message' => 'List Data CoffeeShop Berdasarkan city' ,
                'data'    => $coffeeshop,
            ], 200);
        }
    }

    public function showBySlug($slug)
    {
        //get detail data category with campaign
        $coffeeshop = CoffeeShop::where('slug', $slug)->get();
        
        if($coffeeshop->isEmpty()) {
            // Jika $menu kosong, kembalikan respons 404
            return response()->json([
                'success' => false,
                'message' => 'Data Coffee Shop berdasarkan slug Tidak Ditemukan!',
            ], 404);
        }else{
          
            //return with response JSON
            return response()->json([
                'success' => true,
                'message' => 'List Data CoffeeShop Berdasarkan slug' ,
                'data'    => $coffeeshop,
            ], 200);
        }
    }
}
