<?php

namespace App\Http\Controllers;

use App\Models\BrandDetails;
use App\Models\categoryDetails;
use App\Models\favouriteItems;
use App\Models\orderDetails;
use App\Models\productsDetails;
use App\Models\UserFeedbacks;
use App\Models\UserTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    function show_page()
    {
        if(Auth::check())
        {
            $products = productsDetails::select('prod_id','user_id','prod_image','prod_name','prod_image','prod_price',
                DB::raw('IF((select count(*) from liked_products where user_id = '.Auth::user()->id.' AND products_details.prod_id = liked_products.product_id )>0,"true","false") as isliked')
            )
            ->where('prod_feature_status','true')
            ->get();

        }
        else
        {
            $products = productsDetails::
            where('prod_feature_status','true')
            ->get();
        }
        $brands = BrandDetails::get();
        // echo "<pre>";print_r($products);exit;
        if(Auth::check())
        {
            $product_arr = array();
            $user_id = Auth::user()->id;
            $favourite_products = favouriteItems::select('product_id')->where('user_id',$user_id)->get()->toarray(); 
            
            for ($i=0; $i < count($favourite_products) ; $i++) { 
                array_push($product_arr,$favourite_products[$i]['product_id']);
            };
            
            return view('user/pages/index',['products'=>$products,'brands'=>$brands,'favourite_products'=>$product_arr]);
        }
        else
        {
            return view('user/pages/index',['products'=>$products,'brands'=>$brands]);

        }
    }
    function fetch_categories()
    {
        $data = categoryDetails::get();
        $products = productsDetails::get();
        if(Auth::check())
        {
            $liked_count = favouriteItems::where('user_id',Auth::user()->id);
            $total = $liked_count->count();
        }
        else
        {
            $total = 0;
        }
        return json_encode(['category'=>$data,'products'=>$products,'total'=>$total]);
    }
    function show_contact()
    {
        return view('user/pages/contact');
    }
    function get_feedback(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required',
            'email' => 'required|unique:user_feedbacks|email',
            'subject'=>'required',
            'message'=>'required'
        ]);

        if($validator->fails())
        {
            return json_encode(['status'=>false,'errors'=>$validator->errors()]);
        }

        UserFeedbacks::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'user_id'=>Auth::user()->user_id
        ]);

        return json_encode(['status'=>true]);

    }
    function show_feedbacks()
    {
        return view('admin/pages/user_feedbacks');
    }
    function get_feedback_data()
    {
        $data = UserFeedbacks::get();


        return DataTables::of($data)    
            ->editColumn('message',function($row){
                $span = '<span style="width:300px" class="d-block text-truncate">'.$row->message.'</span>';
                return $span;
            })        
            ->rawColumns(['message'])

            ->addIndexColumn()
            ->make(true);
    }
    
    function show_shop(Request $request)
    {
        $brands = BrandDetails::get();
        $data = categoryDetails::get();
        $filters_arr = [
            '1' => ['start' => 0, 'end' => 1000],
            '2' => ['start' => 1000, 'end' => 2000],
            '3' => ['start' => 2000, 'end' => 5000],
            '4' => ['start' => 5000, 'end' => 10000],
            '5' => ['start' => 10000, 'end' => 50000],
            '6' => ['start' => 50000, 'end' => null],
            
        ];
        $filter_id = (int)$request->filter_price;
        
        if(isset($request->brand_arr))
        {
            $brand_arr = $_REQUEST['brand_arr'];
            $brand_arr = explode(',',$brand_arr);
        }
        else
        {
            $brand_arr = [];
        }
        if(isset($request->cat_arr))
        {
            $cat_arr = $_REQUEST['cat_arr'];
            $cat_arr = explode(',',$cat_arr);
        }
        else
        {
            $cat_arr = [];
        }
        $products = productsDetails::
        select('prod_id','user_id','prod_image','prod_name','prod_image','prod_price',
           
        )
        ->when(Auth::check() ,function($q){
            $q->select('prod_id','user_id','prod_image','prod_name','prod_image','prod_price',
                DB::raw('IF((select count(*) from liked_products where user_id = '.Auth::user()->id.' 
                AND products_details.prod_id = liked_products.product_id )>0,"true","false") as isliked')
            );
        })
        ->when(count($brand_arr) > 0 && $request->brand_arr != 0, function($q) use($brand_arr){
            $q->whereIn('prod_brand_id',($brand_arr));
        } )
        ->when(count($cat_arr) > 0 && $request->cat_arr != 0, function($q) use($cat_arr){
            $q->whereIn('prod_category_id',($cat_arr));
        } )
        ->when($filter_id > 0 && $filter_id < 6, function($q) use($filters_arr, $filter_id){
            $q->where('prod_price','>',$filters_arr[$filter_id]['start'])
            ->where('prod_price','<=',$filters_arr[$filter_id]['end']);
        } )
        ->when($filter_id == 6, function($q) use($filters_arr, $filter_id){
            $q->where('prod_price','>',$filters_arr[$filter_id]['start']);
        })
        ->paginate(12);
        

        return view('user/pages/shop',['products'=>$products,'brands'=>$brands,'categories'=>$data,'msg'=>'brand']);
           
    }
    
    function display_product_detail()
    {
        $id = $_REQUEST['id'];
        $data = productsDetails::
        select('prod_id','user_id','prod_image','prod_name','prod_image','prod_price',
           
        )
        ->when(Auth::check() ,function($q){
            $q->select('prod_id','user_id','prod_image','prod_name','prod_image','prod_price',
                DB::raw('IF((select count(*) from liked_products where user_id = '.Auth::user()->id.' AND products_details.prod_id = liked_products.product_id )>0,"true","false") as isliked')
            );
        })
        ->where('prod_id','!=',$id)->get();

        return view('user/pages/product_detail',['data'=>$data]);
    }
    function product_details(Request $request)
    {
        $data = productsDetails::where('prod_id',$request->id)->get();
        
        return json_encode(['data'=>$data]) ;
    }
    function user_registration(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required|unique:ajax_data|email|regex:/(.+)@(.+)\.(.+)/i',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'pass' => 'required',
            'cpass' => 'required|same:pass'
        ]);

        if($validator->fails())
        {
            return json_encode(['status'=>false,'errors'=>$validator->errors()]);
        }

        $pass = $request->password;
        $password = Hash::make($pass);

        $user = UserTable::create([
            'email'=> $request->email,
            'phone'=> $request->phone,
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'password'=>$password
        ]);
        Auth::login($user);

        return json_encode(['status'=>true]);
    }
    function user_login(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email-l' => 'required',
            'password-l' => 'required',
        ]);

        if($validator->fails())
        {
            return json_encode(['status'=>false,'errors'=>$validator->errors()]);
        }

        $credentials = [
            'email' => $request['email-l'],
            'password' => $request['password-l'],
        ];
        // $email=$_REQUEST['email-l'];
        // $name = UserTable::where('email',$email)->get('firstname');


        if (Auth::attempt($credentials)) {

            return json_encode(['status'=>true]);
        }
        else
        {
            return json_encode(['status'=>false,'errors'=>['wrongpass'=>'Invalid Credentials']]);
        } 
    }
    
    function user_logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('user/pages/index');
    }
    function display_cart()
    {
        return view('user/pages/cart');
    }
    function cart_details(Request $request)
    {
        $id_arr = $request->data;
        $id_arr = json_decode($id_arr);
        $products = productsDetails::whereIn('prod_id',$id_arr)->get();

        return json_encode(['data'=>$products,'array'=>$id_arr]);
    }
    function cart_products(Request $request)
    {
        $id_arr = $request->id_array;
        $id_arr = json_decode($id_arr);

        $products = productsDetails::whereIn('prod_id',$id_arr)->get();
        return json_encode(['products'=>$products]);


    }
    
}
