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

    public function search(Request $request){ // reflection
        // get keyword
        $keyword = $request->get("keyword");
        $products = Product::where("name","LIKE","%$keyword%")
            ->orWhere("description","LIKE","%$keyword%")
            ->orderBy("id","desc")->paginate(15);
        $categories = Category::all();
        return view("page.search",compact('products','categories')); // render
    }

    public function addToCart(Product $product,Request $request){
        $buy_qty = $request->has("buy_qty")?$request->get("buy_qty"):1;
        // lấy giỏ hàng ra (nếu có)
        $cart = session()->has("cart")?session()->get("cart"):[];
        // thêm sp vào giỏ hàng
        $check =  false;
        foreach ($cart as $item){
            if($item->id == $product->id){
                $item->buy_qty = $item->buy_qty + $buy_qty;
                $check = true;
                break;
            }
        }
        if($check == false){
            $product->buy_qty = $buy_qty;
            $cart[] = $product;
        }
        // set giá trị giỏ hàng lại vào session
        session()->put(["cart"=>$cart]); // session()->put("cart",$cart);
        return redirect()->back()->with("success","Đã thêm $product->name vào giỏ hàng!");
    }

    public function cart(){
        $cart = session()->has("cart")?session()->get("cart"):[];
        $total = 0;
        foreach ($cart as $item){
            $total += $item->buy_qty * $item->price;
        }
        return view("page.cart",compact('cart','total'));
    }
}
