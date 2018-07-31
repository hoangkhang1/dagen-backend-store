<?php

namespace App\Http\Controllers;

use App\OrderInvoiceModel;

use App\OrdersModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $id_user = Auth::user()->store_login_id;
//        dd($id_user);
        $data = OrderInvoiceModel::leftjoin('store', 'store.store_id', '=', 'order_invoice.storeid')
            ->where('store.userid', $id_user)
//            ->where('processed_status',0)
            ->get();
//        dd($data->toArray());
//        dd($data);
        return view('admin.order.index', compact('data'));
    }

    public function xemchitietdh($id_invoice)
    {

        $data = OrderInvoiceModel::select('invoice_id', 'order_code', 'total',
            'name', 'phone', 'email', 'address', 'note', 'order_rating.rating',
            'store.title as store_name', 'store_image','store_address', 'processed_date',
            'processed_note', 'processed_status', 'order_invoice.created_at')
            ->leftJoin('store', 'store_id', '=', 'order_invoice.storeid')
            ->leftJoin('order_rating', 'order_rating.order_id', '=', 'invoice_id')
            ->where('invoice_id', $id_invoice)
            ->first();
//        dd($data);

        $product = OrdersModel::
        select('order_id', 'products.name as product_name', 'quantity', 'orders.price as order_price', 'orders.total as order_total',
            'order_invoice.name as cus_name', 'image_front')
            ->where('invoice_id', $id_invoice)
//                ->where('order_id',$id_order)
            ->leftJoin('products', 'products.product_id', '=', 'orders.productid')
            ->leftJoin('order_invoice', 'order_invoice.invoice_id', '=', 'orders.invoiceid')
            ->get();
        $sum = $product->sum('order_total');
//            dd($sum, $product);
//                dd($data,$product);
//        dd($data);

        return view('admin.order.order_detail', compact('data', 'product','sum'));

//        $data = OrdersModel::leftjoin('order_invoice', 'order_invoice.invoice_id', '=', 'orders.invoiceid')
//            ->leftjoin('products', 'products.product_id', '=', 'orders.productid')
//            ->where('order_invoice.invoice_id', $id)
//            ->select(
//                'orders.order_id as dhid',
//                'orders.quantity as sl',
//                'orders.price as dhgia',
//                'orders.total as dhtc',
//                'order_invoice.invoice_id as ctdhid',
//                'order_invoice.name as ctdht',
//                'order_invoice.phone as sdt',
//                'order_invoice.email as e',
//                'order_invoice.address as dc',
//                'order_invoice.note as note',
//                'order_invoice.total as ctdhtt',
//                'order_invoice.processed_status as status',
//                'products.product_id as spid',
//                'products.name as spname',
//                'products.price as spgia'
//            )
//            ->get();
////        dd($data->toArray());
//        $count = count($data);
//        for ($i = 0; $i < $count; $i++) {
//            $data[$i]['stt'] = $i + 1;
//        }
//        return view('admin.order.order_detail', compact('data'));
    }

    public function duyetdh($id)
    {
        $id_user = Auth::user()->store_login_id;
        $data = OrderInvoiceModel::where('invoice_id', '=', $id)->first();
        $data->processed_status = 1;
        $data->processed_user = $id_user;
        $data->save();
        return redirect('don-hang');
    }

    public function huydh($id)
    {
        $id_user = Auth::user()->store_login_id;
        $data = OrderInvoiceModel::where('invoice_id', '=', $id)->first();
        $data->processed_status = 2;
        $data->processed_user = $id_user;
        $data->save();
        return redirect('don-hang');
    }

    public function saleshistory()
    {
        $id_store = Auth::user()->store_id;
        $data = OrdersModel::
        select('order_id as id_order', 'processed_status', 'orders.total as total_order'
            , 'processed_note', 'note', 'email', 'address', 'phone', 'name', 'order_code', 'order_invoice.invoice_id as id_invoice')
            ->where('order_invoice.storeid', $id_store)
            ->where('processed_status','>',0)
            ->join('order_invoice', 'order_invoice.invoice_id', '=', 'orders.invoiceid')
            ->get();
//        dd($data);
        return view('admin.order.index', compact('data'));
    }
}
