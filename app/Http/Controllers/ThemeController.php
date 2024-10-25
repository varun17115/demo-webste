<?php

namespace App\Http\Controllers;

use App\Models\shopSetting;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    function theme_manage_users()
    {
        return view('theme.pages.manage_users');

    }
    function theme_edit_profile()
    {
        return view('theme.pages.edit_rec');
    }
    function theme_user_gallery()
    {
        return view('theme.pages.user_gallery');
    }
    function theme_manage_products()
    {
        return view('theme.pages.add_products');
    }
    function theme_manage_category()
    {
        return view('theme.pages.add_category');
    }
    function theme_manage_brands()
    {
        return view('theme.pages.add_brands');
    }
    function theme_user_feedbacks()
    {
        return view('theme.pages.user_feedbacks');
    }
    function theme_current_orders()
    {
        return view('theme.pages.order_details');
    }
    function theme_shop_settings()
    {
        // shopSetting
        $my_arr = array();
        $settings = shopSetting::select('setting_key', 'setting_value')->get();
        for ($i = 0; $i < count($settings); $i++) {
            $my_arr[$settings[$i]['setting_key']] = $settings[$i]['setting_value'];
        }
        
        return view('theme/pages/shop_settings', ['data' => $my_arr]);
    }


}
