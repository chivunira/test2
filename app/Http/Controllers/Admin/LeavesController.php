<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leaves;
use DB;

class LeavesController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index()
    {
        $leaves = DB::select('select * from leavetype ');
        return view('admin.leave.index', ['leaves'=>$leaves]);
    }
    public function create(){
        return view('admin.leave.create');
    }

    public function store(Request $request)
    {   
        $this -> validate($request, [
            'LeaveType'=> 'required|max:255',
            'Duration'=> 'required|max:255',
        ]);
        Leaves::create(
            [
                'LeaveType' => $request -> LeaveType,
                'Duration' => $request -> Duration,
            ]
        );
        return redirect('admin/add-leave')->with('status','Leave added successfully');     
    }

    public function rleaves(Request $request){
        $email = $request->email;
        $users = DB::select('select * from leaveforms where status = "rejected" ');
        return view('admin.leave.viewrleaves',['users'=>$users]);
        }

    public function pleaves(Request $request){
        $email = $request->email;
        $users = DB::select('select * from leaveforms where status = "pending" ');
        return view('admin.leave.viewpleaves',['users'=>$users]);
    }

    public function leaves(Request $request){
        $email = $request->email;
        $users = DB::select('select * from leaveforms ');
        return view('admin.leave.viewleaves',['users'=>$users]);
    }

    public function aleaves(Request $request){
        $email = $request->email;
        $users = DB::select('select * from leaveforms where status = "approved" ');
        return view('admin.leave.viewaleaves',['users'=>$users]);
    }

    public function destroy($id){
        DB::delete('delete from leaveforms where id = ?',[$id]);
        return redirect('admin/leave')->with('status','Leave Type deleted successfully');

    }
    public function edit($id){
        $leave = Leaves::find($id);
        return view('admin.leave.edit', compact('leave'));

    }
    public function update(Request $request, $id){
        
                $leavee = Leaves::find($id);
                $leavee -> LeaveType = $request -> LeaveType;
                $leavee -> Duration = $request -> Duration;
                $leavee->save();

        return redirect('admin/leave')->with('status','Leave Type details edited successfully');
    }
}
