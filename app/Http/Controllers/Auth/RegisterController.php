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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function about(Request $request)
    {
        $ref = $request->query('ref');

        return view('auth.about', compact('ref'));
    }

    public function showRegistrationForm(Request $request)
    {
        $ref = $request->query('ref');

        $religions = DB::table('religion')->get();
        $nations = DB::table('nation')->get();
        $sexs = DB::table('sex')->get();
        $states = DB::table('state')->get();
        $banks = DB::table('bank')->get();
        $professions = DB::table('profession')->get();

        return view('auth.register', compact('ref', 'religions', 'nations', 'sexs', 'states', 'banks', 'professions'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $checkIC = User::where('ic', $data['ic'])->first();

        if ($checkIC) {
            // If the IC already exists, return a view with an error message
            return redirect()->back()->with('msg_error', 'No. kad pengenalan telah didaftar di dalam sistem.')->withInput();;
        }

        $leaderID = null;

        if ($data['referral_code'] !== null) {
            $leaderID = User::where('referral_code', $data['referral_code'])->first();
        }

        $checkAddress = DB::table('user_address')->where('user_address.user_ic', $data['ic'])->first();

        if ($checkAddress === null) {

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
        }

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
            'staff' => $data['staff'],
            'profession' => strtoupper($data['profession']),
            'password' => Hash::make($data['password']),
            'referral_code' => Str::random(8),
            'leader_id' => $leaderID ? $leaderID->id : null,
            'status' => ('AKTIF'),
        ]);
    }

    public function register(Request $request)
    {
        $ref = $request->query('ref');

        $this->validator($request->all())->validate();

        // Create the user but do not log them in
        $response = $this->create($request->all());

        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }

        // Manually log the user out just in case
        $this->guard()->logout();

        // Redirect to the desired page, such as a login page with a success message
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }
}
