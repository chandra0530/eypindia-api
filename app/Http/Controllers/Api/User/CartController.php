<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Session;
class CartController extends Controller
{
    public function index(){
       $cart = new Cart();
        $products = $cart->items;
        return json_encode(['code'=>200,'products'=>$products]);
    }
    public function store(Request $request){
       
        $cart = new Cart();
        $user_id = auth('api')->id();

        $cart->user_id= $user_id;
        $cart->product_id=$request->product_id;
        $cart->variation_id=$request->variation_id;
        $cart->quantity=$request->quantity;
        $cart->save();
        return json_encode(['code'=>200,'cart'=>$cart,'responce'=>'Products Added to cart Successfully']);
    }

    public function cartdetails(){
        $oldCart = Session::get('cart');
        $user_id = auth('api')->id();
        $cart = Cart::where('user_id', $user_id)->with(['product','user'])->get();

        return json_encode(['code'=>200,'cart_items'=>$cart]);
        
    }
}
