<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        $vehicles =  Vehicle::orderBy('id', 'asc')
            ->select('vehicle.*','brands.brand_name','models.model_name')
            ->leftjoin('brands','brands.id','=','vehicle.brand_id')
            ->leftjoin('models','models.id','=','vehicle.model_id')
            ->where('vehicle.status','1')
            ->get();

        return view('Web.index',compact('vehicles'));
    }

    public function web_vehicle_detail($id){
        $vehicles =  Vehicle::orderBy('id', 'asc')
            ->select('vehicle.*','brands.brand_name','models.model_name')
            ->leftjoin('brands','brands.id','=','vehicle.brand_id')
            ->leftjoin('models','models.id','=','vehicle.model_id')
            ->where('vehicle.status','1')
            ->find($id);


        return view('Web.vehicle_detail',compact('vehicles'));
    }
}
