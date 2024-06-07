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
use Illuminate\Support\Facades\Storage;

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
        $checkIC = User::where('ic', $data['ic'])->first();

        if ($checkIC) {
        // If the IC already exists, return a view with an error message
            return redirect()->back()->with('msg_error', 'No. kad pengenalan telah didaftar di dalam sistem.')->withInput();;
        }

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
        $response = $this->create($request->all());

        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }

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
                    ->leftjoin('status', 'students.status_id', '=', 'status.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location', 'status.name AS status')
                    ->orderBy('students.created_at', 'desc')
                    ->get();

        $users = User::where('type', 1)->orderBy('id')->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $jpgFilePath = 'urproject/student/resultspm/' . $applicant->ic . '.jpg';
            $jpegFilePath = 'urproject/student/resultspm/' . $applicant->ic . '.jpeg';

            if (Storage::disk('linode')->exists($jpgFilePath)) {
                // If the .jpg file exists, use its URL
                $fileUrl = Storage::disk('linode')->url($jpgFilePath);
            } elseif (Storage::disk('linode')->exists($jpegFilePath)) {
                // If the .jpeg file exists, use its URL
                $fileUrl = Storage::disk('linode')->url($jpegFilePath);
            } else {
                // If neither file exists, set $fileUrl to null or a default value
                $fileUrl = null; // You can customize this to any default value you prefer
            }

            $programs = DB::table('student_programs')
                        ->join('program', 'student_programs.program_id', '=', 'program.id')
                        ->select('program.name', 'student_programs.status', 'student_programs.notes')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs,
                'file_url' => $fileUrl
            ];

        }

        return view('admin.application', ['applicantsWithPrograms' => $applicantsWithPrograms], ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $pic = $request->input('pic');

        $studentPIC = DB::table('students')
                    ->where('students.id', $id)
                    ->update(['user_id'=>$pic, 'updated_at'=>date('Y-m-d H:i:s')]);

        return redirect()->route('admin.application')->with('success', 'Agihan pegawai perhubungan kepada pelajar telah berjaya.');;
    }

    public function userlist()
    {
        $banks = DB::table('bank')->get();

        $users = User::whereIn('type', [0, 1])
                ->join('religion', 'users.religion_id', '=', 'religion.id')
                ->join('nation', 'users.nation_id', '=', 'nation.id')
                ->join('sex', 'users.sex_id', '=', 'sex.id')
                ->join('bank', 'users.bank_id', '=', 'bank.id')
                ->leftjoin('user_address', 'users.ic', '=', 'user_address.user_ic' )
                ->join('state', 'user_address.state_id', '=', 'state.id')
                ->select('users.*', 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank', 'user_address.*', 'state.name AS state')
                ->orderBy('users.name')
                ->get();

        return view('admin.userlist', compact('users', 'banks'));
    }

    public function updateUser(Request $request, $id)
    {
        $phone = $request->input('phone');
        $bank_account = $request->input('bank_account');
        $bank = $request->input('bank');
        $position = $request->input('position');

        if ($position === "AFFILIATE UNITI") {
            $type = 0;
        }
        elseif ($position === "MANAGER" || $position === "EDUCATION ADVISOR") {
            $type = 1;
        }

        $user = DB::table('users')
                ->where('users.id', $id)
                ->update(['phone'=>$phone, 'bank_account'=>$bank_account, 'bank_id'=>$bank, 'type'=>$type, 'position'=>$position]);

        return redirect()->route('admin.userlist')->with('success', 'Maklumat pengguna berjaya dikemaskini.');
    }

    public function studentlist()
    {
        $students = DB::table('students')
                    ->leftjoin('status', 'students.status_id', '=', 'status.id')
                    ->select('students.*', 'status.name AS status')
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
