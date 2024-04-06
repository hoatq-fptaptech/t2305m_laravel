<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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

    public function checkout(){
        $cart = session()->has("cart")?session()->get("cart"):[];
        if(count($cart) == 0){
            return redirect()->to("/cart");
        }
        $total = 0;
        foreach ($cart as $item){
            $total += $item->buy_qty * $item->price;
        }
        return view("page.checkout",compact('cart','total'));
    }

    public function placeOrder(Request $request){
        $cart = session()->has("cart")?session()->get("cart"):[];
        if(count($cart) == 0){
            return redirect()->to("/cart");
        }
        $total = 0;
        foreach ($cart as $item){
            $total += $item->buy_qty * $item->price;
        }

        // tạo đơn hàng
        $request->validate(
            [
                'shipping_address'=> "required|string|min:6",
                'shipping_method'=>'required',
                'payment_method'=>"required",
                'first_name'=>"required|string",
                'last_name'=>"required|string",
                'city'=>"required|string",
                'telephone'=>"required|string|min:10",
                'email'=>"required|string|min:6",
            ],
            [
                "required"=> "Vui lòng nhập thông tin :attribute",
                "min"=> "Hãy nhập giá trị :attribute tối thiểu là :min"
            ]
        );
        $order = Order::create(
            [
                'grand_total'=>$total,
                'shipping_address'=>$request->get("shipping_address"),
                'shipping_method'=>$request->get("shipping_method"),
                'payment_method'=>$request->get("payment_method"),
                'status'=>0,
                'first_name'=>$request->get("first_name"),
                'last_name'=>$request->get("last_name"),
                'city'=>$request->get("city"),
                'telephone'=>$request->get("telephone"),
                'email'=>$request->get("email"),
                'order_note'=>$request->get("order_note"),
            ]
        );
        // Tạo các sản phẩm được mua của đơn hàng
        foreach ($cart as $item){
            DB::table("order_products")->insert(
                [
                    'order_id'=>$order->id,
                    'product_id'=>$item->id,
                    'qty'=>$item->buy_qty,
                    'price'=>$item->price
                ]
            );
        }
        // xoá giỏ hàng
//        session()->forget("cart");
        // Thanh toán online nếu có -- về nhà đăng ký tài khoản paypal
        if($request->get("payment_method") == "Paypal"){
            // thanh toán bằng paypal
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => url("paypal-success",["order"=>$order->id]),
                    "cancel_url" => url("paypal-cancel",["order"=>$order->id]),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => "1000.00"
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }

                return redirect()
                    ->route('createTransaction')
                    ->with('error', 'Something went wrong.');

            } else {
                return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
        // Gửi email
        Mail::to($order->email)->send(new NewOrderMail($order));

        return redirect()->to("/thank-you/".$order->id);
    }

    public function paypalSuccess(Order $order){
        die("Success");
    }

    public function paypalCancel(Order $order){
        die("Cancel");
    }
}
