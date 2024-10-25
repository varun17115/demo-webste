<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware;



Route::get('/', [\App\Http\Controllers\ShopController::class, 'show_page'])->name('display_main');


Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => ['guest']], function () {
    // Log Controller ----------------------------------------------------

        Route::get('pages/login', [\App\Http\Controllers\LogController::class, 'show_login_page'])->name('login');
        Route::post('pages/login', [\App\Http\Controllers\LogController::class, 'login_user'])->name('login.login');
        Route::get('pages/register', [\App\Http\Controllers\LogController::class, 'show_register_page'])->name('register.show');
        Route::post('pages/register_admin', [\App\Http\Controllers\LogController::class, 'register_user'])->name('register.post');
        Route::get('pages/login/ajax', [\App\Http\Controllers\LogController::class, 'login_thru_ajax'])->name('login_ajax');


    });

    Route::group(['middleware' => ['auth']], function () {

        
        Route::get('/', [\App\Http\Controllers\LogController::class, 'dashboard'])->name('welcome');

    // Log Controller ----------------------------------------------------


        Route::get('pages/logout', [\App\Http\Controllers\LogController::class, 'logout_user'])->name('logout.logout');

    // User Controller ----------------------------------------------------
        Route::post('pages/add_user', [\App\Http\Controllers\UserController::class, 'add_new_user'])->name('create_user');
        Route::get('/pages/manage_users', [\App\Http\Controllers\UserController::class, 'display_table'])->name('show');
        Route::post('/pages/manage_users', [\App\Http\Controllers\UserController::class, 'manage_operations'])->name('manage_users');
        Route::get('pages/edit_rec', [\App\Http\Controllers\UserController::class, 'show_edit_page'])->name('user');
        Route::post('pages/edit_rec', [\App\Http\Controllers\UserController::class, 'edit_rec'])->name('edit_records');
        Route::get('pages/delete_rec', [\App\Http\Controllers\UserController::class, 'delete_rec'])->name('delete_records');
        Route::post('pages/update_rec', [\App\Http\Controllers\UserController::class, 'update_rec'])->name('update_records');
        

    // Image Controller ----------------------------------------------------
        Route::post('ajax/user_gallery/upload', [\App\Http\Controllers\ImageController::class, 'add_images'])->name('add_images');
        Route::post('ajax/user_gallery/get', [\App\Http\Controllers\ImageController::class, 'show_images'])->name('all_images_get');
        Route::post('ajax/user_gallery/delete', [\App\Http\Controllers\ImageController::class, 'delete_image'])->name('delete_image');
        Route::post('ajax/user_gallery/edit_title', [\App\Http\Controllers\ImageController::class, 'show_edit_title'])->name('show_edit_title');
        Route::post('ajax/user_gallery/update_title', [\App\Http\Controllers\ImageController::class, 'update_title'])->name('update_title');
        Route::post('ajax/user_gallery/generate_pdf', [\App\Http\Controllers\ImageController::class, 'generatePDF'])->name('generate_pdf');
        Route::get('pages/user_gallery', [\App\Http\Controllers\ImageController::class, 'show_gallery'])->name('show_gallery');
        Route::get('pages/myPDF', [\App\Http\Controllers\ImageController::class, 'show_pdf'])->name('pdf_show');
        Route::post('pages/myPDF', [\App\Http\Controllers\ImageController::class, 'get_data'])->name('get_data');


    // Products Controller ----------------------------------------------------
        Route::get('pages/add_products', [\App\Http\Controllers\ProductsController::class, 'show_product_page'])->name('display_product_page');
        Route::post('ajax/get_products', [\App\Http\Controllers\ProductsController::class, 'get_products'])->name('get_products');
        Route::post('ajax/add_new_product', [\App\Http\Controllers\ProductsController::class, 'add_new_product'])->name('add_new_product');
        Route::post('ajax/edit_product', [\App\Http\Controllers\ProductsController::class, 'edit_product'])->name('get_product_data');
        Route::post('ajax/update_product', [\App\Http\Controllers\ProductsController::class, 'update_product'])->name('update_product');
        Route::post('ajax/delete_product', [\App\Http\Controllers\ProductsController::class, 'delete_product'])->name('delete_product');
        Route::post('ajax/feature_image', [\App\Http\Controllers\ProductsController::class, 'feature_image'])->name('feature_image');
        Route::post('ajax/get_categories', [\App\Http\Controllers\ProductsController::class, 'get_categories'])->name('get_categories');

    // Category Controller ----------------------------------------------------
        Route::get('pages/add_category', [\App\Http\Controllers\CategoryController::class, 'display_page'])->name('display_categories_page');
        Route::post('ajax/get_cat_data', [\App\Http\Controllers\CategoryController::class, 'get_categories'])->name('get_cat_data');
        Route::post('ajax/add_category', [\App\Http\Controllers\CategoryController::class, 'add_category'])->name('add_category');
        Route::post('ajax/edit_category', [\App\Http\Controllers\CategoryController::class, 'edit_category'])->name('edit_category');
        Route::post('ajax/delete_category', [\App\Http\Controllers\CategoryController::class, 'delete_category'])->name('delete_category');

    // Brand Controller ----------------------------------------------------
        Route::get('pages/add_brand', [\App\Http\Controllers\BrandController::class, 'display_page'])->name('display_brand_page');
        Route::post('ajax/get_brand_data', [\App\Http\Controllers\BrandController::class, 'get_brands'])->name('get_brand_data');
        Route::post('ajax/add_brand', [\App\Http\Controllers\BrandController::class, 'add_brand'])->name('add_brand');
        Route::post('ajax/edit_brand', [\App\Http\Controllers\BrandController::class, 'edit_brand'])->name('edit_brand');
        Route::post('ajax/delete_brand', [\App\Http\Controllers\BrandController::class, 'delete_brand'])->name('delete_brand');
        
    // Shop Controller ----------------------------------------------------
        Route::get('pages/user_feedback', [\App\Http\Controllers\ShopController::class, 'show_feedbacks'])->name('display_feedbacks');
        Route::post('pages/get_feedback_data', [\App\Http\Controllers\ShopController::class, 'get_feedback_data'])->name('get_feedback_data');

    //Demo 
        Route::get('pages/demo', [\App\Http\Controllers\BrandController::class, 'demo'])->name('demo');


    // Order Controller ----------------------------------------------------
        Route::get('pages/get_orders', [\App\Http\Controllers\OrderController::class, 'display_orders'])->name('display_orders');
        Route::post('pages/get_orders', [\App\Http\Controllers\OrderController::class, 'show_orders'])->name('show_orders');

    // Shop Settings Controller ----------------------------------------------------
        Route::get('pages/shop_settings', [\App\Http\Controllers\settingController::class, 'display_settings'])->name('display_settings');
        Route::post('ajax/get_settings', [\App\Http\Controllers\settingController::class, 'save_settings'])->name('save_settings');
        Route::post('ajax/return_settings', [\App\Http\Controllers\settingController::class, 'return_settings'])->name('return_settings');
    
    });
});
Route::group(['prefix' => 'user'], function () {

    // shop Controller -----------------------------------------
        Route::get('pages/index', [\App\Http\Controllers\ShopController::class, 'show_page'])->name('display_main');
        Route::post('ajax/user_fetch_cat', [\App\Http\Controllers\ShopController::class, 'fetch_categories'])->name('user_get_data');
        Route::get('pages/contact', [\App\Http\Controllers\ShopController::class, 'show_contact'])->name('contact_us');
        Route::post('ajax/get_feedback', [\App\Http\Controllers\ShopController::class, 'get_feedback'])->name('get_feedback');
        Route::get('pages/shop', [\App\Http\Controllers\ShopController::class, 'show_shop'])->name('display_shop');
        Route::get('pages/product_detail', [\App\Http\Controllers\ShopController::class, 'display_product_detail'])->name('show_product');
        Route::post('ajax/get_product_data', [\App\Http\Controllers\ShopController::class, 'product_details'])->name('get_product_detail');
        Route::post('ajax/filter_data', [\App\Http\Controllers\ShopController::class, 'filter_data'])->name('filter_data');
        Route::post('user/register_user', [\App\Http\Controllers\ShopController::class, 'user_registration'])->name('register_user');
        Route::post('user/login_user', [\App\Http\Controllers\ShopController::class, 'user_login'])->name('login_user');
        Route::get('logout_user', [\App\Http\Controllers\ShopController::class, 'user_logout'])->name('logout_user');
        Route::get('pages/cart', [\App\Http\Controllers\ShopController::class, 'display_cart'])->name('display_cart');
        Route::post('user/cart_details', [\App\Http\Controllers\ShopController::class, 'cart_details'])->name('cart_details');
        Route::post('user/get_cart_products', [\App\Http\Controllers\ShopController::class, 'cart_products'])->name('fetch_cart_products');

    // Order Controller ----------------------------------------------------
        Route::get('pages/checkout', [\App\Http\Controllers\OrderController::class, 'display_checkout'])->name('display_checkout');
        Route::post('user/Place_order', [\App\Http\Controllers\OrderController::class, 'place_order'])->name('place_order');
        Route::post('user/Update_Status', [\App\Http\Controllers\OrderController::class, 'update_status'])->name('update_status');
        Route::get('pages/order_success/', [\App\Http\Controllers\OrderController::class, 'order_success'])->name('order_success');
        Route::get('pages/track_order', [\App\Http\Controllers\OrderController::class, 'track_order'])->name('show_order');
        Route::post('ajax/get_order_data', [\App\Http\Controllers\OrderController::class, 'get_order_data'])->name('get_order_data');
        Route::post('ajax/cancel_order', [\App\Http\Controllers\OrderController::class, 'cancel_order'])->name('cancel_order');
        
        Route::post('ajax/generate_bill', [\App\Http\Controllers\OrderController::class, 'generate_bill'])->name('generate_bill');
        Route::get('pages/bill/{id}', [\App\Http\Controllers\OrderController::class, 'show_invoice'])->name('show_invoice');
        Route::post('ajax/reorder_order', [\App\Http\Controllers\OrderController::class, 'reorder'])->name('reorder');


    // Address Controller ----------------------------------------------------
    
        Route::post('user/fetch_old_address', [\App\Http\Controllers\AddressController::class, 'fetch_old_address'])->name('fetch_old_address');
        Route::post('user/save_address', [\App\Http\Controllers\AddressController::class, 'save_address'])->name('save_address');
        Route::get('pages/manage_address/', [\App\Http\Controllers\AddressController::class, 'manage_address'])->name('manage_address');
        Route::post('ajax/get_user_address', [\App\Http\Controllers\AddressController::class, 'get_address'])->name('get_address');
        Route::post('ajax/edit_address', [\App\Http\Controllers\AddressController::class, 'edit_address'])->name('edit_address');
        Route::post('ajax/delete_address', [\App\Http\Controllers\AddressController::class, 'delete_address'])->name('delete_address');
        
    
    // Favourite Items Controller ----------------------------------------------------
    
        Route::post('ajax/like_product', [\App\Http\Controllers\favouriteItemsController::class, 'like_product'])->name('like_product');
        Route::get('pages/liked_items', [\App\Http\Controllers\favouriteItemsController::class, 'show_likes_page'])->name('show_likes_page');
        Route::post('ajax/remove_liked', [\App\Http\Controllers\favouriteItemsController::class, 'remove_liked'])->name('remove_liked');
    
    
    // Site Settings Controller ----------------------------------------------------
        
        Route::post('ajax/get_return_settings', [\App\Http\Controllers\settingController::class, 'footer_details'])->name('footer_details');

});



Route::group(['prefix' => 'theme'], function () {

    Route::get('pages/manage_users', [\App\Http\Controllers\ThemeController::class, 'theme_manage_users'])->name('theme_manage_users');
    Route::get('pages/edit_profile', [\App\Http\Controllers\ThemeController::class, 'theme_edit_profile'])->name('theme_edit_profile');
    Route::get('pages/user_gallery', [\App\Http\Controllers\ThemeController::class, 'theme_user_gallery'])->name('theme_user_gallery');
    Route::get('pages/add_products', [\App\Http\Controllers\ThemeController::class, 'theme_manage_products'])->name('theme_manage_products');
    Route::get('pages/add_category', [\App\Http\Controllers\ThemeController::class, 'theme_manage_category'])->name('theme_manage_category');
    Route::get('pages/add_brands', [\App\Http\Controllers\ThemeController::class, 'theme_manage_brands'])->name('theme_manage_brands');
    Route::get('pages/user_feedbacks', [\App\Http\Controllers\ThemeController::class, 'theme_user_feedbacks'])->name('theme_user_feedbacks');
    Route::get('pages/order_details', [\App\Http\Controllers\ThemeController::class, 'theme_current_orders'])->name('theme_current_orders');
    Route::get('pages/shop_settings', [\App\Http\Controllers\ThemeController::class, 'theme_shop_settings'])->name('theme_shop_settings');

});
