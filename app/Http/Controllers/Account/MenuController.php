<?php

namespace App\Http\Controllers\Account;

use App\Models\Menu;
use App\Models\Category;
use App\Traits\HasImage;
use App\Models\CoffeeShop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index(CoffeeShop $coffeeshop)
    {
        // dd($data);
        $category = Category::get();
        if (request()->ajax()) {
            $data = Menu::with('category')->where('coffeeshop_id', $coffeeshop->id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($menu) {
                    return $menu->category->name;
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
                ->editColumn('price', function($item){
                    return 'Rp. '.number_format($item->price, 2, '.', ',');
                })
              
                ->rawColumns(['action','image'])
                ->make(true);
        }

        return view('pages.account.menu.index', compact('category','coffeeshop'));
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

        $rules = [
            'name'     => 'required|unique:categories,name',
            'price' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];
        
        $messages = [
            'name.required' => 'Menu tidak boleh kosong.', 
            'name.unique' => 'Nama Menu sudah tersedia.', 
            'price.required' => 'Price tidak boleh kosong',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.mime' => 'Format gambar harus png,jpg, jpeg',
        ];

        // Jika Anda sedang memperbarui data, abaikan validasi unik
        if ($request->has('id')) {
            $rules = [
                'name' => 'required',
                'price' => 'required',
            ];
            unset($rules['image']); // Validasi gambar dihapus saat memperbarui
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);	
        }else{
            if ($request->hasFile('image')) {
            
                if(!empty($request->image_old)){
                    Storage::disk('public')->delete($request->image_old);
                }
         
                $folcs =  Str::lower($request->coffeeshop_name);
                $filePath = Storage::disk('public')->put(str_replace(' ', '', $folcs), request()->file('image'));
                
            }else {
                $filePath = $request->image_old;
            }
            $data = Menu::updateOrCreate([
                'id' => $request->id
            ], 
            [
                'name' => $request->name,
                'coffeeshop_id' => $request->coffeeshop_id,
                'category_id' => $request->category_id,
                'image' => $filePath,
                'price' => $request->price,
                'slug' => Str::slug($request->name, '-'),
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
                        'msg'=>'Menus has been successfully saved',
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
    public function edit($coffeeshop_id, $id)
    {
        $menu = Menu::find($id);
        return response()->json($menu);
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
    public function destroy($coffeeshop_id, $id)
    {
        $menu = Menu::findOrFail($id);
        Storage::disk('public')->delete($menu->image);
        $query = $menu->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Category has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }
}
