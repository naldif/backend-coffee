<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        //get data menu
        $menu = Menu::when(request()->q, function($menu) {
            $menu = $menu->where('name', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Menu',
            'data'    => $menu,
        ], 200);
    }

    public function show($id)
    {
        //get detail data category with campaign
        $menu = Menu::with('coffeeshop')->where('coffeeshop_id', $id)->get();
        
        if($menu) {

            $menu = $menu->map(function($men) {
                $men['coffeeshop_name'] = $men->coffeeshop->name;
                unset($men['coffeeshop']);
                return $men;
            });

            //return with response JSON
            return response()->json([
                'success' => true,
                'message' => 'List Data Menu Berdasarkan Coffee Shop' ,
                'data'    => $menu,
            ], 200);
        }

        //return with response JSON
        return response()->json([
            'success' => false,
            'message' => 'Data Coffee Shop Tidak Ditemukan!',
        ], 404);
    }
}
