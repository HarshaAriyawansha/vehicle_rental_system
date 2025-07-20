<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Gate;

class VehicleModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_model', ['only' => ['index']]);
        $this->middleware('permission:create_model', ['only' => ['create','store']]);
        $this->middleware('permission:update_model', ['only' => ['update','edit']]);
        $this->middleware('permission:delete_model', ['only' => ['destroy']]);
    }

    public function index()
    {
        $brands = Brand::orderBy('id', 'asc')->where('status','1')->get();
        $models = VehicleModel::orderBy('models.id', 'asc')
        ->select('models.*','brands.brand_name')
        ->where('models.status','1')
        ->leftjoin('brands','brands.id','=','models.brand_id')
        ->get();

        return view('Vehicle.vehicle_model',compact('brands','models'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'brand' => 'required',
            'model_name' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $model = new VehicleModel();
        $model->brand_id = $request->input('brand');
        $model->model_name = $request->input('model_name');
        $model->status = '1';
        $model->created_at = now();
        $model->created_by = Auth::id();
        $model->save();

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = VehicleModel::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'brand' => 'required',
            'model_name' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'model_name' => $request->model_name,
            'brand_id' => $request->brand,
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        );
        VehicleModel::where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Vehicle Model is successfully updated']);
    }

    public function delete(Request $request)
    {
        $recordID=$request->input('recordID');

        $model = VehicleModel::find($recordID);
        $model->update([
            'status' => 3,
            'updated_at' => now()
        ]);

        return response()->json(['success' => 'The Record Successfuly Deleted']);
    }

    public function get_model_by_brand($id)
    {
        if (request()->ajax()) {
            $models = VehicleModel::where('brand_id', $id)->where('status','=','1')->get();
           return response()->json([
                'result' => $models,
                'can_edit' => Gate::allows('update_model'),
                'can_delete' => Gate::allows('delete_model')
            ]);
        }
    }
}
