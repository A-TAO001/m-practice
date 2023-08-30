<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    // 商品削除
    public function delete(int $id){

        // // 画像ファイルのパスを取得
        // $imagePath = $product->img_path;

        // // データベースから商品を削除
        // $product->delete();

        // // 画像ファイルを削除
        // if (Storage::exists($imagePath)) {
        //     Storage::delete($imagePath);
        // }
        try{
            DB::beginTransaction();

            Product::deleteProduct($id);

            DB::commit();

            return redirect('top');

            }catch (\Exception $e){

            DB::rollback();
            }
    }

    // 商品検索
    public function search(Request $request)
{
    $companies = Company::all();

    $textbox = $request->input('textbox');
    $company_id = $request->input('company_id');
    $perPage = 3;

    $products = Product::searchProducts($textbox, $company_id, $perPage);

    return view('top', [
        'products' => $products,
        'companies' => $companies
    ]);
}
}
