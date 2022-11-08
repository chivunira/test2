<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Departments;

class RegisterController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index()
    {
        $departments = Departments::all('departmentname');
        //$departments = Departments::all();
        return view('auth.register' , compact('departments'));
    }

    public function store(Request $request)
    {
        
        $this -> validate($request, [
            'name'=> 'required|max:255',
            'username'=> 'required|max:255',
            'email'=> 'required|max:255',
            'password'=> 'required|confirmed',
            'department'=> 'required|max:255',
            'av_days'=> 'required|max:255',
            'role_as'=> 'nullable|max:255',

        ]);

        $userstatus = 'active';
        User::create(
            [
                'name' => $request -> name,
                'email' => $request -> email,
                'username' => $request -> username,
                'department' => $request -> department,
                'av_days' => $request -> av_days,
                'password' => Hash::make($request -> password),
                'role_as' => $request -> role_as,
                'status' => $userstatus,
            ]
        );

        //sign user in after registration
        //auth() -> attempt($request -> only('email', 'password'));

        return redirect('/register')->with('status','User added successfully');
        
        
        
    }
}
