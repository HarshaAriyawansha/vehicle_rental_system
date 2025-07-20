<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;

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
        $vehicle = Vehicle::orderBy('vehicle.id', 'asc')
        ->where('vehicle.status', '1')
        ->select('vehicle.*', 'brands.brand_name', 'models.model_name')
        ->leftJoin('brands', 'brands.id', '=', 'vehicle.brand_id')
        ->leftJoin('models', 'models.id', '=', 'vehicle.model_id') 
        ->get();

        $brands = Brand::orderBy('id', 'asc')->where('status','1')->get();
        return view('Vehicle.vehicle',compact('vehicle','brands'));
    }

    //insert data
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'brand' => 'required|exists:brands,id',
            'model' => 'required|exists:models,id',
            'vehicle_num' => 'required|string|max:20|unique:vehicle,vehicle_num',
            'price_per_km' => 'required|numeric|min:0',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric,Hybrid',
            'model_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'seating_capacity' => 'required|integer|min:1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $imagePath = null;
        if ($request->hasFile('vehicle_image')) {
            $imagePath = $request->file('vehicle_image')->store('vehicle_images', 'public');
        }

        $vehicle = new Vehicle;
        $vehicle->brand_id = $request->brand;
        $vehicle->model_id = $request->model;
        $vehicle->vehicle_num = $request->vehicle_num;
        $vehicle->price_per_km = $request->price_per_km;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->model_year = $request->model_year;
        $vehicle->seating_capacity = $request->seating_capacity;
        $vehicle->air_conditioner = $request->air_conditioner ? 1 : 0;
        $vehicle->air_bags = $request->air_bags ? 1 : 0;
        $vehicle->antilock_braking_system = $request->antilock_braking_system ? 1 : 0;
        $vehicle->power_windows = $request->power_windows ? 1 : 0;
        $vehicle->cd_player = $request->cd_player ? 1 : 0;
        $vehicle->car_availability = $request->car_availability ? 1 : 0;
        // $vehicle->image_path = $imagePath;
        $vehicle->status = '1';
        $vehicle->created_at = now();
        $vehicle->created_by = Auth::id();
        
        $vehicle->save();

        return response()->json(['success' => 'Vehicle added successfully.']);
    }
    
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = DB::table('vehicle')
            ->leftJoin('models', 'models.id', '=', 'vehicle.model_id')
            ->select('vehicle.*', 'models.model_name') // select required fields
            ->where('vehicle.id', $id)
            ->first(); 
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->hidden_id; 
        $rules = array(
            'brand' => 'required|exists:brands,id',
            'model' => 'required|exists:models,id',
            'vehicle_num' => 'required|string|max:20|unique:vehicle,vehicle_num,' . $id,
            'price_per_km' => 'required|numeric|min:0',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric,Hybrid',
            'model_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'seating_capacity' => 'required|integer|min:1',
        );


        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'brand_id' => $request->brand,
            'model_id' => $request->model,
            'vehicle_num' => $request->vehicle_num,
            'price_per_km'=>$request->price_per_km,
            'fuel_type'=>$request->fuel_type,
            'model_year'=>$request->model_year,
            'seating_capacity'=>$request->seating_capacity,
            'air_conditioner'=>$request->air_conditioner ? 1 : 0,
            'air_bags'=>$request->air_bags ? 1 : 0,
            'antilock_braking_system'=>$request->antilock_braking_system ? 1 : 0,
            'power_windows'=>$request->power_windows ? 1 : 0,
            'cd_player'=>$request->cd_player ? 1 : 0,
            'car_availability'=>$request->car_availability ? 1 : 0,
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
            return response()->json(['error' => 'Failed to delete vehicle: ' . $e->getMessage()], 500);
        }
    }

    public function vehicle_model_list_sel2(Request $request){
        if ($request->ajax())
        {
            $page = $request->input('page');
            $vehicle_brand = $request->input('vehicle_brand');
            $resultCount = 25;
        
            $offset = ($page - 1) * $resultCount;

            $breeds = VehicleModel::where('model_name', 'LIKE', '%' . $request->input('term') . '%')
                ->where('brand_id', $vehicle_brand)
                ->orderBy('model_name')
                ->skip($offset)
                ->take($resultCount)
                ->get([DB::raw('id as id'),DB::raw('model_name as text')]);

            $count = VehicleModel::where('brand_id', $vehicle_brand)->count();
            $endCount = $offset + $resultCount;
            $morePages = $endCount < $count;

            $results = array(
                "results" => $breeds,
                "pagination" => array(
                    "more" => $morePages
                )
            );

            return response()->json($results);
        }
    }
}
