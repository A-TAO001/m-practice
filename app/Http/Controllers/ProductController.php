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

class ProductController extends Controller
{
    // entryページへ
    public function index(){

        // conmpany情報取得
        $companies = Company::getAllCompanies();
        // var_dump($companies);
        return view('entry',[
            'companies' => $companies
        ]);
    }

    // 商品登録
    public function entry(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Productモデルから商品登録を実行

            Product::createProduct($request);

            DB::commit();

            return redirect('entry');

            } catch (\Exception $e) {

            DB::rollback();
            }
    }
    // 詳細ページへ
    public function deta(int $id)
    {
        // Productモデルから商品情報を取得
        $product = Product::getProductId($id);

        return view('deta', [
            'product' => $product
        ]);
    }


    // 商品編集ページへ
    public function update_view(int $id)
    {
        $data = Product::getProductUpdateId($id);
        // dd($data);
        return view('update', ['data' => $data]);
    }

    // 商品更新
    public function update_edit(int $id, Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Productモデルから商品更新を実行
            $product = Product::updateProduct($id, $request);

            DB::commit();

            return redirect()->route('deta', ['id' => $product->id]);

            } catch (\Exception $e) {

            DB::rollback();
            }
    }

    //購入ページ
    public function buy(){

        return view('buy');

    }

//     // 購入処理(練習用)
//     public function purchase(Request $request)
// {
//     // フォームから送信された商品IDを取得
//     $productID = $request->input('product_id');

//     // $productIDを使用して購入処理を行う
//     $product = Product::find($productID);

//     if (!$product) {
//         Log::error('商品が見つかりません');
//         return response()->json(['message' => '商品が見つかりません'], 404);
//     }

//     // 商品の在庫を減らす
//     if ($product->stock > 0) {
//         $product->stock -= 1;
//         $product->save();

//          // 購入履歴をsalesテーブルに挿入
//          $sale = new Sale();
//          $sale->product_id = $productID;
//          $sale->save();



//         // 商品を購入した旨をコンソールに表示
//         dd('商品を購入しました');
//     } else {
//         // 在庫切れの場合もコンソールに表示
//         dd('在庫切れです');
//     }
//     return view('buy');
// }

 // 商品検索
    public function search(Request $request)
    {
        $companies = Company::all();

        $textbox = $request->input('textbox');
        $company_id = $request->input('company_id');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_stock = $request->input('min_stock');
        $max_stock = $request->input('max_stock');
        $perPage = 10;

        $products = Product::searchProducts($textbox, $company_id,$min_price, $max_price,$min_stock, $max_stock,  $perPage);

        return view('top',[
            'products' => $products,
            'companies' => $companies,
            'perPage' => $perPage,
        ]);
    }

    // // 値段・在庫検索
    // public function pssearch(Request $request)
    // {

    //     $companies = Company::all();

    //     $min_price = $request->input('min_price');
    //     $max_price = $request->input('max_price');
    //     $min_stock = $request->input('min_stock');
    //     $max_stock = $request->input('max_stock');
    //     $perPage = 10;

    //     $products = Product::psSearchProducts($min_price, $max_price,$min_stock, $max_stock, $perPage);

    //     return view('top',[
    //         'products' => $products,
    //         'companies' => $companies,
    //         'perPage' => $perPage,
    //     ]);
    // }


    // 削除機能
    public function delete($id) {

        Product::destroy($id);

         return redirect()->route('top')->with('message', config('delete'));

    }


}