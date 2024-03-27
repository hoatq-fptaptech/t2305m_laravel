<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home(){
        // lấy ra danh sách sản phẩm
//        $products = Product::all();
//        $products = Product::orderBy("id","desc")->limit(15)->get(); // collection
        $products = Product::orderBy("id","desc")->paginate(15);
        $categories = Category::all();
        return view("welcome",compact('products','categories')); // render
    }

    public function aboutUs(){
        return view("page.about-us");
    }

    public function detailProduct(Product $product){
//        $data = Product::find($product);
//        $data = Product::findOrFail($product);

        return view("page.detail",compact('product'));
    }
}
