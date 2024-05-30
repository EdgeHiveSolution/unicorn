<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Department;
use App\Models\User;
use App\Models\Partner;
use Illuminate\Support\Facades\Session;
use App\Models\UserRole;
use Illuminate\Support\Facades\Log;



class RegisterController extends Controller
{


    use RegistersUsers;

    /**
     * Where to redirect admins after registration.
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
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

   
    protected function create(array $data)
    {
        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_role_id' => UserRole::where('name', 'Member')->first()->id,


        ]);
    
        // Create a corresponding member for the user and set the user_id
        $member = Member::create([
            'name' =>$user->name,
            'email' =>$user->email,
            'user_id' => $user->id, // Set the user_id for the member
        ]);
    
        // Check if the department_id is provided in the registration form
        if (isset($data['department_id'])) {
            $department = Department::find($data['department_id']);
            if ($department) {
                // Associate the member with the department
                $department->members()->attach($member->id);
            }
        }

        // Check if the partner_id is provided in the registration form
        if (isset($data['partner_id'])) {
            $partner = Partner::find($data['partner_id']);
            if ($partner) {
                // Associate the member with the partner
                $partner->members()->attach($member->id);
            }
        }
    
        return $user;
    }



    protected function registered(Request $request, $user)
    {
        // Load the user with its related data
        $user->load('userrole', 'member.kpiMetricMembers.progress');

        // Store the user in the session
        Session::put('user', $user);
        Session::save();
        
        Log::info("User Registered and stored in session:", ['user' => $user]);


       toastr('Logged in Successfully','success');
        return redirect($this->redirectTo);
    }
    
                
     protected function showRegistrationForm(Request $request)
     {
        $partnerId = $request->query('partner_id');
        $departmentId = $request->query('department_id');
        return view('auth.register', compact('partnerId', 'departmentId'));
     }
}
