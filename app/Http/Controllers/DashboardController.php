<?php

namespace App\Http\Controllers;

use App\OrderInvoiceModel;
use App\OrdersModel;
use App\ProductCategoryModel;
use App\ProductCommentModel;
use App\ProductModel;
use App\StoreModel;
use App\User;
use App\UserProfileModel;
use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
//        dd(Auth::user());
        $id_user = Auth::user()->store_login_id;
        $id_store = Auth::user()->store_id;


        $comment = ProductCommentModel::where('userid',$id_user)->where('seen',0)->count();
        $product = ProductModel::where('userid',$id_user)->where('status',1)->where('storeid',$id_store)->count();
        $category = ProductCategoryModel::where('userid',$id_user)->where('store_id',$id_store)->count();
        $donhang = OrderInvoiceModel::where('userid',$id_user)->where('processed_status',0)->where('storeid',$id_store)->count();

        $store = StoreModel::select('title','description',
            'store_address','store_email','store_image','rating')
            ->where('store_id',$id_store)
            ->first();

        $user = User::where('store_login_id',$id_user)->first();
//        dd($user);




        return view('admin.dashboard.index',compact('donhang',
            'comment','product','category','store','user'));
    }
}
