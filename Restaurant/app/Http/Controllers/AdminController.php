<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\FoodChef;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{
    //
    function user()
    {
        $data=User::all();
        return view('admin.users', compact('data'));
    }
    function deleteUser($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect()->back();
    }
    function foodMenu()
    {
        $data=food::all();
        return view('admin.foodmenu', compact('data'));
    }
    function uploadFood(Request $req)
    {
        $data=new food;

        $image=$req->image;
        $imageName=time(). '.' .$image->getClientOriginalExtension();
        $req->image->move('foodimage',$imageName);
        $data->image=$imageName;

        $data->title=$req->title;
        $data->price=$req->price;
        $data->description=$req->description;

        $data->save();

        return redirect()->back();
        
    }
    function deleteMenu($id)
    {
        $data=food::find($id);
        $data->delete();
        return redirect()->back();
    }

    function updateMenu($id)
    {
        $data=food::find($id);
        return view('admin.updatemenu',compact('data'));
    }
    function updateFood(Request $req, $id)
    {
        $data=food::find($id); // here food is table name

        $image=$req->image;
        $imageName=time(). '.' .$image->getClientOriginalExtension();
        $req->image->move('foodimage',$imageName);
        $data->image=$imageName;

        $data->title=$req->title;
        $data->price=$req->price;
        $data->description=$req->description;

        $data->save();

        return redirect()->back();
    }
    function reservation(Request $req)
    {
        $data=new Reservation; // here Reservation is Model


        $data->name=$req->name;
        $data->email=$req->email;
        $data->phone=$req->phone;
        $data->guest_no=$req->guest;
        $data->date=$req->date;
        $data->time=$req->time;
        $data->message=$req->message;
        
        
        $data->save();

        return redirect()->back();
    }
    function viewReservation()
    {
        if(Auth::id())
        {
            $data=Reservation::all();
            return view('admin.adminreservation', compact('data'));
        }
        else
        {
            return redirect('/login');
        }
        

    }
    function viewChef()
    {
        $data = FoodChef::all();
        return view('admin.adminchef', compact('data'));
    }
    function uploadChef(Request $req)
    {
        $data=new FoodChef;

        $image=$req->image;
        $imageName=time(). '.' .$image->getClientOriginalExtension();
        $req->image->move('chefimage',$imageName);
        $data->image=$imageName;

        $data->name=$req->name;
        $data->speciality=$req->speciality;

        $data->save();

        return redirect()->back();
        
    }
    function updateChef($id)
    {
        $data=FoodChef::find($id);
        return view('admin.updatechef', compact('data'));
    }
    function updateFoodChef(Request $req, $id)
    {
        $data=FoodChef::find($id); // here model is table name

        $image=$req->image;
        if($image)
        {
            $imageName=time(). '.' .$image->getClientOriginalExtension();
            $req->image->move('chefimage',$imageName);
            $data->image=$imageName;
        }

        $data->name=$req->name;
        $data->speciality=$req->speciality;

        $data->save();

        return redirect()->back();
    }
    function deleteChef($id)
    {
        $data=FoodChef::find($id);
        $data->delete();
        return redirect()->back();
    }
    function orders()
    {
        $data=Order::all();
        return view('admin.orders', compact('data'));
    }
    function search(Request $req)
    {
        $search=$req->search;

        $data=Order::where('name','Like','%'.$search.'%')->orWhere('foodname','Like','%'.$search.'%')
        ->get();
        return view('admin.orders', compact('data'));
    }
    
}
