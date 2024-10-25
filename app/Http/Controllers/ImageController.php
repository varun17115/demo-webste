<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserImages;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ImageController extends Controller
{
    function show_gallery()
    {
        return view('admin/pages/user_gallery');
    }
    function add_images(Request $request)
    {
        $arr = array();
        $image_id = array();
        
        for ($i=0; $i < count($request->images) ; $i++) { 
            $image = '';
            $image = time().$i.'.'.$request->images[$i]->extension();
            $request->images[$i]->move(public_path('user_image'), $image);
            sleep(1);
            array_push($arr,$image);
            $id = UserImages::create([
                'user_id'=>$request->id,
                'image'=>$image
            ])->id;
            array_push($image_id,$id);
        }
        return json_encode(['images'=>$arr,'id'=>$image_id]);

    }
    function show_images()
    {
        $data = UserImages::select('id','user_id','image','title','description')->where('user_id',Auth::user()->id)->get();
        return json_encode(['images'=>$data]);
    }
    function delete_image(Request $request)
    {
        $id = $request->id;
        $image_name = UserImages::select('image')->where('id',$id)->get();
        // print(url('user_image').'/'.$image_name[0]->image);
        File::delete((public_path('user_image').'/'.$image_name[0]->image));
        // unlink(url('user_image/').$image_name);
        UserImages::where('id',$id)->delete();

        return json_encode(['status'=>true]);
    }
    function show_edit_title(Request $request)
    {
        $id = $request->id;
        $data = UserImages::select('id','title','description')->where('id',$id)->get();
        return json_encode(['data'=>$data]);

    }
    function update_title(Request $request)
    {
        $title = $request->title;
        $id = $request->id;
        $description = $request->description;

        UserImages::where('id',$id)->update(['title'=>$title,'description'=>$description]);

        return json_encode(['status'=>true]);
    }
    function generatePDF(Request $request)
    {
        $id = $request->id;
        $data = UserImages::select('image','title','description','created_at')->where('user_id',$id)->get();
        $pdf = PDF::loadView('admin/pages/myPDF',['data'=>$data]);


        $fileName = 'pdfview.pdf' ;
        $pdf->save(public_path() . '/' . $fileName);

        $pdf = public_path($fileName);

        return response()->download($pdf);
        
    }
    function show_pdf()
    {
        $data = UserImages::select('image','title','description','created_at')->where('user_id',Auth::user()->id)->get();
        return view('admin/pages/myPDF',['data'=>$data]);
    }
    function get_data()
    {
        $data = UserImages::select('image','title','description','created_at')->where('user_id',Auth::user()->id)->get();
        return json_encode(['data'=>$data]);
    }
}
