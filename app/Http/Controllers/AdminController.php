<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    use RegistersUsers {
        register as registration;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('auth');
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showRegistrationForm()
    {
        $religions = DB::table('religion')->get();
        $nations = DB::table('nation')->get();
        $sexs = DB::table('sex')->get();
        $states = DB::table('state')->get();

        return view('admin.register', compact('religions', 'nations', 'sexs', 'states'));
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
            'name' => $data['name'],
            'ic' => $data['ic'],
            'religion_id' => $data['religion'],
            'nation_id' => $data['nation'],
            'sex_id' => $data['sex'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'position' => $data['position'],
            'bank_account' => $data['bank_account'],
            'type' => ('1'),
            'password' => Hash::make('12345678'),
            'referral_code' => Str::random(8),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Create the user but do not log them in
        $user = $this->create($request->all());

        // Redirect to the desired page, such as a login page with a success message
        return redirect('/admin/register')->with('success', 'Pendaftaran pengguna baru berjaya.');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function applications()
    {
        $applicants = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
                    ->leftjoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location')
                    ->orderBy('students.created_at', 'desc')
                    ->get();

        $users = User::where('type', 1)->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $programs = DB::table('student_programs')
                        ->join('program', 'student_programs.program_id', '=', 'program.id')
                        ->select('program.name', 'student_programs.status', 'student_programs.notes')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs
            ];

        }

        return view('admin.application', ['applicantsWithPrograms' => $applicantsWithPrograms], ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $pic = $request->input('pic');

        $studentPIC = DB::table('students')
                    ->where('students.id', $id)
                    ->update(['user_id'=>$pic]);

        $applicants = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
                    ->leftjoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location')
                    ->orderBy('students.name', 'asc')
                    ->get();

        $users = User::where('type', 1)->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $programs = DB::table('student_programs')
                        ->join('program', 'student_programs.program_id', '=', 'program.id')
                        ->select('program.name', 'student_programs.status', 'student_programs.notes')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs
            ];

        }

        return view('admin.application', ['applicantsWithPrograms' => $applicantsWithPrograms, 'users' => $users])->with('success', 'Agihan pegawai perhubungan kepada pelajar telah berjaya.');
    }

    public function userlist()
    {
        $users = User::whereIn('type', [0, 1])->get();

        return view('admin.userlist', compact('users'));
    }

    public function studentlist()
    {
        $students = DB::table('students')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        $affiliates = [];
        
        $advisors = [];

        foreach ($students as $student) {
            // Find the affiliate(s) associated with the current student's referral code
            $affiliate = User::where('referral_code', $student->referral_code)
                        ->whereIn('type', [0,1])
                        ->get();
        
            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $affiliates[$student->id] = $affiliate;

            $advisor = User::where('id', $student->user_id)
                        ->whereIn('type', [1])
                        ->get();
        
            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $advisors[$student->id] = $advisor;
        }

        return view('admin.studentlist', compact('students', 'affiliates', 'advisors'));
    }
}
