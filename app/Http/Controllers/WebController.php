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
        // $data = Product::where("slug",$product)->firstOrFail();
//        $data = Product::find($product);
//        $data = Product::findOrFail($product);
        $relateds = Product::where("category_id",$product->category_id)->where("id","!=",$product->id)
            ->orderBy("id","desc")->limit(4)->get();
        return view("page.detail",compact('product','relateds'));
    }

    public function detailCategory(Category $category){
        $products = Product::where("category_id",$category->id)->orderBy("id","desc")->paginate(15);
        $categories = Category::all();
        return view("page.category",compact('category','products','categories'));
    }
}
