<?php

namespace App\Http\Controllers\Account;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($data);
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

        return view('pages.account.menu.index');
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
        //
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
