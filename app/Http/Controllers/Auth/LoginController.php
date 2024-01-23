<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use App\Models\UserRole; 
use App\Models\Member;   
use Session;


class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    
                
                protected function authenticated(Request $request, $user)
            {
                $user->load('userrole', 'member.kpiMetricMembers.progress');
                
                // You can log the user2 to verify that the related properties are loaded.
              //  Log::info("User object:", ['user' => $user]);
                Log::info("User role:", ['userrole' => $user->userrole]);
                Log::info("Member data:", ['member' => $user->member]);

                //return redirect()->intended($this->redirectTo); // Redirect to the intended URL after login
                 Session::put('user', $user);
                 Session::save();
                 Log::info("User Updated  object:", ['user' => $user]);

                //  if ($user->user_role_id === 3) {
                //     return redirect('/partners'); // Redirect to /partners for users with user_role_id 3.
                // }
                //  $loggeduser= Session::get('user');
                //  Log::info('Session User 0', ['user'=> $loggeduser]);
                //  dd($loggeduser);
                // redirect()->route('dashboard');
                toastr('Logged in Successfully','success');
              //  toastr()->warning("Something went wrong!");
                return redirect()->intended($this->redirectTo);
                 

                   // return redirect()->intended('dashboard')->with('user', $user)
            }

            
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
