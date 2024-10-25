<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryDetails;
use App\Models\productsDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
    function display_page()
    {
        return view('admin/pages/add_category');
    }
    function get_categories()
    {
        $data = categoryDetails::select('cat_id','cat_name','cat_image');
        return DataTables::of($data)
                ->editColumn('cat_image',function($row){
                    $image = '<img src="'.url("category_image").'/'.$row->cat_image.'" style="height:50px;width:50px;">';
                    return $image;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" style="line-height:1" onclick="edit_cat('.$row->cat_id.')" class="edit d-inline-block btn  btn-success"><span class="mdi mdi-pencil"></span></a> <a href="javascript:void(0)" style="line-height:1" onclick="delete_cat('.$row->cat_id.')" class="delete d-inline-block btn  btn-danger"><span class="mdi mdi-delete"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','cat_image'])
                ->make(true);
    }
    function add_category(Request $request )
    {
        if($request->update)
        {
            $validator = Validator::make($request->all() , [
                'cat_name' => 'required',
                'cat_description'=>'required',
                'cat_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
    
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors()]);
            }

            if($request->image_change)
            {
                $image_name = categoryDetails::select('cat_image')->where('cat_id',$request->cat_id)->get();
    
                $image = $request->cat_image->getClientOriginalName();
                $request->cat_image->move(public_path('category_image'), $image);
    
                File::delete((public_path('category_image').'/'.$image_name[0]->cat_image));
    
                categoryDetails::where('cat_id',$request->cat_id)->update(['cat_name'=>$request->cat_name,'cat_description'=>$request->cat_description,
                'cat_image'=>$image]);
            }
            else
            {
                categoryDetails::where('cat_id',$request->cat_id)->update(['cat_name'=>$request->cat_name,'cat_description'=>$request->cat_description]);
            }

            return json_encode(['status'=>true]);


        }
        else
        {
            $validator = Validator::make($request->all() , [
                'cat_name' => 'required',
                'cat_description'=>'required',
                'cat_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
    
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors()]);
    
            }
    
            $image = $request->cat_image->getClientOriginalName();
            $request->cat_image->move(public_path('category_image'), $image);
    
            categoryDetails::create([
                'cat_name'=>$request->cat_name,
                'cat_description'=>$request->cat_description,
                'cat_image'=>$image
            ]);
    
            return json_encode(['status'=>true]);
        }
    }
    function edit_category(Request $request)
    {
        $data = categoryDetails::select('cat_name','cat_description','cat_image')
        ->where('cat_id',$request->id)->get();

        return json_encode(['data'=>$data]);    
    }
    function delete_category(Request $request)
    {
        $id = $request->id;
        $image_name = categoryDetails::select('cat_image')->where('cat_id',$id)->get();
        File::delete((public_path('category_image').'/'.$image_name[0]->cat_image));
        categoryDetails::where('cat_id',$id)->delete() ;

        return json_encode(['status'=>true]);
        
    }
}
