<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\FoodChef;
use App\Models\Cart;
use App\Models\Order;


class HomeController extends Controller
{
    //
    function index()
    {
        if(Auth::id())
        {
            return redirect('redirects');
        }
        else

        $data=food::all();
        $data2=FoodChef::all();
        return view('home', compact('data','data2'));
    }
    function redirects()
    {
        $data=food:: all();
        $data2=FoodChef::all();
        
        $usertype=Auth::user()->usertype;
        if($usertype=='1')
        {
            return view('admin.adminhome');
        }
        else
        {
            $user_id=Auth::id();
            $count=Cart::where('user_id', $user_id)->count();

            return view('home', compact('data', 'data2', 'count'));
        }
    }
    function addCart(Request $req, $id)
    {
        if(Auth::id())
        {
            $user_id=Auth::id();
            $food_id=$id;
            $quantity=$req->quantity;
            //dd($user_id);

            $cart=new Cart;
            $cart->user_id=$user_id;
            $cart->food_id=$food_id;
            $cart->quantity=$quantity;

            $cart->save();
            

            return redirect()->back();
        }
        else
        {
            return redirect('/login');
        }
    }
    function showCart(Request $req, $id)
    {
        $count=Cart::where('user_id',$id)->count();

        if(Auth::id()==$id)
        {
            $data=cart::where('user_id',$id)->join('food', 'carts.food_id', '=', 'food.id')->get();
            $data2=Cart::select('*')->where('user_id', '=', $id)->get();
            return view('showcart', compact('count','data','data2'));
        }
        else
        {
            return redirect()->back();
        }
        // we need to show image here.
    }
    function removeCart($id)
    {
        $data=Cart::find($id);
        $data->delete();
        return redirect()->back();
    }

    function orderConfirm(Request $req)
    {
        foreach($req->foodname as $key=>$foodname)
        {
            $data=new Order;
            $data->foodname=$foodname;
            $data->price=$req->price[$key];
            $data->quantity=$req->quantity[$key];

            $data->name=$req->name;
            $data->phone=$req->phone;
            $data->address=$req->address;

            $data->save();


            
            
        }
        return redirect()->back();
    }
    
}
