<?php

namespace App\Http\Controllers;

use App\ProductCategoryModel;
use App\ProductCommentModel;
use App\ProductModel;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Facades\Input;
use App\SanPhamModel;
use App\StoreModel;
use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }
    public static function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function index()
    {
        $id_user = Auth::user()->store_login_id;
        $id_store = Auth::user()->store_id;

        $data = ProductModel::leftjoin('store_login', 'store_login.store_login_id', '=', 'products.userid')
            ->leftjoin('store', 'store.store_id', '=', 'products.storeid')
            ->leftjoin('product_category', 'product_category.cat_id', '=', 'products.catid')
            ->where('store_login.store_login_id', $id_user)
            ->where('storeid',$id_store)
            ->select([
                '*',
                'products.product_id as id',
                'products.name as sanpham'
            ])->get();
//        dd($data);
//        $count = count($data);
//        for ($i = 0; $i < $count; $i++) {
//            $data[$i]['stt'] = $i + 1;
//        }

//        $cat = ProductCategoryModel::where('userid', $id_user)->get();


        return view('admin.products.index', compact('data'));
    }

    public function search(Request $request)
    {
        $id_user = Auth::user()->store_login_id;
//        $id_store = Auth::user()->store_id;

//        dd($request->all());
        $cat = ProductCategoryModel::where('userid', $id_user)->get();

        $where = [];
        if ($request->catid != 'all') {
            $where[] = ['catid', '=', $request->catid];
        }
        $where[] = ['name', 'like', '%' . $request->name . '%'];

        $data = ProductModel::
        where($where)
            ->get();
        return view('admin.products.index', compact('data', 'cat'));

    }

    public function create()
    {
        $store = StoreModel::all();
        $cate = ProductCategoryModel::all();
        return view('admin.products.create', compact('store', 'cate'));
    }

    public function created(Request $request)
    {

        $id_user = Auth::user()->store_login_id;

        $product = new ProductModel();
        $product_id = SanPhamController::GUID();
        $product->product_id = $product_id;
        $product->userid = $id_user;
        $product->storeid = $request->storeid;
        //$product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        //$product->price_reference = $request->price_reference;
        $product->hashtag = $request->hashtag;
        $product->catid = $request->catid;
//        $data1 = new SanPhamModel();

//        $contain = '';
//        foreach ($request->hashtag as $val) {
//            $contain .= $val . ', ';
//        }
//        $product->hashtag = substr($contain, 0, -2);

        $destinationPath = public_path('/product_image');
        $id_image = SanPhamController::GUID();
        $image_front = $request->file('file');
        $image_front_name = $product_id . '_' . $id_image . '.' . $image_front->getClientOriginalExtension();
        $image_front->move($destinationPath, $image_front_name);

        $images = [];
        if($request->file1){
            $images[] = $request->file1;
        }
        if($request->file2){
            $images[] = $request->file2;
        }
        if($request->file3){
            $images[] = $request->file3;
        }
        if($request->file4){
            $images[] = $request->file4;
        }
        if($request->file5){
            $images[] = $request->file5;
        }

//        dd($images);
        $arr_image = [];

        if($request->hasFile('file1'))
        {

            foreach ($images as $item) {
                $item_name = $product_id . '_' . SanPhamController::GUID() . '.' . $item->getClientOriginalExtension();
                $item->move($destinationPath, $item_name);
                $arr_image[]=$item_name;
            }

        }
        $product->image_gallery = json_encode($arr_image,true);

        $product->image_front = $image_front_name;
        $product->save();
//        dd($product);
                return redirect('san-pham');
    }

    public function edit($id)
    {
        $data = SanPhamModel::find($id);
//        dd($data);
        $store = StoreModel::all();
        $cate = ProductCategoryModel::all();
        return view('admin.products.edit', compact('data', 'store', 'cate'));
    }

    public function update(Request $request, $product_id)
    {
        $data = SanPhamModel::find($product_id);
        $data->storeid = $request->get('storeid');
        $data->catid = $request->get('catid');
        $data->name = $request->get('name');
        $data->description = $request->get('description');
        $data->price = $request->get('price');
        $data->price_reference = $request->get('price_reference');
        $destinationPath = public_path('/product_image');
        $id_image = SanPhamController::GUID();
        $image_front = $request->file('file');
        $image_front_name = $product_id . '_' . $id_image . '.' . $image_front->getClientOriginalExtension();
        $image_front->move($destinationPath, $image_front_name);
        $contain = '';
        $hashtag = $request->get('hashtag');
        $images = [];
        if($request->file1){
            $images[] = $request->file1;
        }
        if($request->file2){
            $images[] = $request->file2;
        }
        if($request->file3){
            $images[] = $request->file3;
        }
        if($request->file4){
            $images[] = $request->file4;
        }
        if($request->file5){
            $images[] = $request->file5;
        }

//        dd($images);
        $arr_image = [];

        if($request->hasFile('file1'))
        {

            foreach ($images as $item) {
                $item_name = $product_id . '_' . SanPhamController::GUID() . '.' . $item->getClientOriginalExtension();
                $item->move($destinationPath, $item_name);
                $arr_image[]=$item_name;
            }

        }
        $data->hashtag = $hashtag;
        $data->save();
        return redirect('san-pham');
    }

    public function destroy($id)
    {
        SanPhamModel::find($id)->delete();
        return redirect('san-pham/index');
    }

    public function printQRcode()
    {
        $id_user = Auth::user()->store_login_id;
        $data = SanPhamModel::leftjoin('store_login', 'store_login.store_login_id', '=', 'products.userid')
            ->where('users.user_id', $id_user)->get();
        return view('products.printQRcode', compact('data'));
    }

    public function product_comment($id_product)
    {
//        dd($id_product);
        $product = SanPhamModel::select('name')->where('product_id', $id_product)->first();
        $comment = ProductCommentModel::
        select('comment_id', 'name', 'avatar', 'title', 'comments', 'reply', 'product_comment.created_at')
            ->leftJoin('users_profile', 'users_profile.userid', '=', 'product_comment.userid')
            ->where('productid', $id_product)
//            ->where('comment_parent_id', '0')
            ->orderBy('product_comment.created_at')
            ->get();
//        dd($comment);
        return view('comment.product_comment', compact('comment', 'product'));
    }

    public function comment(Request $request)
    {
//        dd(Auth::user());
        $id_user = Auth::user()->store_login_id;
        $ngay = $request->ngay;
        $ngayc = ($ngay.' 23:59:59');
        $ngayd = ($ngay.' 00:00:00');
        $comment = ProductCommentModel::
        select('comment_id', 'users_profile.name as name', 'products.name as name_product', 'store_reply_message',
            'avatar', 'title', 'comments','seen' ,'reply', 'product_comment.created_at')
            ->leftJoin('users_profile', 'users_profile.userid', '=', 'product_comment.userid')
            ->leftJoin('products', 'products.product_id', '=', 'product_comment.productid')
            ->where('products.storeid',Auth::user()->store_id)
//            ->where('product_comment.seen', '0')
            ->where('product_comment.userid', $id_user);
        if ($request->ngay !='') {

            $comment = $comment->where('product_comment.created_at',[$ngayd,$ngayc]);
        }

        $comment = $comment
            ->orderBy('product_comment.created_at','desc')
            ->get();
//        dd($comment);
        return view('admin.comment.index', compact('comment'));
    }

    public function reply_comment(Request $request, $comment_id)
    {
        $id_user = Auth::user()->store_login_id;

        if (empty($request->all())) {
            $comment = ProductCommentModel::
            select('comment_id', 'users_profile.name as name', 'products.name as name_product',
                'avatar', 'title', 'comments', 'product_comment.created_at')
                ->leftJoin('users_profile', 'users_profile.userid', '=', 'product_comment.userid')
                ->leftJoin('products', 'products.product_id', '=', 'product_comment.productid')
                ->where('product_comment.userid', $id_user)
                ->where('comment_id', $comment_id)
                ->orderBy('product_comment.created_at')
                ->first();
//        dd($comment);
            $comment_reply = [];
            return view('admin.comment.reply', compact('comment', 'comment_reply'));
        } else {
            $comment = ProductCommentModel::
            select('comment_id', 'users_profile.name as name',
                'products.name as name_product', 'avatar', 'title', 'comments','seen', 'product_comment.created_at')
                ->leftJoin('users_profile', 'users_profile.userid', '=', 'product_comment.userid')
                ->leftJoin('products', 'products.product_id', '=', 'product_comment.productid')
                ->where('product_comment.userid', $id_user)
                ->where('comment_id', $comment_id)
                ->orderBy('product_comment.created_at')
                ->first();

            $comment_reply = ProductCommentModel::find($comment_id);
            $comment_reply->store_reply_message = $request->comment_reply;
            $comment_reply->seen = 1;
            $comment_reply->save();
            return redirect('comment');

//            return view('admin.comment.index',compact('comment'));
        }
    }

    public function search_comment(Request $request)
    {
        $where = [];
        if ($request->cmt == '0') {
            $where[] = ['seen', '=', $request->cmt];
        }
        else{
            $where[] = ['seen', '=', $request->cmt];
        }

        $comment = ProductCommentModel::
            select('comment_id', 'users_profile.name as name', 'products.name as name_product', 'store_reply_message',
                'avatar', 'title', 'comments', 'reply', 'product_comment.created_at')
                ->leftJoin('users_profile', 'users_profile.userid', '=', 'product_comment.userid')
                ->leftJoin('products', 'products.product_id', '=', 'product_comment.productid')
                    ->where($where)
            ->orderBy('product_comment.created_at','desc')
                        //            ->where('comment_parent_id', '0')
//            ->where('product_comment.seen', '0')
            ->get();
        return view('comment.index', compact('comment'));

    }
}