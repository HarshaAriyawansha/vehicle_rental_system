<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

class VehicleBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_brand', ['only' => ['index']]);
        $this->middleware('permission:create_brand', ['only' => ['create','store']]);
        $this->middleware('permission:update_brand', ['only' => ['update','edit']]);
        $this->middleware('permission:delete_brand', ['only' => ['destroy']]);
    }

    public function index()
    {
        $brand = Brand::orderBy('id', 'asc')->where('status','1')->get();

        return view('Vehicle.vehicle_brand',compact('brand'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'brand_name' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $brand = new Brand();
        $brand->brand_name = $request->input('brand_name');
        $brand->status = '1';
        $brand->created_at = now();
        $brand->created_by = Auth::id();
        $brand->save();

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Brand::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'brand_name' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'brand_name' => $request->brand_name,
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        );
        Brand::where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Brand is successfully updated']);
    }

    public function delete(Request $request)
    {
        $recordID=$request->input('recordID');

        $brand = Brand::find($recordID);
        $brand->update([
            'status' => 3,
            'updated_at' => now()
        ]);

        return response()->json(['success' => 'The Record Successfuly Deleted']);
    }
}
