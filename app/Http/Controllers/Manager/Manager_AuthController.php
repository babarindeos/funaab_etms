<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Manager_AuthController extends Controller
{
    //
    public function index(){

        /*
         User::create([
            'fileno' => 'sp1706',
            'firstname' => 'Oluwaseyi',
            'surname' => 'Babarinde',
            'middlename' => 'Abiodun',
            'email' => 'seyibabs.ng@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'

        ]); 
        */


         /* 
         User::create([
            'fileno' => 'IT002',
            'firstname' => 'Entry',
            'surname' => 'Admin002',
            'middlename' => 'Sub-Admin',
            'email' => 'seyibabs002.ng@gmail.com',
            'password' => bcrypt('13$Y2nUZ/0'),
            'role' => 'admin'

        ]); 
        */
        
        


        return view('manager.auth.login');
    }

    public function login(LoginRequest $request){

        //dd(Auth::check());

        $email = $request->input('email');
        $password = $request->input('password');

        
        if (Auth::attempt(['email'=>$email, 'password'=>$password, 'role'=>'manager' ])){
            $request->session()->regenerate();

            return redirect()->route('manager.dashboard.index');
            
        }else{
            return back()->withErrors(['email' => 'Invalid login credentials'])->withInput();
        }

        return back()->withErrors(['email' => 'Invalid login credentials'])->withInput();
    }


    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
