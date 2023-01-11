<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function getData(Request $request){
        $data ="this is my data";
        return view('index',['key'=>$data]);

    }


    public function getAllDepartment(Request $request){

    $departments = Department::all();
    return view('index',['departments'=>$departments]);

    }

    public function showappointment(Request $request){

    $department_id= $request->input('department_id');
    $appointments= Appointment::where('department_id', $department_id)->get();
    return \view('appointments',['appointments'=>$appointments]);

    }


    public function bookappointment(Request $request ){

    $appointment_id=$request->input('appointment_id');
    $department_name=$request->input('department_name');
    $appointment_date=$request->input('appointment_date');
    $exists=Booking::where('appointment_id','=', $appointment_id)->exists();

if($exists){

    //tell user that it has been booked by someone else
    Session::flash('message','Appointment was already taken');
    Session::flash('alert-class','alert-danger');
    return redirect('/');
}else{
//book this appointment

$booking = new Booking;
$booking->appointment_id= $appointment_id;
$booking->department_name= $department_name;
$booking->appointment_date= $appointment_date;
$booking->username= Auth::user()->name;
$booking->user_id= Auth::user()->id;

$booking->save();

//chnage appointment status to 1 ->taken
Appointment::where('id',$appointment_id)->update(['taken'=>1]);


//tell user that appointment was booked
Session::flash('message','Appointment booked successully');
Session::flash('alert-class','alert-success');
return redirect('/');



}

    }

    public function mybookings(Request $request){
        $bookings = Booking::where('user_id',Auth::user()->id)->get();
        return \view('mybookings',['bookings'=>$bookings]);



    }
    public function cancelbooking(Request $request){

        $booking_id = $request->input('booking_id');
        $appointment_id = $request->input('appointment_id');
        Booking::where('id',$booking_id)->delete();
        Appointment::where('id',$appointment_id)->update(['taken'=>0]);
        Session::flash('message','Appointment canceled successully');
        Session::flash('alert-class','alert-success');


        return redirect('/');
    }
}
