<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        register as registration;
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    public function about()
    {
        return view('auth.about');
    }

    public function showRegistrationForm()
    {
        $religions = DB::table('religion')->get();
        $nations = DB::table('nation')->get();
        $sexs = DB::table('sex')->get();
        $states = DB::table('state')->get();
        $banks = DB::table('bank')->get();

        return view('auth.register', compact('religions', 'nations', 'sexs', 'states', 'banks'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $address1 = $data['address1'];
        $address2 = $data['address2'];
        $postcode = $data['postcode'];
        $city = $data['city'];
        $state = $data['state'];
        
        DB::table('user_address')->insert([
            'user_ic' => $data['ic'],
            'address1' => $address1,
            'address2' => $address2,
            'postcode' => $postcode,
            'city' => $city,
            'state_id' => $state,
        ]);

        return User::create([
            'name' => strtoupper($data['name']),
            'ic' => $data['ic'],
            'religion_id' => $data['religion'],
            'nation_id' => $data['nation'],
            'sex_id' => $data['sex'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'position' => ('AFFILIATE UNITI'),
            'bank_account' => $data['bank_account'],
            'bank_id' => $data['bank'],
            'password' => Hash::make('12345678'),
            'referral_code' => Str::random(8),
        ]);

        dd($data['bank'],);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Create the user but do not log them in
        $user = $this->create($request->all());

        // Manually log the user out just in case
        $this->guard()->logout();

        // Redirect to the desired page, such as a login page with a success message
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }
}
