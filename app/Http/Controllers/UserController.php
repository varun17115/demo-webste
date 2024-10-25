<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTable;

use App\Models\userImages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    function display_table()
    {
        return view('admin/pages/manage_users');
    }
    function manage_operations(Request $request)
    {
        $data = UserTable::get()
        ->where('id','!=',Auth::user()->id);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" onclick="edit_data(' . $row->id . ')" class="edit btn btn-success btn-m"><span class="mdi fs-6 mdi-pencil"></span></a> <a href="javascript:void(0)" onclick="delete_data(' . $row->id . ')" class="delete btn btn-danger btn-m">
            <span class="fs-6 mdi mdi-delete"></span></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    function delete_rec(Request $request)
    {

        $recordid = $_REQUEST['id'];
        UserTable::where('id', $recordid)->delete();


        return json_encode(['status' => true]);
    }
    function edit_rec()
    {
        $recordid = $_REQUEST['id'];

        $data = UserTable::select('id', 'firstname', 'lastname', 'email', 'phone', 'image')->where('id', $recordid)->get();

        return json_encode(['data' => $data, 'status' => true]);
    }
    function show_edit_page()
    {
        return view('admin/pages/edit_rec');
    }

    function update_rec(Request $request)
    {

        if ($request->has('password')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
            // echo "YES";
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
            // echo "NO";

        }
        if ($validator->fails()) {
            return json_encode(['status' => false, 'errors' => $validator->errors()]);
        }


        $id = $request->only('id')['id'];
        $firstname = $request->only('firstname')['firstname'];
        $lastname = $request->only('lastname')['lastname'];
        $email = $request->only('email')['email'];
        $phone = $request->only('phone')['phone'];


        if ($request->has('update')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
        } else if ($request->has('image_name')) {
            $image = $request->image_name;
        } else {
            $image = null;
        }


        // return json_encode(['status' => $image]);

        // exit;

        if ($request->has('password')) {
            $pass = $request->password;
            $password = Hash::make($pass);

            db::table('ajax_data')->where('id', $id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'image' => $image, 'password' => $password]);
        } else {
            db::table('ajax_data')->where('id', $id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'image' => $image]);
        }

        return json_encode(['status' => $image]);
    }

    function add_new_user(Request $request)
    {

        $id = Auth::user()->id;


        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'password_confirmation' => 'required|same:password'
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



        return json_encode(['status' => true]);
    }
}
