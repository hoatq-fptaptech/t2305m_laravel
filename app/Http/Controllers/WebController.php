<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home(){
        // lấy ra danh sách sản phẩm
//        $products = Product::all();
//        $products = Product::orderBy("id","desc")->limit(15)->get(); // collection
        $products = Product::orderBy("id","desc")->paginate(15);
        return view("welcome",compact('products')); // render
    }

    public function aboutUs(){
        return view("page.about-us");
    }
}
