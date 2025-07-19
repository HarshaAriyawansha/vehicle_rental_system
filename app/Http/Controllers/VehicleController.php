<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_vehicle', ['only' => ['index']]);
        $this->middleware('permission:create_vehicle', ['only' => ['create','store']]);
        $this->middleware('permission:update_vehicle', ['only' => ['update','edit']]);
        $this->middleware('permission:delete_vehicle', ['only' => ['destroy']]);
    }

    //show database in data table
    public function index()
    {
        $vehicle = Vehicle::orderBy('id', 'asc')->where('status','1')->get();

        return view('Vehicle.vehicle',compact('vehicle'));
    }

    //insert data
    public function store(Request $request)
    {
        $vehicle = new vehicle;
                  //db                   //form
        $vehicle->vehicle_name=$request->vehicle_name;
        $vehicle->vehicle_num=$request->vehicle_num;
        $vehicle->price_per_km=$request->price_per_km;
        $vehicle->fuel_type=$request->fuel_type;
        $vehicle->model_year=$request->model_year;
        $vehicle->seating_capacity=$request->seating_capacity;
        $vehicle->air_conditioner=$request->air_conditioner;
        $vehicle->air_bags=$request->air_bags;
        $vehicle->antilock_braking_system=$request->antilock_braking_system;
        $vehicle->power_windows=$request->power_windows;
        $vehicle->cd_player=$request->cd_player;
        $vehicle->car_availability=$request->car_availability;
        $vehicle->status='1';
        $vehicle->created_at=now();
        $vehicle->created_by=Auth::id();
        
        $vehicle->save();

        return response()->json(['success' => 'Data Added successfully.']);



        /*
        $rules = array(
            'vehicle_name' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }*/
    }
    
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Vehicle::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
       
        $rules = array(
            'vehicle_name' => 'required',
        );


        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'vehicle_name' => $request->vehicle_name,
            'vehicle_num' => $request->vehicle_num,
            'price_per_km'=>$request->price_per_km,
            'fuel_type'=>$request->fuel_type,
            'model_year'=>$request->model_year,
            'seating_capacity'=>$request->seating_capacity,
            'air_conditioner'=>$request->air_conditioner,
            'air_bags'=>$request->air_bags,
            'antilock_braking_system'=>$request->antilock_braking_system,
            'power_windows'=>$request->power_windows,
            'cd_player'=>$request->cd_player,
            'car_availability'=>$request->car_availability,
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        );
        Vehicle::where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Vehicle is successfully updated']);
    }

    //delete 
    public function delete(Request $request)
    {
        $recordID=$request->input('recordID');

       try {
            $vehicle = Vehicle::find($recordID);
            if ($vehicle) {
                $vehicle->update([
                    'status' => 3,
                    'updated_at' => now(),
                    'updated_by' => Auth::id()
                ]);
                return response()->json(['success' => 'The Record Successfully Deleted']);
            } else {
                return response()->json(['error' => 'Vehicle not found'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Vehicle deletion failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete vehicle: ' . $e->getMessage()], 500);
        }
    }
}
