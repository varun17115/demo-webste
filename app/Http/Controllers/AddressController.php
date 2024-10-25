<?php

namespace App\Http\Controllers;

use App\Models\AddressDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    function save_address(Request $request)
    {
        if($request->update)
        {
            $validator = Validator::make($request->all(), [
                    'address' => 'required',
                    'country' => 'required|not_in:"Select A Country"',
                    'state' => 'required',
                    'city' => 'required',
                    'zip_code' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()]);
                }
                $address = AddressDetails::find($request->id);
                $address->address = $request->address;
                $address->city = $request->city;
                $address->state = $request->state;
                $address->zip_code = $request->zip_code;
                $address->country = $request->country;
                $address->save();
                return response()->json(['success'=>'Address Updated Successfully']);
        }
        else
        {
            $validator = Validator::make($request->all() , [
                'address' => 'required',
                'country' => 'required|not_in:"Select A Country"',
                'state' => 'required',
                'city' => 'required',
                'zip_code' => 'required',
            ]);
    
            if($validator->fails())
            {
                return json_encode(['status'=>false,'errors'=>$validator->errors()]);
            };
    
    
            $data = $request->all();
            $address = new AddressDetails();
            $address->address = $data['address'];
            $address->country = $data['country'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->zip_code = $data['zip_code'];
            $address->user_id = Auth::user()->id;
            $address->save();
    
            $data = AddressDetails::where('user_id',Auth::user()->id)->get();
            return json_encode(['data'=>$data]);

        }

    }
    function fetch_old_address(Request $request)
    {
        $data = AddressDetails::where('user_id',Auth::user()->id)->get();
        return json_encode(['data'=>$data]);
    }
    function delete_address(Request $request)
    {
        $address = AddressDetails::find($request->id);
        $address->delete();
        return json_encode(['status'=>true]);
    }
    function manage_address(){
        return view('user/pages/manage_address');
    }

    function get_address(){
        $data = AddressDetails::where('user_id',Auth::user()->id)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" onclick="edit_address('.$row->address_id.')" class="edit btn btn-success rounded-pill"><span class="mdi mdi-pencil"></span></a> <a href="javascript:void(0)" onclick="delete_address('.$row->address_id.')" class="delete btn btn-danger rounded-pill">
                <span class="mdi mdi-delete"></span></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    function edit_address(Request $request){
        $data = AddressDetails::where('address_id',$request->id)->get();
        return json_encode($data);
    }

}
