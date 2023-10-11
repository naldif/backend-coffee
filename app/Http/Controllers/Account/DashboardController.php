<?php

namespace App\Http\Controllers\Account;

use App\Models\CoffeeShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $coffeshop = CoffeeShop::count();

        return view('pages.account.dashboard.index',compact('coffeshop'));
    }
}
