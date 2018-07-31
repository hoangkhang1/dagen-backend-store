<?php

namespace App\Http\Controllers;

use App\ProductCategoryModel;
use App\ProductModel;
use App\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhMucController extends Controller
{
    public static function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function index()
    {
        $id_store = Auth::user()->store_id;
//        dd($id_store);
        $id_user = Auth::user()->store_login_id;
//        dd(Auth::user());

        $blogscategories = ProductCategoryModel::
            select('cat_id','store.title as store_name','product_category.name as tenDM','product_category.description',
            'product_category.created_at as ngaytao')
            ->join('store','store.store_id','=','product_category.store_id')
//            ->join('products','products.catid','=','product_category.cat_id')
            ->where('product_category.store_id',$id_store)
            ->where('product_category.userid',$id_user)
            ->get();
//        $sosp = count($blogscategories->masp)
//        dd($blogscategories);
        return view('admin.category.index',compact('blogscategories'));
    }

    public function create()
    {
        $id_user = Auth::user()->store_login_id;
        $store = StoreModel::where('userid',$id_user)->get();
        return view('admin.category.create', compact('store'));
    }

    public function edit($id)
    {
        $id_user = Auth::user()->store_login_id;
        $data = ProductCategoryModel::find($id);
        $store = StoreModel::where('userid',$id_user)->get();
        return view('admin.category.update', compact('data','store'));
    }

    public function created(Request $request)
    {
        $id_user = Auth::user()->store_login_id;
        $cat_id = $this->GUID();
        $cat = ProductCategoryModel::create([
            'cat_id' =>$cat_id,
            'userid' =>$id_user,
            'store_id' =>$request->get('store'),
            'name'=>$request->name_cat,
            'description'=>$request->description,
        ]);
        return redirect(url('danh-muc/'));
    }

    public function update(Request $request,$id)
    {
        $cat = ProductCategoryModel::find($id);
        $cat->name=$request->name_cat;
        $cat->store_id =$request->get('store');
        $cat->description=$request->description;
        $cat->save();
        return redirect('danh-muc/');
    }

    public function destroy($id)
    {
        ProductCategoryModel::find($id)->delete();
        ProductModel::where('catid', $id)->update(['catid' => 'null']);
        return redirect('danh-muc/');
    }
}
