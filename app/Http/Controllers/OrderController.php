<?php

namespace App\Http\Controllers;

use App\Models\AddressDetails;
use App\Models\orderDetails;
use App\Models\orderItems;
use App\Models\productsDetails;
use App\Models\shopSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class OrderController extends Controller
{
    function display_checkout()
    {
        return view('user/pages/checkout');
    }
    function place_order(Request $request)
    {

        $order = orderDetails::create([
            'user_id' => Auth::user()->id,
            'address_id' => $request->address_id,
            'Payment_Method' => 'Cash On Delivery',
            'status' => 'pending',
            'Total_Price' => $request->total_price,
            'Total_Products' => $request->total_products,
            'order_id' => substr(md5(time()), 0, 16),
            'order_date' => date('y-m-d')
        ]);
        for ($i = 0; $i < count($request->products); $i++) {
            $order_details = orderItems::create([
                'order_id' => $order->id,
                'product_id' => $request->products[$i]['product_id'],
                'product_price' => $request->price[$i],
                'product_quantity' => $request->products[$i]['quantity'],
            ]);
        };

        for ($k = 0; $k < count($request->products); $k++) {
            $quantity =  productsDetails::select('prod_quantity')
                ->where('prod_id', $request->products[$k]['product_id'])->get()->first();

            $final_quantity = $quantity->prod_quantity - $request->products[$k]['quantity'];

            productsDetails::where('prod_id', $request->products[$k]['product_id'])
                ->update(['prod_quantity' => $final_quantity]);
        }
        // echo "<pre>";
        // print_r($request->products);exit;
        return json_encode(['status' => $final_quantity, 'id' => $order->id]);
    }
    function display_orders()
    {
        return view('admin/pages/order_details');
    }
    function show_orders()
    {
        $order_details = orderDetails::select()
            ->with(['order_items', 'address_detail'])
            ->get();
        return DataTables::of($order_details)

            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $span = '<button onclick="show_order(' . $row->id . ')"class="btn btn-primary btn-sm ">View Order</button>';
                return $span;
            })


            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    function update_status(Request $request)
    {
        $order = orderDetails::where('order_id', $request->id)->update(['status' => $request->status]);

        return json_encode(['status' => true]);
    }
    function order_success(Request $request)
    {

        $order_details = orderDetails::where('id', $request->id)->first();
        $product_details = orderItems::select('id', 'order_id', 'product_id', 'product_price', 'product_quantity', 'products_details.prod_image', 'products_details.prod_name')
            ->where('order_id', $request->id)
            ->join("products_details", "order_items.product_id", "=", "products_details.prod_id")
            ->get();
        $gst_value = shopSetting::select('setting_value')->where('setting_key', 'product_gst')->get();

        return view('user/pages/order_success', ['order' => $order_details, 'products' => $product_details, 'gst_value' => $gst_value]);
    }
    function track_order(Request $request)
    {
        $order_details = orderDetails::select('id', 'order_id', 'order_details.user_id', 'order_details.address_id', 'Total_Products', 'Total_Price', 'status', 'Payment_Method', 'order_date', 'address_details.address', 'address_details.country', 'address_details.state', 'address_details.city', 'address_details.zip_code')
            ->where('order_details.user_id', Auth::user()->id)
            ->join("address_details", "order_details.address_id", "=", "address_details.address_id")

            ->get();

        return view('user/pages/track_orders', ['order' => $order_details]);
    }
    function get_order_data(Request $request)
    {
        $order_details = orderDetails::select('id', 'order_id', 'order_details.user_id', 'order_details.address_id', 'Total_Products', 'Total_Price', 'status', 'Payment_Method', 'order_date')
            ->where('order_details.user_id', Auth::user()->id)
            ->where('order_details.id', $request->id)

            ->with(['order_items', 'address_detail'])
            ->first();



        $product_items = orderItems::with('product')->first();
        return json_encode(['order' => $order_details]);
        // return json_encode(['data'=>$product_items]);
    }
    function cancel_order(Request $request)
    {
        $order_details = orderDetails::where('id', $request->id)->update(['status' => 'cancelled', 'reason' => $request->reason]);
        return json_encode(['status' => true]);
    }
    function generate_bill(Request $request)
    {
        $order_details = orderDetails::select()
            ->where('order_id', $request->id)
            ->with(['order_items', 'address_detail', 'user_detail'])
            ->get()
            // ->toarray();
            ->first();


        $settings = shopSetting::select('setting_key', 'setting_value')->get();
        for ($i = 0; $i < count($settings); $i++) {
            $my_arr[$settings[$i]['setting_key']] = $settings[$i]['setting_value'];
        }


        $pdf = PDF::loadView('user/pages/bill', ['order' => $order_details, 'shop_detail' => $my_arr])->setPaper('A4', 'portrait');
        // return $pdf->stream();
        $fileName = 'bill.pdf';
        $pdf->save(public_path() . '/' . $fileName);

        $pdf = public_path($fileName);


        return response()->download($pdf);
    }
    function show_invoice(Request $request, $id)
    {
        $order_details = orderDetails::select()
            ->where('order_id', $id)
            ->with(['order_items', 'address_detail', 'user_detail'])
            ->get()
            // ->toarray();
            ->first();
        $settings = shopSetting::select('setting_key', 'setting_value')->get();
        for ($i = 0; $i < count($settings); $i++) {
            $my_arr[$settings[$i]['setting_key']] = $settings[$i]['setting_value'];
        }

        return view('user/pages/bill', ['order' => $order_details, 'shop_detail' => $my_arr]);
    }
    function reorder(Request $request)
    {
        $order_details = orderDetails::select()
            ->where('id', $request->id)
            ->with(['order_items', 'address_detail', 'user_detail'])
            ->get()
            ->first();
        
        return json_encode(['order_details'=>$order_details]);
    }
}
