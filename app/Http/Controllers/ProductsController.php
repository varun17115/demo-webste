<?php

namespace App\Http\Controllers;

use App\Models\BrandDetails;
use Illuminate\Http\Request;
use App\Models\categoryDetails;
use App\Models\productsDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use PhpParser\Node\Stmt\Else_;

class ProductsController extends Controller
{
    //
    function show_product_page()
    {
        return view('admin/pages/add_products');
    }
    function get_products()
    {
        $categories = categoryDetails::all();

        $data = productsDetails::select('prod_id','prod_brand_id','prod_name','prod_image','prod_description','prod_quantity','prod_price','prod_category_id','prod_feature_status')->where('user_id',Auth::user()->id)->get();

            return Datatables::of($data)
                ->editColumn('prod_image',function($row){
                    $image = '<img src="'.url("products").'/'.$row->prod_image.'" style="height:50px;width:50px;">';
                    return $image;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a style="line-height:1" href="javascript:void(0)" onclick="edit_data('.$row->prod_id.','.$row->prod_category_id.')" class="edit btn d-inline-block btn-success "><span class="mdi mdi-pencil"></span></a> <a style="line-height:1" href="javascript:void(0)" onclick="delete_data('.$row->prod_id.')" class="delete d-inline-block btn btn-danger ">
                    <span class="mdi mdi-delete"></span></a>';
                    return $actionBtn;
                })
                ->addColumn('feature', function($row){
                    if($row->prod_feature_status == 'true')
                    {
                        $featureBtn = '<input type="checkbox" onclick="feature_image('.$row->prod_id.',this)" checked class="checkbox form-check-input" >';
                    }
                    else
                    {
                        
                        $featureBtn = '<input type="checkbox" onclick="feature_image('.$row->prod_id.',this)" class="checkbox form-check-input" >';
                    }
                    return $featureBtn;
                })
                ->rawColumns(['action','prod_image','feature'])
                ->make(true);
                
    }
    function add_new_product(Request $request)
    {
        
        if($request->update)
        {
            $validator = Validator::make($request->all() , [
                'prod_name' => 'required',
                'prod_quantity' => 'required',
                'prod_price' => 'required',
                'prod_brand_id' =>'required',
                'prod_category_id' => 'required|not_in:Select a Option',
                'prod_description'=>'required',
    
            ]);
            
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors(),'update'=>true]);
            }
    
            if($request->image_change)
            {
                $image_name = productsDetails::select('prod_image')->where('prod_id',$request->prod_id)->get();
    
                $image = $request->prod_image->getClientOriginalName();
                $request->prod_image->move(public_path('products'), $image);
    
                File::delete((public_path('products').'/'.$image_name[0]->prod_image));
    
                productsDetails::where('prod_id',$request->prod_id)->update(['prod_name'=>$request->prod_name,'prod_description'=>$request->prod_description,'prod_image'=>$image,'prod_brand_id'=>$request->prod_brand_id,'prod_quantity'=>$request->prod_quantity,'prod_price'=>$request->prod_price,'prod_category_id'=>$request->prod_category_id]);
            }
            else
            {
                productsDetails::where('prod_id',$request->prod_id)->update(['prod_name'=>$request->prod_name,'prod_description'=>$request->prod_description,'prod_brand_id'=>$request->prod_brand_id,'prod_quantity'=>$request->prod_quantity,'prod_price'=>$request->prod_price,'prod_category_id'=>$request->prod_category_id]);
    
            }
                
            return json_encode(['status'=>true]);
        }
        else
        {
            $validator = Validator::make($request->all() , [
                'prod_name' => 'required',
                'prod_quantity' => 'required',
                'prod_price' => 'required',
                'prod_brand_id' =>'required',
                'prod_category_id' => 'required|not_in:Select a Option',
                'prod_description'=>'required',
                'prod_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    
            ]);
            
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors()]);
            }
    
            
            $image = time().$request->prod_image->getClientOriginalName();
            $request->prod_image->move(public_path('products'), $image);
    
    
            $prod_detail = productsDetails::create([
                'prod_name'=>$request->prod_name,
                'prod_description'=>$request->prod_description,
                'prod_brand_id'=>$request->prod_brand_id,
                'prod_quantity'=>$request->prod_quantity,
                'prod_price'=>$request->prod_price,
                'user_id'=>Auth::user()->id,
                'prod_category_id'=>$request->prod_category_id,
                'prod_image'=>$image,
            ]);
    
            return json_encode(['status'=>true]);
        }


        
    }
    function edit_product(Request $request)
    {
        $product_category = categoryDetails::select('cat_name')->where('cat_id',$request->cat_id)->get();

        $data = productsDetails::select('prod_id','prod_brand_id','prod_name','prod_image','prod_description','prod_quantity','prod_price','prod_category_id')->where('prod_id',$request->id)->get();

        return json_encode(['data'=>$data,'category'=>$product_category]);
    }
    
    function delete_product(Request $request )
    {
        $id = $request->id;
        $image_name = productsDetails::select('prod_image')->where('prod_id',$id)->get();
        File::delete((public_path('products').'/'.$image_name[0]->prod_image));
        productsDetails::where('prod_id',$id)->delete() ;

        return json_encode(['status'=>true]);
        
    }
    function get_categories()
    {
        $cat = categoryDetails::get();
        $brand = BrandDetails::get();
        return json_encode(['category'=>$cat,'brand'=>$brand]);
    }
    function feature_image(Request $request)
    {
        productsDetails::where('prod_id',$request->id)->update(['prod_feature_status'=>$request->status]);
        return json_encode(['status'=>$request->status]);
        
    }
}
