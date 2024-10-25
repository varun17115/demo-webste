<?php

namespace App\Http\Controllers;

use App\Models\BrandDetails;
use App\Models\categoryDetails;
use App\Models\orderDetails;
use App\Models\productsDetails;
use App\Models\UserFeedbacks;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserTable;
use Illuminate\Support\Facades\Hash;
use Eastwest\Json\Facades\Json;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class LogController extends Controller
{
    function dashboard()
    {
        $order_total =  orderDetails::all();
        $user_total = UserTable::all();
        $products_total = productsDetails::all();
        $brands_total = BrandDetails::all();
        $category_total = categoryDetails::all();
        $feedbacks_total = UserFeedbacks::all();
        $chart_data = orderDetails::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(order_date) as month_name"))
            ->whereYear('order_date', date('Y'))
            ->groupBy(DB::raw("month_name"))
            // ->orderBy('month_name','ASC')
            ->pluck('count', 'month_name');
        // ->get();

        $recent_orders = orderDetails::select('user_id', 'Total_Products', 'Total_Price', 'order_id')
            ->where('status', 'pending')
            ->with(['user_detail' => function ($q) {
                $q->select('id', 'firstname', 'lastname');
            }])
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        $labels = $chart_data->keys();
        $data = $chart_data->values();

        $total_arr = array();
        $total_arr['total_order'] = count($order_total);
        $total_arr['total_user'] = count($user_total);
        $total_arr['total_product'] = count($products_total);
        $total_arr['total_brand'] = count($brands_total);
        $total_arr['total_category'] = count($category_total);
        $total_arr['total_feedback'] = count($feedbacks_total);


        return view('admin.pages.welcomepage', ['total' => $total_arr, 'labels' => $labels, 'data' => $data, 'recent_orders' => $recent_orders]);
    }
    function register_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:ajax_data|email|regex:/(.+)@(.+)\.(.+)/i',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'cpassword' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => false, 'errors' => $validator->errors()]);
        }

        $pass = $request->password;
        $password = Hash::make($pass);
        $user = UserTable::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => $password
        ]);

        Auth::login($user);

        return json_encode(['status' => true]);
    }
    function show_register_page()
    {
        return view('admin/pages/register');
    }
    function show_login_page()
    {
        return view('admin/pages/login');
    }
    function login_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => false, 'errors' => $validator->errors()]);
        }

        $credentials = $request->only('email', 'password');
        $email = $_REQUEST['email'];
        $name = UserTable::where('email', $email)->get('firstname');


        if (Auth::attempt($credentials)) {


            return json_encode(['status' => true]);
        } else {
            return json_encode(['status' => false, 'errors' => ['wrongpass' => 'Invalid Credentials']]);
        }
    }
    function login_thru_ajax(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $email = $_REQUEST['email'];
        print_r($credentials);
        $name = UserTable::where('email', $email)->get('firstname');

        if (Auth::attempt($credentials)) {
            // return 'aa';
            return redirect('login')->with('id', $name[0]['firstname']);
        } else {
            // echo '<br>'.'abcd';
            return json_encode(['status' => false, 'errors' => 'Invalid Credentials']);
        }
    }
    function logout_user()
    {
        Session::flush();
        Auth::logout();
        // return redirect('admin/pages/login');
    }
}
