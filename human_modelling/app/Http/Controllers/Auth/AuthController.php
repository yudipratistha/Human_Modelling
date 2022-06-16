<?php

namespace App\Http\Controllers\auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function registrationForm(){
        return view('auth.register');
    }

    public function login(Request $request){   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 0) {
                return redirect()->route('admin.ticketsList.index');
            }else{
                return redirect()->route('user.ticketsList.index');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }

    public function createUser(Request $request){
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'max:255', 'unique:users',
            'password' => 'required',
        ]);
        // $foto_lapangan_1 = $request->foto_lapangan_1;
        // $request->foto_lapangan_1->move(public_path('images'), "test.jpg");
        
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = 1;
        $user->password = Hash::make($request->password);
        $user->save();
        
        
        return redirect()->route('login');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
    
}
