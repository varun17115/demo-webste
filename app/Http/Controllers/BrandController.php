<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryDetails;
use App\Models\productsDetails;
use App\Models\BrandDetails;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class BrandController extends Controller
{
    function display_page()
    {
        return view('admin/pages/add_brand');
    }
    function get_brands()
    {
        $data = BrandDetails::select('brand_id','brand_name','brand_image');
        
        return Datatables::of($data)
                ->editColumn('brand_image',function($row){
                    $image = '<img src="'.url("brand_image").'/'.$row->brand_image.'" style="height:50px;width:50px;">';
                    return $image;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" onclick="edit_brand('.$row->brand_id.')" style="line-height:1"  class="edit btn btn-success d-inline-block"><span class="mdi mdi-pencil"></span></a> <a href="javascript:void(0)" onclick="delete_brand('.$row->brand_id.')" style="line-height:1" class="delete btn btn-danger d-inline-block">
                    <span class="mdi mdi-delete"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','brand_image'])
                ->make(true);
    }
    function add_brand(Request $request )
    {
        if($request->update)
        {
            $validator = Validator::make($request->all() , [
                'brand_name' => 'required',
                'brand_description'=>'required',
                'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
    
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors()]);
    
            }

            if($request->image_change)
            {
                $image_name = BrandDetails::select('brand_image')->where('brand_id',$request->brand_id)->get();
    
                $image = $request->brand_image->getClientOriginalName();
                $request->brand_image->move(public_path('brand_image'), $image);
    
                File::delete((public_path('brand_image').'/'.$image_name[0]->brand_image));
    
                BrandDetails::where('brand_id',$request->brand_id)->update(['brand_name'=>$request->brand_name,'brand_description'=>$request->brand_description,
                'brand_image'=>$image]);
            }
            else
            {
                BrandDetails::where('brand_id',$request->brand_id)->update(['brand_name'=>$request->brand_name,'brand_description'=>$request->brand_description]);
            }

            return json_encode(['status'=>true]);


        }
        else
        {
            $validator = Validator::make($request->all() , [
                'brand_name' => 'required',
                'brand_description'=>'required',
                'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
    
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors()]);
    
            }
    
            $image = $request->brand_image->getClientOriginalName();
            $request->brand_image->move(public_path('brand_image'), $image);
    
            BrandDetails::create([
                'brand_name'=>$request->brand_name,
                'brand_description'=>$request->brand_description,
                'brand_image'=>$image
            ]);
    
            return json_encode(['status'=>true]);
        }
    }
    function edit_brand(Request $request)
    {
        $data = BrandDetails::select('brand_name','brand_description','brand_image')
        ->where('brand_id',$request->id)->get();

        return json_encode(['data'=>$data]);    
    }
    function delete_brand(Request $request)
    {
        $id = $request->id;
        $image_name = BrandDetails::select('brand_image')->where('brand_id',$id)->get();
        File::delete((public_path('brand_image').'/'.$image_name[0]->brand_image));
        BrandDetails::where('brand_id',$id)->delete() ;

        return json_encode(['status'=>true]);
        
    }
    function demo()
    {
        return view('admin/pages/demo');
    }
}
