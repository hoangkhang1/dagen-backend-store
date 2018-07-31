<?php

namespace App\Http\Controllers;

use App\KeyStoreModel;
use App\OrderInvoiceModel;
use App\SanPhamModel;
use App\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class StoreController extends Controller
{

    public function index()
    {
        $id_user = 'bae4f11f559d81b034b2f06e78bf2615';
        $data = StoreModel::where('userid',$id_user)->get();
        return view('admin.store.index',compact('data'));
    }

    public function create()
    {
//        dd(Auth::user());
        return view('store.create');
    }

    public function created(Request $request)
    {
        $id_user = 'bae4f11f559d81b034b2f06e78bf2615';
        $id_store = random_str();
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file->move('upload', $file->getClientOriginalName());
            $filename = url('upload') . '/' . $file->getClientOriginalName();
        } else {
            $filename = "";
        }
        StoreModel::create([
            'store_id' =>$id_store,
            'userid'=>$id_user,
            'title'=>$request->title,
            'description'=>$request->description,
            'store_address'=>$request->store_address,
            'store_phone'=>$request->store_phone,
            'store_email'=>$request->store_email,
            'store_image'=>$filename,
            'status'=>$request->status,
        ]);
        KeyStoreModel::create([
            'id_store'=>$id_store,
        ]);
        return redirect(url('cua-hang/'));
    }

    public function edit($id)
    {
        $data = StoreModel::find($id);
        return view('store.edit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        $data = StoreModel::find($id);
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file->move('upload', $file->getClientOriginalName());
            $filename = url('upload') . '/' . $file->getClientOriginalName();
            $data->store_image = $filename;
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->store_address = $request->store_address;
        $data->store_phone = $request->store_phone;
        $data->store_email = $request->store_email;
        $data->status = $request->status;
        $data->transaction = $request->transaction;
        $data->rating = $request->rating;
        $data->save();
        return redirect(url('cua-hang/'));
    }

    public function destroy($id)
    {
        StoreModel::find($id)->delete();
        KeyStoreModel::where('id_store',$id)->delete();
        return redirect(url('cua-hang/'));
    }

    public function product_store($id_store)
    {
//        dd($id);
        $id_user = 'bae4f11f559d81b034b2f06e78bf2615';

        $data = SanPhamModel::leftjoin('users', 'users.user_id', '=', 'products.userid')
            ->leftjoin('store', 'store.store_id', '=', 'products.storeid')
            ->leftjoin('product_category', 'product_category.cat_id', '=', 'products.catid')
            ->where('users.user_id', $id_user)
            ->where('products.storeid', $id_store)
            ->select([
                '*',
                'products.name as sanpham'
            ])->get();
//        dd($data);
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['stt'] = $i + 1;
        }
        return view('products.danhsachsanpham', compact('data'));
    }

    public function order_store($id_store)
    {
        $id_user = 'bae4f11f559d81b034b2f06e78bf2615';

        $data = OrderInvoiceModel::leftjoin('store', 'store.store_id', '=', 'order_invoice.storeid')
            ->where('store.userid', $id_user)
            ->where('store.store_id', $id_store)
            ->select(
                'order_invoice.invoice_id',
                'store.title',
                'order_invoice.name',
                'order_invoice.phone',
                'order_invoice.email',
                'order_invoice.address',
                'order_invoice.note',
                'order_invoice.total',
                'order_invoice.processed_status'
            )->get();
//        dd($data->toArray());
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['stt'] = $i + 1;
        }
        return view('donhang.danhsachdonhang', compact('data'));
    }
}
