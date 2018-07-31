<?php

namespace App\Http\Controllers;

use App\OrderInvoiceModel;
use App\StoreModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoanhSoController extends Controller
{
    public function index(Request $request)
    {
//        dd(Auth::user());
        if (empty($request->all())) {


            $id_store = Auth::user()->store_id;

            $id_user = Auth::user()->store_login_id;
            $store = StoreModel::
//            join('store', 'store.store_id', '=', 'order_invoice.storeid')
//                ->where('processed_status', 1)
            select('store.title as nameStore','store_address')
                ->where('store.userid', $id_user)
                ->where('store.store_id', $id_store)

                ->first();
//            dd($store);
            $data = [];
            return view('admin.doanhso.index', compact('store', 'data'));
        } else {
            $id_user = Auth::user()->store_login_id;
            $id_store = Auth::user()->store_id;
//            $store = StoreModel::
//            where('store.userid', $id_user)
//                ->where('store.store_id', $id_store)
//                ->get();
//            $id_store = $request->get('title');
//            dd($id_store);
            $store = StoreModel::
//            join('store', 'store.store_id', '=', 'order_invoice.storeid')
//                ->where('processed_status', 1)
            select('store.title as nameStore','store_address')
                ->where('store.userid', $id_user)
                ->where('store.store_id', $id_store)

                ->first();
            $tungay = $request->tungay;
            $tungay = $tungay . ' 00:00:00';
            $denngay = $request->denngay;
            $denngay = $denngay . ' 23:59:59';
            $data = OrderInvoiceModel::where('storeid', $id_store)
                ->whereBetween('created_at', [$tungay, $denngay])
                ->sum('total');
//            dd($data);

            $thongtin = OrderInvoiceModel::
            select('store.title as nameStore', 'users_profile.name as chucuahang', 'store_address',
                'order_invoice.name as tennguoimua', 'order_invoice.phone as sdtnguoimua', 'order_invoice.created_at as ngaymua',
                'processed_status as trangthaidonhang')
                ->join('store', 'store.store_id', '=', 'order_invoice.storeid')
                ->join('users_profile', 'users_profile.userid', '=', 'store.userid')
                ->where('processed_status', 1)
                ->whereBetween('order_invoice.created_at', [$tungay, $denngay])
                ->where('order_invoice.storeid', $id_store)
                ->where('store.userid', $id_user)
                ->first();
//            dd($thongtin);
            return view('admin.doanhso.index', compact('data', 'store', 'thongtin'));
        }
    }

}

