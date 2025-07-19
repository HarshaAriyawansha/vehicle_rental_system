<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_booking', ['only' => ['index']]);
        $this->middleware('permission:create_booking', ['only' => ['create','store']]);
        $this->middleware('permission:update_booking', ['only' => ['update','edit']]);
        $this->middleware('permission:delete_booking', ['only' => ['destroy']]);
    }
    
    //view database
    public function index()
    {
        $booking = Booking::orderBy('id', 'asc')->where('status','1')->get();

        return view('Booking.booking',compact('booking'));
    }

    public function store(Request $request)
    {
        $booking = new booking;
                  //db                   //form
        $booking->customer_name=$request->customer_name;
        $booking->customer_lno=$request->customer_lno;
        $booking->vehicle_num=$request->vehicle_num;
        $booking->mileage=$request->mileage;
        $booking->book_date=$request->book_date;
        $booking->message=$request->message;
        $booking->status='1';
        $booking->created_at=now();
        $booking->created_by=Auth::id();
        
        $booking->save();

        return response()->json(['success' => 'Data Added successfully.']);
    }
/*
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Booking::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'user_email' => 'required',
            'vehicle_num' => 'required',
            'from_date' => 'required',
            'to_date ' => 'required',                                       
            'message' => 'required',
            'charge_type' => 'required',
            'distance' => 'required',
            'no_of_date' => 'required',
            'advance ' => 'required',                                       
            'additinal' => 'required',
            'total_amount' => 'required',
            'booking_date' => 'required',
            'return_date' => 'required',                                     
            'user_driver_num' => 'required',
            'booking_type' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'user_email' => $request->user_email,
            'vehicle_num' => $request->vehicle_num,
            'from_date' => $request->from_date,
            'to_date ' => $request->to_date,                                       
            'message' => $request->message,
            'charge_type' => $request->charge_type,
            'distance' => $request->distance,
            'no_of_date' => $request->no_of_date,
            'advance ' => $request->advance,                                       
            'additinal' => $request->additinal,
            'total_amount' => $request->total_amount,
            'booking_date' => $request->booking_date,
            'return_date' => $request->return_date,                                     
            'user_driver_num' => $request->user_driver_num,
            'booking_type' => $request->booking_type,
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        );
        Booking::where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Booking is successfully updated']);
    }
*/
    public function delete(Request $request)
    {
        $recordID=$request->input('recordID');

       try {
            $booking = Booking::find($recordID);
            if ($booking) {
                $booking->update([
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
