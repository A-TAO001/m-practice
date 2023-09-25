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

    // ソート機能
    public function sort(Request $request)
    {
        $sortableColumns = ['id', 'price', 'stock']; // ソート可能なカラムのリスト
        $companies = Company::all();

        // リクエストからソートカラムとソート順を取得（デフォルトは'id'と'asc'）
        $sortColumn = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');

        // ソートカラムが有効なものか確認
        if (!in_array($sortColumn, $sortableColumns)) {
            $sortColumn = 'id'; // デフォルトのソートカラム
        }

        // ソート順が正しい値であるか確認し、デフォルトは'asc'とする
        if ($sortDirection !== 'asc' && $sortDirection !== 'desc') {
            $sortDirection = 'asc';
        }

        // 商品データの取得とソート
        $products = Product::orderBy($sortColumn, $sortDirection)->paginate(10); // 10件ずつページネーション

        // ビューにデータを渡して表示
        return view('top', [
            'products' => $products,
            'sortableColumns' => $sortableColumns,
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
            'companies' => $companies,
        ]);
    }


 // 商品検索
    public function search(Request $request)
    {
        $companies = Company::all();

        $textbox = $request->input('textbox');
        $company_id = $request->input('company_id');
        $perPage = 3;

        $products = Product::searchProducts($textbox, $company_id, $perPage);

        return view('top',[
            'products' => $products,
            'companies' => $companies,
            'perPage' => $perPage,
        ]);
    }

    // 値段・在庫検索
    public function pssearch(Request $request)
    {

        $companies = Company::all();

        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_stock = $request->input('min_stock');
        $max_stock = $request->input('max_stock');
        $perPage = 3;

        $products = Product::psSearchProducts($min_price, $max_price,$min_stock, $max_stock, $perPage);

        return view('top',[
            'products' => $products,
            'companies' => $companies,
            'perPage' => $perPage,
        ]);
    }

    // 削除機能
    // public function delete(Request $request, $id) {

    //     try {
    //         DB::beginTransaction();

    //         Product::deleteProduct($id);

    //         DB::commit();

    //         return response()->json(['message' => '商品が削除されました']);

    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json(['message' => '商品の削除中にエラーが発生しました'], 500);
    //     }
    // }

    // 削除機能
    public function delete($id) {

        Product::destroy($id);

         return redirect()->route('top')->with('message', config('delete'));

    }

    // 削除処理
//     public function delete($id)
// {
//     $product = Product::find($id);

//     if ($product) {
//         $product->delete();
//         return response()->json(['success' => true]);
//     } else {
//         return response()->json(['success' => false]);
//     }
// }

}
