<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Company;

class TopController extends Controller
{
    public function index() {
        $companies = Company::all();
        // $products = Product::sortable()->orderBy('id', 'asc')->paginate(3);
        // $products = Product::paginate(3);
        $products = Product::all();


        // ビューに変数を渡して表示
        return view('top', [
            'products' => $products,
            'companies' => $companies
        ]);
    }
}

