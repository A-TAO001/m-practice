<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // 商品登録
    public static function createProduct($request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if ($request->hasFile('img_path')) {
            $dir = 'img_path';
            $file_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/' . $dir, $file_name);
            $product->img_path = 'storage/' . $dir . '/' . $file_name;
        }

        if ($request->has('comment')) {
            $product->comment = $request->comment;
        }

        $product->save();

        return $product;
    }

    // 詳細ページ
    public static function getProductId($id){

        return Product::find($id);
    }

    // 編集ページ
    public static function getProductUpdateId($id){
        $product = Product::find($id);
        $companies = Company::all();
        return [
                'Product' => $product,
        'companies' => $companies
        ];
    }
    // 商品更新
    public static function updateProduct($id, $request)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if ($request->hasFile('img_path')) {
            $dir = 'img_path';
            $file_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/' . $dir, $file_name);
            $product->img_path = 'storage/' . $dir . '/' . $file_name;
        }

        if ($request->has('comment')) {
            $product->comment = $request->comment;
        }

        $product->save();

        return $product;
    }

    // 商品削除
    public static function deleteProduct($id){

        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
    }
    // 商品検索
    public static function searchProducts($textbox, $company_id, $perPage = 3)
    {
        $query = self::query();

        if (!empty($textbox)) {
            // フリーテキストで検索
            $query->where('product_name', 'LIKE', '%' . $textbox . '%');
        }

        if (!empty($company_id)) {
            // メーカーで検索
            $query->where('company_id', $company_id);
        }

        return $query->paginate($perPage);
    }

}