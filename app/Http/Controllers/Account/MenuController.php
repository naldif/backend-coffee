<?php

namespace App\Http\Controllers\Account;

use App\Models\Menu;
use App\Models\Category;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($data);
        $category = Category::get();
        if ($request->ajax()) {
            $data = Menu::with('category')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($menu) {
                    return $menu->category->name;
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
              
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.account.menu.index', compact('category'));
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
            // 'name'     => 'required|unique:categories,name',
            // 'category_id' => 'required',
            // 'price' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ],[
            // 'name.required' => 'Menu tidak boleh kosong.', 
            // 'name.unique' => 'Nama Menu sudah tersedia.', 
            // 'category_id.required' => 'Category tidak boleh kosong',
            // 'price.required' => 'Price tidak boleh kosong',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.mime' => 'Format gambar harus png,jpg, jpeg',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);	
        }else{
            if ($files = $request->file('image')) {
            
                //delete old file
              
                // Storage::delete($this->path . $request->image_txt);
                //insert new file
                $destinationPath = 'storage/'. $request->name; // upload path
                $menuImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $menuImage);

                // $image = $request->file('image');
                // $image->storeAs($this->path, $request->name,$image->hashName());
                
            }
            $data = Menu::updateOrCreate([
                'id' => $request->id
            ], 
            [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'image' => $menuImage,
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
