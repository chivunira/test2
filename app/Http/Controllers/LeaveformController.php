<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DB;
use App\Models\Leaves;
use App\Http\Controllers\Illuminate\Database\Query\Builder;
use App\Models\Leaveform;

class LeaveformController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index()
    {
        $leaves = Leaves::all('LeaveType');
        return view('leaveform', compact('leaves'));
    }

    public function store(Request $request)
    {
                //Declare two dates
                $start_date = strtotime($request->from_date);
                $end_date = strtotime($request->to_date);
                
                // Get the difference and divide into
                // total no. seconds 60/60/24 to get
                // number of days
                $dayss = intval(($end_date - $start_date)/60/60/24);


                //gets current date
                $date = date('Y-m-d');
                $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
                $next_date = date('Y-m-d', strtotime($date .' +1 day'));

                //condition to ensure user selects correct date
                if(($request->from_date)<$date || ($request->to_date)<$date || ($request->to_date)<($request->from_date)){
                    return back()->with('status', 'Please select valid dates');   
                }

                //Model::where('id', 1)->value('name');
                $leaveduration = Leaves::where('LeaveType', $request->leavetype)->value('Duration');

                
                    if($request->leavetype == "Maternity Leave"){
                        if($dayss>90){
                            return back()->with('status', 'You have exceeded your available leave days');
                        }
                    }
                    else if($request->leavetype == "Paternity Leave"){
                        if($dayss>15){
                            return back()->with('status', 'You have exceeded your available leave days');
                        }
                    }
                    else if($dayss>auth()->user()->av_days){
                            return back()->with('status', 'You have exceeded your available leave days');
                        }
                    else{
                        if($dayss>$leaveduration){
                            return back()->with('status', 'You have selected days exceeding the set maximum duration');
                        }
                    }

                    $nn = Leaveform::where('email',auth()->user()->email)->where("status","pending")->count();
                    if(auth()->user()->status=="active"){
                        if($nn>0){
                            return back()->with('status', 'You already have a pending leave request');
                        }
                    }
                    else{
                        return back()->with('status', 'You cannot apply for leave while on leave');
                    }

                //finds the difference between the users available days and the days he/she will be on leave
                $available_days = auth()->user()->av_days;
                $days_left = $available_days-$dayss;

                //updates users table
                // DB::table('users')
                //     ->where('email', auth()->user()->email)
                //     ->update(['av_days' => $days_left]);

                $adminResponse = "waiting for response";

        
        $this -> validate($request, [
            'email'=> 'required|max:255',
            'leavetype'=> 'required',
            'to_date'=> 'required|max:255',
            'from_date'=> 'required|max:255',
            'description'=> 'required|max:255',
            'status'=> 'required|max:255',
            'department'=> 'required|max:255',
            'adminRemarks' => 'nullable|max:255',

        ]);

        $request->user()->leaveform()->create(
            [
                'email' => $request -> email,
                'leavetype' => $request->leavetype,
                'to_date' => $request-> to_date,
                'from_date' => $request-> from_date,
                'description' => $request -> description,
                'status' => $request -> status,
                'department'=> $request->department,
                'adminRemarks'=> $adminResponse,
                'numDays'=>$dayss,
                
            ]
        );

        return redirect()->route('dashboard');
        
        
        
    }
}
