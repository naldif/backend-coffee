<?php

namespace App\Http\Controllers\Account;

use App\Models\Cities;
use App\Models\CoffeeShop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CoffeeShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $city = Cities::get();
        // dd($data);
        if ($request->ajax()) {
            $data = CoffeeShop::with('cities')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('cities', function ($CoffeeShop) {
                    return $CoffeeShop->cities->city_name;
                })
                ->addColumn('image', function($item){
                    return '<img style="width: 100px" src="'. Storage::url($item->image) .'"/>';
                })
                ->addColumn('action', function($row){
                  
                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return ' 
                        <button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="edit"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button>
                    ';
                    // return $btn;
                
                })
              
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('pages.account.coffeeshop.index', compact('city'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:categories,name',
            'city_id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ],[
            'name.required' => 'Menu tidak boleh kosong.', 
            'name.unique' => 'Nama Menu sudah tersedia.', 
            'city_id.required' => 'City tidak boleh kosong',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.mime' => 'Format gambar harus png,jpg, jpeg',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);	
        }else{
            if ($request->hasFile('image')) {
            
                if(!empty($request->image_old)){
                    Storage::disk('public')->delete($request->image_old);
                }
                $fol =  Str::lower($request->name);
                $filePath = Storage::disk('public')->put(str_replace(' ', '', $fol), request()->file('image'));

            }
            $data = CoffeeShop::updateOrCreate([
                'id' => $request->id
            ], 
            [
                'name' => $request->name,
                'cities_id' => $request->city_id,
                'image' => $filePath,
                'description' => $request->description,
                'slug' => Str::slug($request->name, '-'),
                'user_id' => auth()->user()->id,
            ]);
            
        
            if(!$data){
                return response()->json(
                    [
                        'code'=>0,
                        'msg'=>'Something went wrong',
                        'data'=> $data
                    ]
                );
            }else{
                return response()->json(
                    [
                        'code'=>1,
                        'msg'=>'CoffeeShop has been successfully saved',
                        'data'=> $data
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coffeeshop = CoffeeShop::with('cities')->findOrFail($id);
        // dd($cs);
        return response()->json($coffeeshop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoffeeShop $coffeeshop)
    {

        Storage::disk('public')->delete($coffeeshop->image);
        $query = $coffeeshop->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Category has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }
}
