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
        $companies = Company::all();
        // var_dump($companies);
        return view('entry',[
            'companies' => $companies
        ]);
    }

    // 商品登録
    public function entry(Request $request){

        $request->validate([
            'img_path' => 'required',
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'required',
        ]);

         // ディレクトリ名
         $dir = 'img_path';

         // アップロードされたファイル名を取得
         $file_name = $request->file('img_path')->getClientOriginalName();

         // 取得したファイル名で保存
         $request->file('img_path')->storeAs('public/' . $dir, $file_name);


        $product = new Product();
        $product->img_path = 'storage/' . $dir . '/' . $file_name;
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        // データベースに保存
        $product->save();

        return redirect('entry');
    }

    // 詳細ページへ
    public function deta(int $id){
        $product = Product::find($id);
        return view('deta',[
            'product' => $product
        ]);
    }
    // 商品編集ページへ
    public function update_view(int $id){
        $product = Product::find($id);
        $companies = Company::all();
        return view('update',[
            'product' => $product,
            'companies' => $companies
        ]);
    }

    // 商品更新
    public function update_edit(int $id,Request $request){

        $request->validate([
            'img_path' => 'required',
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'required',
        ]);

        $product = Product::where('id',$id)->first();
         // ディレクトリ名
         $dir = 'img_path';

         // アップロードされたファイル名を取得
         $file_name = $request->file('img_path')->getClientOriginalName();

         // 取得したファイル名で保存
         $request->file('img_path')->storeAs('public/' . $dir, $file_name);

        $product->img_path = 'storage/' . $dir . '/' . $file_name;
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        // データベースに保存
        $product->save();

        return redirect()->route('deta', ['id' => $product->id]);
    }

    // 商品削除
    public function delete(int $id){
        $product = Product::find($id);

        // 画像ファイルのパスを取得
        $imagePath = $product->img_path;

        // データベースから商品を削除
        $product->delete();

        // 画像ファイルを削除
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

    $product->delete();
    return redirect('top');
    }

    // 商品検索
    public function search(Request $request) {
        $companies = Company::all();

        $textbox = $request->input('textbox');
        $company_id = $request->input('company_id');

        $query = Product::query();

        if (!empty($textbox)) {
            // フリーテキストで検索
            $query->where('product_name', 'LIKE', '%' . $textbox . '%');
        }

        if (!empty($company_id)) {
            // メーカーで検索
            $query->where('company_id', $company_id);
        }

        $products = $query->paginate(3); // ページネーションを適用

        return view('top', [
            'products' => $products,
            'companies' => $companies
        ]);
    }
}
