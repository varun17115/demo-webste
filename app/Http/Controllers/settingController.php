<?php

namespace App\Http\Controllers;

use App\Models\shopSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class settingController extends Controller
{
    function display_settings()
    {
        $my_arr = array();
        $settings = shopSetting::select('setting_key', 'setting_value')->get();
        for ($i = 0; $i < count($settings); $i++) {
            $my_arr[$settings[$i]['setting_key']] = $settings[$i]['setting_value'];
        }
        
        return view('admin/pages/shop_settings', ['data' => $my_arr]);
    }
    function save_settings(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'shop_name' => 'required',
            'shop_address' => 'required',
            'shop_phone' => 'required|digits:10|numeric',
            'shop_email' => 'required|email',
            'product_gst' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return json_encode(['status'=>false,'errors'=>$validator->errors()]);
        }
        
        $params = $request->only([
            'shop_name', 'shop_address', 'shop_phone',
            'shop_email', 'product_gst', 'twitter_link', 'facebook_link', 'linkedin_link', 'instagram_link'
        ]);
        foreach ($params as $key => $value) {
            
            $updated_setting =  shopSetting::where('setting_key',$key)
            ->update(['setting_value'=>$value])
            // ->get() 

            ;
        }
        return json_encode(['status'=>true,'message'=>'Settings Saved Successfully']);
    }
    function return_settings()
    {
        $settings = shopSetting::select('setting_key', 'setting_value')->get();
        return json_encode(['data' => $settings]);
    }
    function footer_details()
    {
        $my_arr = array();
        $settings = shopSetting::select('setting_key', 'setting_value')->get();
        for ($i = 0; $i < count($settings); $i++) {
            $my_arr[$settings[$i]['setting_key']] = $settings[$i]['setting_value'];
        }
        return json_encode(['data' => $my_arr]);
    }
}
