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
use Carbon\Carbon;

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
        $professions = DB::table('profession')->get();

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

        $checkAddress = DB::table('user_address')->where('user_address.user_ic', $data['ic'])->first();

        if($checkAddress === null) {

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
            'position' => $data['position'],
            'bank_account' => $data['bank_account'],
            'bank_id' => ('2'),
            'staff' => ('0'),
            'profession' => ('TIADA'),
            'type' => ('1'),
            'password' => Hash::make('12345678'),
            'referral_code' => Str::random(8),
            'status' => ('AKTIF'),
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
     public function applications(Request $request)
    {

        // Retrieve the start and end dates from the form input
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Build the query
        $query = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
                    ->leftjoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->leftjoin('student_foundations', 'students.ic', '=', 'student_foundations.student_ic')
                    ->select('students.id',
                    'students.name',
                    'students.ic',
                    'students.phone',
                    'students.email',
                    'students.user_id',
                    'students.created_at',
                    'students.updated_at',
                    'students.register_at',
                    'students.referral_code',
                    'students.status_id',
                    'state.name AS state', 'users.name AS user', 'location.code AS location', 'student_foundations.foundation AS note');
                    // ->orderBy('students.created_at', 'desc')
                    // ->get();
        
                    // Apply date filters if provided
        if ($start_date) {
            $query->whereDate('students.created_at', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('students.created_at', '<=', $end_date);
        }

        // Complete the query
        $applicants = $query->orderBy('students.created_at', 'desc')->get();

        $affiliates = [];

        foreach ($applicants as $applicant) {

            // Find the affiliate(s) associated with the current student's referral code
            $affiliate = User::where('referral_code', $applicant->referral_code)
                        ->whereIn('type', [0,1])
                        ->get();
        
            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $affiliates[$applicant->id] = $affiliate;
            
        }

        return view('admin.application', compact('applicants', 'affiliates'));
    }

    public function applicationDetail(Request $request)
    {
        $ic = $request->input('ic');

        $applicants = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
                    ->leftJoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->leftJoin('status', 'students.status_id', '=', 'status.id')
                    ->select(
                        'students.id',
                        'students.name',
                        'students.ic',
                        'students.phone',
                        'students.email',
                        'students.address1',
                        'students.address2',
                        'students.postcode',
                        'students.city',
                        'students.spm_year',
                        'students.user_id',
                        'students.status_id',
                        DB::raw("DATE_FORMAT(students.created_at, '%d-%m-%Y') as created_at"),
                        'students.updated_at',
                        DB::raw("DATE_FORMAT(students.register_at, '%d-%m-%Y') as register_at"),
                        'state.name AS state',
                        'users.name AS user',
                        'location.name AS location',
                        'status.name AS status',
                        'students.reason'
                    )
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->first();

        $users = User::where('type', 1)->orderBy('name')->get();

        $fileUrl = null;
        if ($applicants) {
            $fileExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
            foreach ($fileExtensions as $extension) {
                $filePath = 'urproject/student/resultspm/' . $applicants->ic . '.' . $extension;
                if (Storage::disk('linode')->exists($filePath)) {
                    $fileUrl = Storage::disk('linode')->url($filePath);
                    break;
                }
            }
        }

        $programs = DB::table('student_programs')
                    ->join('program', 'student_programs.program_id', '=', 'program.id')
                    ->select('program.name', 'student_programs.status', 'student_programs.notes')
                    ->where('student_programs.student_ic', 'LIKE', "{$ic}")
                    ->get();

        $statusApplications = DB::table('status')->get();

        if ($request->ajax()) {
            return response()->json(['applicants' => $applicants, 'fileUrl' => $fileUrl, 'programs' => $programs, 'users' => $users, 'statusApplications' => $statusApplications]);
        }

        return view('admin.application', compact('applicants', 'fileUrl', 'programs', 'users', 'statusApplications'));
    }


    public function update(Request $request, $id)
    {
        $pic = $request->input('pic');
        $register_at = $request->input('register_at');
        $statusApplication = $request->input('statusApplication');

        if ($register_at !== null) {
            $studentRegDate = DB::table('students')
                    ->where('students.id', $id)
                    ->update(['register_at'=>$register_at, 'commission'=>'300', 'status_id' => $statusApplication]);

            return redirect()->route('admin.application')->with('success', 'Tarikh pendaftaran berjaya dikemaskini.');
        }elseif ($statusApplication !== null) {
            $studentStatus = DB::table('students')
                    ->where('students.id', $id)
                    ->update(['status_id' => $statusApplication]);

            return redirect()->route('admin.application')->with('success', 'Status permohonan pelajar berjaya dikemaskini.');
        }
        else 
        {
            $studentPIC = DB::table('students')
                        ->where('students.id', $id)
                        ->update(['user_id'=>$pic, 'updated_at'=>date('Y-m-d H:i:s')]);

            return redirect()->route('admin.application')->with('success', 'Agihan pegawai perhubungan kepada pelajar telah berjaya.');
        }
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
                ->select('users.*', 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank', 'user_address.address1', 'user_address.address2','user_address.postcode','user_address.city', 'state.name AS state')
                ->orderBy('users.name')
                ->get();

                // Collect leader IDs
        $leaderIds = $users->pluck('leader_id')->unique();

        // Fetch leaders
        $leaders = User::whereIn('id', $leaderIds)->get()->keyBy('id');

        return view('admin.userlist', compact('users', 'banks', 'leaders'));
    }

    public function userDetail(Request $request)
    {
        $ic = $request->input('ic');

        $banks = DB::table('bank')->get();

        $users = User::whereIn('type', [0, 1])
                ->join('religion', 'users.religion_id', '=', 'religion.id')
                ->join('nation', 'users.nation_id', '=', 'nation.id')
                ->join('sex', 'users.sex_id', '=', 'sex.id')
                ->join('bank', 'users.bank_id', '=', 'bank.id')
                ->leftjoin('user_address', 'users.ic', '=', 'user_address.user_ic' )
                ->join('state', 'user_address.state_id', '=', 'state.id')
                ->select('users.*', 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank', 'user_address.address1', 'user_address.address2','user_address.postcode','user_address.city', 'state.name AS state')
                ->where('users.ic', 'LIKE', "{$ic}")
                ->first();

        if ($request->ajax()) {
            return response()->json(['banks' => $banks, 'users' => $users]);
        }

        return view('admin.userlist', compact('users', 'banks'));
    }

    public function updateUser(Request $request, $id)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $bank_account = $request->input('bank_account');
        $bank = $request->input('bank');
        $position = $request->input('position');
        $status = $request->input('status');

        if ($position === "AFFILIATE UNITI") {
            $type = 0;
        }
        elseif ($position === "MANAGER" || $position === "EDUCATION ADVISOR") {
            $type = 1;
        }

        $user = DB::table('users')
                ->where('users.id', $id)
                ->update(['name'=>$name, 'phone'=>$phone, 'bank_account'=>$bank_account, 'bank_id'=>$bank, 'type'=>$type, 'position'=>$position, 'status'=>$status]);

        return redirect()->route('admin.userlist')->with('success', 'Maklumat pengguna berjaya dikemaskini.');
    }

    public function studentlist()
    {
        $students = DB::table('students')
                    ->leftjoin('status', 'students.status_id', '=', 'status.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.id', 'students.name', 'students.ic', 'students.phone', 'students.email', 'students.created_at', 'students.updated_at', 'status.name AS status', 'students.register_at', 'students.referral_code', 'students.user_id', 'location.code AS location')
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

    public function profile()
    {
        $banks = DB::table('bank')->get();

        $user = Auth::user()
                ->join('religion', 'users.religion_id', '=', 'religion.id')
                ->join('nation', 'users.nation_id', '=', 'nation.id')
                ->join('sex', 'users.sex_id', '=', 'sex.id')
                ->join('bank', 'users.bank_id', '=', 'bank.id')
                ->select('users.*', 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank')
                ->where('users.id', Auth::id())
                ->first();

        $userAddress = DB::table('user_address')
                        ->join('state', 'user_address.state_id', '=', 'state.id')
                        ->select('user_address.*', 'state.name AS state')
                        ->where('user_address.user_ic', '=', $user->ic)
                        ->first();

        return view('admin.profile', compact('banks', 'user', 'userAddress'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $phone = $request->input('phone');
        $bank_account = $request->input('bank_account');
        $bank = $request->input('bank');

        $user = DB::table('users')
                ->where('users.id', Auth::id())
                ->update(['phone'=>$phone, 'bank_account'=>$bank_account, 'bank_id'=>$bank]);

        return redirect()->route('admin.profile')->with('success', 'Maklumat anda berjaya dikemaskini.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed', // Example validation rules, adjust as needed
        ], [
            'password.required' => 'Kata laluan diperlukan.',
            'password.min' => 'Kata laluan mesti sekurang-kurangnya 8 aksara.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Katalaluan anda berjaya dikemaskini.');;
    }

    public function summary()
    {
        $totalStudents = DB::table('students')->count();

        $studentStatus = DB::table('students')
                    ->join('status', 'students.status_id', '=', 'status.id')
                    ->select(DB::raw('count(students.id) AS total'), 'status.name AS status')
                    ->groupBy('status.name')
                    ->orderBY('status.id');

        $studentNoStatus = DB::table('students')
                    ->select(DB::raw('COUNT(students.id) AS total'), DB::raw('"TIADA STATUS" AS status'))
                    ->whereNull('students.status_id');

        $status = $studentStatus->union($studentNoStatus)->get();

        $statusWithPercentage = $status->map(function ($status) use ($totalStudents) {
            $status->percentage = ($status->total / $totalStudents) * 100;
            return $status;
        });

        $locations = DB::table('students')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select(DB::raw('count(students.id) AS total'), 'location.name AS location')
                    ->groupBy('location.name')
                    ->get();

        $locationsWithPercentage = $locations->map(function ($location) use ($totalStudents) {
            $location->percentage = ($location->total / $totalStudents) * 100;
            return $location;
        });

        $sources = DB::table('students')
                    ->select(DB::raw('count(students.id) AS total'), 'students.source')
                    ->groupBy('students.source')
                    ->get();

        $sourcessWithPercentage = $sources->map(function ($source) use ($totalStudents) {
            $source->percentage = ($source->total / $totalStudents) * 100;
            return $source;
        });

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Get the student count for each month of the current year
        $students = DB::table('students')
            ->select(DB::raw('COUNT(id) as total, MONTH(created_at) as month'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Initialize an array with all months set to zero
        $monthlyData = array_fill(1, 12, 0);

        // Merge the query results with the initialized array
        foreach ($students as $month => $total) {
            $monthlyData[$month] = $total;
        }

        // Convert the result to a collection
        $monthlyData = collect($monthlyData)->map(function ($total, $month) {
            return [
                'month' => $month,
                'total' => $total,
            ];
        })->values();

        return view('admin.summary', compact('totalStudents', 'statusWithPercentage', 'locationsWithPercentage', 'sourcessWithPercentage', 'currentYear', 'monthlyData'));
    }
}
