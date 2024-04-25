<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.page.dashboard");
    }
    public function orders(Request $request){
        $search = $request->get("search");
        $status = $request->get("status");
        $orders = Order::Search($search)->Status($status)
                ->orderBy("id","desc")
                ->paginate(20);
        return view("admin.page.orders",compact('orders'));
    }
    public function detailOrder(Order $order){
        return view("admin.page.detail_order",compact('order'));
    }
    public function confirmOrder(Order $order){
        $order->update(["status"=>Order::STATUS_CONFIRMED]);
        return redirect()->back();
    }

    public function products(Request $request){
        $products = Product::orderBy("id","DESC")->paginate(20);
        return view("admin.page.products",compact('products'));
    }

    public function productCreate(){
        $categories = Category::all();
        $brands = Brand::all();
        return view("admin.page.product_create",compact("categories","brands"));
    }

    public function productSave(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "price"=>"required|numeric|min:0",
            "qty"=>"required|numeric|min:0",
            "category_id"=>"required|numeric|min:1",
            "brand_id"=>"required|numeric|min:1",
            "thumbnail"=>"nullable|image|mimes:jpg,jpeg,png,gif"
        ]);
        try {
            $thumbnail = null;
            // upload image thumbnail
                if($request->hasFile("thumbnail")){
                    $file = $request->file("thumbnail");
                    $file_name = random_int(0,999).time().$file->getClientOriginalName();
//                    $ext_name = $file->getClientOriginalExtension();//"png jpg"
//                    $random_name_file = uuid_create().".".$ext_name;
                    $path = public_path("uploads");
                    $file->move($path,$file_name);
                    $thumbnail = "/uploads/".$file_name;
                }
            // end
            Product::create([
                "name"=>$request->get("name"),
                "slug"=> Str::slug($request->get("name")),
                "thumbnail"=>$thumbnail,
                "price"=>$request->get("price"),
                "qty"=>$request->get("qty"),
                "category_id"=>$request->get("category_id"),
                "brand_id"=>$request->get("brand_id")
            ]);
            return redirect()->to("/admin/products");
        }catch (\Exception $e){
            return abort(403);
        }
    }

    public function productDelete(Product $product){
        $product->delete();
        return redirect()->to("/admin/products");
    }
}
