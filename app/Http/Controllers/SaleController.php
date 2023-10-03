<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
        // 購入処理(postman)
        public function purchase($id)
        {
            return DB::transaction(function () use ($id) {
                // 指定したIDの商品を取得
                $product = Product::find($id);
    
                if (!$product) {
                    return response()->json(['message' => '商品が見つかりません'], 404);
                }
    
                // 商品の在庫を減らす
                if ($product->stock > 0) {
                    $product->stock -= 1;
                    $product->save();
    
                    // 購入履歴をsalesテーブルに挿入
                    $sale = new Sale();
                    $sale->product_id = $id; // $productID ではなく $id を使用
                    $sale->save();
    
                    return response()->json(['message' => '商品を購入しました'], 200);
                } else {
                    return response()->json(['message' => '在庫切れです'], 400);
                }
            });
        }
    
}
