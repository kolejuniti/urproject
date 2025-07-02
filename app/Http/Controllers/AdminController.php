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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function program()
    {
        $programs = DB::table('program')
            ->join('location', 'program.location_id', '=', 'location.id')
            ->select('program.id AS id', 'program.name AS program', 'location.name AS location', 'program.offered')
            ->orderBy('program.location_id')
            ->orderBy('program.id')
            ->get();

        $locations = DB::table('location')->get();
        
        return view('admin.program', compact('locations', 'programs'));
    }

    public function addprogram(Request $request)
    {
        $program = $request->input('program');
        $location = $request->input('location');

        $addProgram = DB::table('program')->insert([
            'name' => strtoupper($program),
            'location_id' => $location,
            'offered' => 1
        ]);
        
        return redirect()->back()->with('success', 'Program baru berjaya ditambah ke dalam sistem.');
    }

    public function updateprogram(Request $request, $id)
    {  
        // Validate the request (optional but recommended)
        $request->validate([
            'offered' => 'required|boolean', // Ensure it's a boolean (0 or 1)
        ]);
       
        DB::table('program')
        ->where('program.id', '=', $id)
        ->update(['offered' => $request->input('offered')]);
        
        return redirect()->back()->with('success', 'Program berjaya dikemaskini.');
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
        $user = Auth::user();
        $ref = $user->referral_code;
        $id = $user->id;

        $url = url('/').'?ref='.$ref; // Generates the referral URL

        // Generate and return the QR code as an SVG string for use in Blade
        $qrCode = QrCode::size(200)->generate($url);

        // Generate and save QR code as a PNG file in the public folder
        QrCode::size(200)
            ->format('svg')
            ->generate($url, public_path('qrcode.svg'));

        // Retrieve the start and end dates from the form input
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // If both dates are null, set the default to last 7 days
        if (!$start_date && !$end_date) {
            $start_date = now()->subDays(7)->startOfDay()->format('Y-m-d'); 
            $end_date = now()->endOfDay()->format('Y-m-d');
        }

        // Build the query
        $query = DB::table('students')
                    ->leftjoin('state', 'students.state_id', '=', 'state.id')
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
                    'state.name AS state', 'users.name AS user', 'location.code AS location', 'student_foundations.foundation AS note')
                    ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });
                    // ->orderBy('students.created_at', 'desc')
                    // ->get();

        // Apply date filters
        if ($start_date && $end_date) {
            $query->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $query->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        // Complete the query
        $applicants = $query->orderByDesc('students.id')->get();

        $affiliates = [];

        foreach ($applicants as $applicant) {

            // Find the affiliate(s) associated with the current student's referral code
            $affiliate = User::where('referral_code', $applicant->referral_code)
                        ->whereIn('type', [0,1])
                        ->get();
        
            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $affiliates[$applicant->id] = $affiliate;
            
        }

        return view('admin.application', compact('applicants', 'affiliates', 'start_date', 'end_date', 'url', 'qrCode'));
    }

    public function applicationDetail(Request $request)
    {
        $ic = $request->input('ic');

        $applicants = DB::table('students')
                    ->leftjoin('state', 'students.state_id', '=', 'state.id')
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

        $users = User::where('type', 1)
            ->where('accept_data', 1)
            ->where('affiliate_data', 1)
            ->orderBy('name')
            ->get();

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
                        ->update(['user_id'=>$pic, 'updated_at'=>date('Y-m-d H:i:s'), 'auto_assign' => 0]);

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
        $accept_data = $request->has('accept_data') ? 1 : 0;
        $affiliate_data = $request->has('affiliate_data') ? 1 : 0;

        if ($position === "AFFILIATE UNITI") {
            $type = 0;
        }
        elseif ($position === "MANAGER" || $position === "EDUCATION ADVISOR") {
            $type = 1;
        }

        $user = DB::table('users')
                ->where('users.id', $id)
                ->update(['name'=>$name, 'phone'=>$phone, 'bank_account'=>$bank_account, 'bank_id'=>$bank, 'type'=>$type, 'position'=>$position, 'status'=>$status, 'accept_data'=>$accept_data,'affiliate_data'=>$affiliate_data]);

        return redirect()->route('admin.userlist')->with('success', 'Maklumat pengguna berjaya dikemaskini.');
    }

    public function studentlist(Request $request)
    {
        // Retrieve the start and end dates from the form input
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // If both dates are null, set the default to last 7 days
        if (!$start_date && !$end_date) {
            $start_date = now()->subDays(7)->startOfDay()->format('Y-m-d'); 
            $end_date = now()->endOfDay()->format('Y-m-d');
        }

        $students = DB::table('students')
                    ->leftjoin('status', 'students.status_id', '=', 'status.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.id', 'students.name', 'students.ic', 'students.phone', 'students.email', 'students.created_at', 'students.updated_at', 'status.name AS status', 'students.register_at', 'students.referral_code', 'students.user_id', 'location.code AS location')
                    ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });

        // Apply date filters
        if ($start_date && $end_date) {
            $students->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $students->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        // Complete the query
        $students = $students->orderByDesc('students.id')->get();
        
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

        return view('admin.studentlist', compact('students', 'affiliates', 'advisors', 'start_date', 'end_date'));
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

    public function summary(Request $request)
    {
        // Retrieve the start and end dates from the form input
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Total students with date range filter
        $totalStudents = DB::table('students')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            });

        // Apply date filters
        if ($start_date && $end_date) {
            $totalStudents->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $totalStudents->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }
        
        $totalStudents = $totalStudents->count();

        // Student status summary with date range filter
        $studentStatus = DB::table('students')
            ->join('status', 'students.status_id', '=', 'status.id')
            ->select(DB::raw('COUNT(students.id) AS total'), 'status.name AS status', 'status.id AS status_id')
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });

        // Apply date filters
        if ($start_date && $end_date) {
            $studentStatus->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $studentStatus->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        $studentStatus = $studentStatus->groupBy('status.name', 'status.id');

        // Students with no status and date range filter
        $studentNoStatus = DB::table('students')
            ->select(DB::raw('COUNT(students.id) AS total'), DB::raw('"TIADA STATUS" AS status'), DB::raw('NULL AS status_id'))
            ->whereNull('students.status_id')
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });

        // Apply date filters
        if ($start_date && $end_date) {
            $studentNoStatus->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $studentNoStatus->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        // Union and ordering results
        $status = $studentStatus->unionAll($studentNoStatus)
            ->orderBy('status_id')
            ->get();

        $statusWithPercentage = $status->map(function ($status) use ($totalStudents) {
            $status->percentage = ($status->total / $totalStudents) * 100;
            return $status;
        });

        // Summary of students by locations with date range filter
        $locations = DB::table('students')
            ->join('location', 'students.location_id', '=', 'location.id')
            ->select(DB::raw('count(students.id) AS total'), 'location.name AS location')
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });

        // Apply date filters
        if ($start_date && $end_date) {
            $locations->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $locations->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        $locations = $locations->groupBy('location.name')->get();

        $locationsWithPercentage = $locations->map(function ($location) use ($totalStudents) {
            $location->percentage = ($location->total / $totalStudents) * 100;
            return $location;
        });

        // Summary of students by sources with KUPD and KUKB, including date range filter
        $sources = DB::table('students')
            ->select(
                'students.source',
                DB::raw('COUNT(students.id) AS total'),
                DB::raw('SUM(CASE WHEN students.location_id = 1 THEN 1 ELSE 0 END) AS total_kupd'), // Count for KUPD (location_id = 1)
                DB::raw('SUM(CASE WHEN students.location_id = 2 THEN 1 ELSE 0 END) AS total_kukb')  // Count for KUKB (location_id = 2)
            )
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });

        // Apply date filters
        if ($start_date && $end_date) {
            $sources->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $sources->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        $sources = $sources->groupBy('students.source')->get();

        // Calculate percentage for each source
        $sourcessWithPercentage = $sources->map(function ($source) use ($totalStudents) {
            $source->percentage = ($source->total / $totalStudents) * 100;
            return $source;
        });

        // Summary of students by states with KUPD and KUKB, including date range filter
        $states = DB::table('students')
            ->leftjoin('state', 'students.state_id', '=', 'state.id')
            ->select(
                'state.name AS state',
                DB::raw('COUNT(students.id) AS total'),
                DB::raw('SUM(CASE WHEN students.location_id = 1 THEN 1 ELSE 0 END) AS total_kupd'), // Count for KUPD (location_id = 1)
                DB::raw('SUM(CASE WHEN students.location_id = 2 THEN 1 ELSE 0 END) AS total_kukb')  // Count for KUKB (location_id = 2)
        )
        ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    });

        // Apply date filters
        if ($start_date && $end_date) {
            $states->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $states->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }
        
        $states = $states->orderBy('state.id')->groupBy('state.id', 'state.name')->get();

        // Calculate percentage for each source
        $statesWithPercentage = $states->map(function ($state) use ($totalStudents) {
            $state->percentage = ($state->total / $totalStudents) * 100;
            return $state;
        });

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Get the student count for each month of the current year
        $students = DB::table('students')
            ->select(DB::raw('COUNT(id) as total, MONTH(created_at) as month'))
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
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

        return view('admin.summary', compact('totalStudents', 'statusWithPercentage', 'locationsWithPercentage', 'sourcessWithPercentage', 'currentYear', 'monthlyData', 'statesWithPercentage'));
    }

    public function summaryDetail(Request $request)
    {
        $status_id = $request->input('status_id');

        // Fetch status information
        $status = DB::table('status')
            ->select('status.name AS status_name')
            ->where('status.id', '=', $status_id)
            ->first();

        // Format status
        $statusName = $status ? $status->status_name : 'Tiada Status';

        // Handle the case where status_id is null (for "TIADA STATUS")
        if (is_null($status_id)) {
            $statusDetails = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->join('users AS advisor', 'students.user_id', '=', 'advisor.id')
                ->select('students.name AS student', 'students.ic', 'affiliate.name AS affiliate', 'advisor.name AS advisor')
                ->where('affiliate.type', '=', 0)
                ->whereNull('students.status_id')
                ->get();
        } else {
            $statusDetails = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->join('users AS advisor', 'students.user_id', '=', 'advisor.id')
                ->select('students.name AS student', 'students.ic', 'affiliate.name AS affiliate', 'advisor.name AS advisor')
                ->where('affiliate.type', '=', 0)
                ->where('students.status_id', '=', $status_id)
                ->get();
        }

        return response()->json([
            'statusDetails' => $statusDetails,
            'status' => $statusName
        ]);
    }

    public function leadReports(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $location = $request->input('location');

        $locations = DB::table('location')->get();

        $sources = DB::table('students')
            ->select('students.source')
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
            ->groupBy('students.source')->get();

        $totalData = [];
        $totalDataWithAffiliate = [];
        $totalDataWithoutAffiliate = [];
        $totalDataPreRegisterWithAffiliate = [];
        $totalDataPreRegister = [];
        $totalDataRegister = [];
        $totalDataRejects = [];

        if ($request->input('location') == 1) {
            $location_name = 'KUPD';
        } elseif ($request->input('location') == 2) {
            $location_name = 'KUKB';
        } elseif ($request->input('location') == 3) {
            $location_name = 'KUPD & KUKB';
        } else {
            $location_name = '';
        }

        foreach ($sources as $source) {
            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $totalData[$source->source] = $query->count();

            $query  = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereNotNull('students.referral_code')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }

                $totalDataWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereNull('students.referral_code')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }

                $totalDataWithoutAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereNotNull('students.referral_code')
                ->where('students.status_id', '=', 19)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }

                $totalDataPreRegisterWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereNull('students.referral_code')
                ->where('students.status_id', '=', 19)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }

                $totalDataPreRegisterWithoutAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereNotNull('students.referral_code')
                ->whereIn('students.status_id', [20,21,22])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }

                $totalDataRegisterWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereNull('students.referral_code')
                ->whereIn('students.status_id', [20,21,22])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }

                $totalDataRegisterWithoutAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [1, 2, 3, 4, 5, 6, 11, 23, 24, 25, 26, 27]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $totalDataRejects[$source->source] = $query->count();
        }

        $totalDataCount = array_sum($totalData);
        $totalDataWithAffiliateCount = array_sum($totalDataWithAffiliate);
        $totalDataWithoutAffiliateCount = array_sum($totalDataWithoutAffiliate);
        $totalDataPreRegisterWithAffiliateCount = array_sum($totalDataPreRegisterWithAffiliate);
        $totalDataPreRegisterWithoutAffiliateCount = array_sum($totalDataPreRegisterWithoutAffiliate);
        $totalDataRegisterWithAffiliateCount = array_sum($totalDataRegisterWithAffiliate);
        $totalDataRegisterWithoutAffiliateCount = array_sum($totalDataRegisterWithoutAffiliate);
        $totalDataRejectCount = array_sum($totalDataRejects);

        $totalDataEntry = array_sum($totalDataWithAffiliate) + array_sum($totalDataWithoutAffiliate);
        $totalDataPreRegister = array_sum($totalDataPreRegisterWithAffiliate) + array_sum($totalDataPreRegisterWithoutAffiliate);
        $totalDataRegister = array_sum($totalDataRegisterWithAffiliate) + array_sum($totalDataRegisterWithoutAffiliate);

        return view('admin.leadreports', compact('sources', 'start_date', 'end_date', 'locations', 'totalData', 'totalDataWithAffiliate', 'totalDataWithoutAffiliate', 'totalDataPreRegisterWithAffiliate', 'totalDataPreRegisterWithoutAffiliate', 'totalDataRegisterWithAffiliate', 'totalDataRegisterWithoutAffiliate', 'totalDataRegister', 'totalDataCount', 'totalDataWithAffiliateCount', 'totalDataWithoutAffiliateCount', 'totalDataPreRegisterWithAffiliateCount', 'totalDataPreRegisterWithoutAffiliateCount', 'totalDataRegisterWithAffiliateCount', 'totalDataRegisterWithoutAffiliateCount', 'totalDataEntry', 'totalDataPreRegister', 'totalDataRegister', 'location_name', 'totalDataRejects', 'totalDataRejectCount'));
    }

    public function yearReports(Request $request)
    {
        $locations = DB::table('location')->get();  

        $currentYear = Carbon::now()->year;
        $startYear = $currentYear - 2;

        // Final data structure
        $yearlyData = [];

        foreach ($locations as $location) { 
            for ($year = $startYear; $year <= $currentYear; $year++) {
                $students = DB::table('students')
                    ->select(DB::raw('COUNT(id) as total, MONTH(CAST(created_at AS DATE)) as month'))
                    ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                    ->where('students.location_id', $location->id)
                    ->whereYear('created_at', $year)
                    ->groupBy(DB::raw('MONTH(CAST(created_at AS DATE))'))
                    ->pluck('total', 'month');

                // Ensure all months are present
                for ($month = 1; $month <= 12; $month++) {
                    $total = $students[$month] ?? 0;
                    $yearlyData[$year][$month]['total'][$location->id] = $total;
                }
            }
        }

        return view('admin.yearreports', compact('currentYear', 'startYear', 'yearlyData', 'locations'));
    }


    public function achievements(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $location = $request->input('location');

        $locations = DB::table('location')->get();

        if ($request->input('location') == 1) {
            $location_name = 'KUPD';
        } elseif ($request->input('location') == 2) {
            $location_name = 'KUKB';
        } elseif ($request->input('location') == 3) {
            $location_name = 'KUPD & KUKB';
        } else {
            $location_name = '';
        }

        $advisors = User::where('type', 1)
            ->where(function($query) {
                $query->where('name', 'like', 'PD-%')
                        ->orWhere('name', 'like', 'KB-%');
            })
            ->orderBy('name')
            ->get();

        $assigns = [];
        $assignPercentage = [];
        $notprocess = [];
        $notprocessPercentage = [];
        $process = [];
        $processPercentage = [];
        $preregisters = [];
        $preregisterPercentage = [];
        $registers = [];
        $registerPercentage = [];
        $rejects = [];
        $rejectPercentage = [];

        foreach ($advisors as $advisor)
        {
            // Directly assign count to advisorId key in assignDatas array (no nested array)
            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $assigns[$advisor->id] = $query->count();
                
            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->where(function($query) {
                    $query->whereNull('students.status_id')
                        ->orWhere('students.status_id', '=', 0);
                });

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $notprocess[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->where(function($query) {
                    $query->whereIn('students.status_id', [7,8,9,10,12,13,14,15,16,17,18]);
                });

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $process[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [19]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $preregisters[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [20, 21, 22]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $registers[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [1, 2, 3, 4, 5, 6, 11, 23, 24, 25, 26, 27]);

                if ($location == 3) {
                    $query ->whereIn('students.location_id', [1, 2]);
                } else {
                    $query ->where('students.location_id', '=', $location);
                }
            
                $rejects[$advisor->id] = $query->count();

                if ($assigns[$advisor->id] > 0) {
                    $assignPercentage[$advisor->id] = (($assigns[$advisor->id])/($assigns[$advisor->id]))*(100);
                    $notprocessPercentage[$advisor->id] = round((($notprocess[$advisor->id])/($assigns[$advisor->id]))*(100),2);
                    $processPercentage[$advisor->id] = round((($process[$advisor->id])/($assigns[$advisor->id]))*(100),2);
                    $preregisterPercentage[$advisor->id] = round((($preregisters[$advisor->id])/($assigns[$advisor->id]))*(100),2);
                    $registerPercentage[$advisor->id] = round((($registers[$advisor->id])/($assigns[$advisor->id]))*(100),2);
                    $rejectPercentage[$advisor->id] = round((($rejects[$advisor->id])/($assigns[$advisor->id]))*(100),2);
                } else {
                    $assignPercentage[$advisor->id] = 0;
                    $notprocessPercentage[$advisor->id] = 0;
                    $processPercentage[$advisor->id] = 0;
                    $preregisterPercentage[$advisor->id] = 0;
                    $registerPercentage[$advisor->id] = 0;
                    $rejectPercentage[$advisor->id] = 0;
                }
        }

        // Calculate total count
        $totalCountAssign = array_sum($assigns);
        $totalCountNotProcess = array_sum($notprocess);
        $totalCountProcess = array_sum($process);
        $totalCountPreRegister = array_sum($preregisters);
        $totalCountRegister = array_sum($registers);
        $totalCountReject = array_sum($rejects);

        if ($totalCountAssign > 0) {
            $totalCountAssignPercentage = array_sum($assigns)/array_sum($assigns)*100;
            $totalCountNotProcessPercentage = round(array_sum($notprocess)/array_sum($assigns)*100,2); 
            $totalCountProcessPercentage = round(array_sum($process)/array_sum($assigns)*100,2); 
            $totalCountPreRegisterPercentage = round(array_sum($preregisters)/array_sum($assigns)*100,2);
            $totalCountRegisterPercentage = round(array_sum($registers)/array_sum($assigns)*100,2);
            $totalCountRejectPercentage = round(array_sum($rejects)/array_sum($assigns)*100,2);
        } else {
            $totalCountAssignPercentage = 0;
            $totalCountNotProcessPercentage = 0;
            $totalCountProcessPercentage = 0;
            $totalCountPreRegisterPercentage = 0;
            $totalCountRegisterPercentage = 0;
            $totalCountRejectPercentage = 0;
        }
        // Calculate total count percentage

        return view('admin.achievements', compact('advisors', 'assigns', 'locations', 'totalCountAssign', 'notprocess', 'totalCountNotProcess', 'process', 'totalCountProcess', 'preregisters', 'totalCountPreRegister', 'registers', 'totalCountRegister', 'rejects', 'totalCountReject', 'start_date', 'end_date', 'assignPercentage', 'notprocessPercentage', 'processPercentage', 'preregisterPercentage', 'registerPercentage', 'rejectPercentage', 'totalCountAssignPercentage', 'totalCountNotProcessPercentage', 'totalCountProcessPercentage', 'totalCountPreRegisterPercentage', 'totalCountRegisterPercentage', 'totalCountRejectPercentage', 'location_name', 'location'));
    }

    public function achievementDetails(Request $request, $id, $start_date = null, $end_date = null, $location = null)
    {
        $user = User::where('id', $id)
            ->where('type', 1)
            ->first();

        $applications = DB::table('students')
            ->leftjoin('status', 'students.status_id', '=', 'status.id')
            ->leftjoin('users', 'users.referral_code', '=', 'students.referral_code')
            ->where('students.user_id', $id)
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
            ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
            ->select('students.name', 'students.created_at', 'students.updated_at', 'users.name AS affiliate', 'students.source', 'students.status_id', 'status.name AS status',
            DB::raw('DATEDIFF(CURDATE(), students.updated_at) AS days_since_update'))
            ->orderByDesc('students.id');

                if ($location == 3) {
                    $applications ->whereIn('students.location_id', [1, 2]);
                } else {
                    $applications ->where('students.location_id', '=', $location);
                }

            $applications = $applications->get();

        return view('admin.achievementDetails', compact('user', 'applications'));
    }

    public function affiliateAchievements(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $location = $request->input('location');

        $locations = DB::table('location')->get();

        $location_name = [
            1 => 'KUPD',
            2 => 'KUKB',
            3 => 'KUPD & KUKB'
        ][$location] ?? '';

        $statusProcess = [7,8,9,10,12,13,14,15,16,17,18];
        $statusPre = [19];
        $statusRegister = [20,21,22];
        $statusReject = [1,2,3,4,5,6,11,23,24,25,26,27];

        // Common base query for students
        $baseQuery = function ($query) use ($start_date, $end_date, $location) {
            $query->whereNotNull('students.ic')
                ->where('students.ic', '!=', '')
                ->when($location == 3, fn($q) => $q->whereIn('students.location_id', [1, 2]))
                ->when(in_array($location, [1, 2]), fn($q) => $q->where('students.location_id', $location))
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        };

        // Fetch all affiliate student counts in ONE query grouped by referral_code
        $studentCounts = DB::table('students')
        ->select(
            'referral_code',
            DB::raw('COUNT(*) as total_students'),
            DB::raw("SUM(CASE WHEN status_id IS NULL OR status_id IN (" . implode(',', $statusProcess) . ") THEN 1 ELSE 0 END) as total_students_process"),
            DB::raw("SUM(CASE WHEN status_id IN (" . implode(',', $statusPre) . ") THEN 1 ELSE 0 END) as total_students_pre"),
            DB::raw("SUM(CASE WHEN status_id IN (" . implode(',', $statusRegister) . ") THEN 1 ELSE 0 END) as total_students_register"),
            DB::raw("SUM(CASE WHEN status_id IN (" . implode(',', $statusReject) . ") THEN 1 ELSE 0 END) as total_students_reject")
        )
        ->where($baseQuery)
        ->groupBy('referral_code')
        ->get()
        ->keyBy('referral_code');

        // Fetch all affiliates and attach their counts
        $affiliates = User::where('type', 0)
            ->orderBy('name')
            ->get()
            ->map(function ($affiliate) use ($studentCounts) {
                $counts = $studentCounts[$affiliate->referral_code] ?? (object) [
                    'total_students' => 0,
                    'total_students_process' => 0,
                    'total_students_pre' => 0,
                    'total_students_register' => 0,
                    'total_students_reject' => 0,
                ];

                $affiliate->total_students = $counts->total_students;
                $affiliate->total_students_process = $counts->total_students_process;
                $affiliate->total_students_pre = $counts->total_students_pre;
                $affiliate->total_students_register = $counts->total_students_register;
                $affiliate->total_students_reject = $counts->total_students_reject;

                return $affiliate;
            });

        // Total counts across all affiliates (reuse baseQuery)
        $totals = DB::table('students')
            ->join('users', 'students.referral_code', '=', 'users.referral_code')
            ->where('users.type', 0)
            ->where($baseQuery)
            ->selectRaw('
                COUNT(*) as totalStudents,
                SUM(CASE WHEN status_id IS NULL OR status_id IN (' . implode(',', $statusProcess) . ') THEN 1 ELSE 0 END) as totalStudentProcess,
                SUM(CASE WHEN status_id IN (' . implode(',', $statusPre) . ') THEN 1 ELSE 0 END) as totalStudentPre,
                SUM(CASE WHEN status_id IN (' . implode(',', $statusRegister) . ') THEN 1 ELSE 0 END) as totalStudentRegister,
                SUM(CASE WHEN status_id IN (' . implode(',', $statusReject) . ') THEN 1 ELSE 0 END) as totalStudentReject
            ')
            ->first();

        return view('admin.affiliateachievements', [
            'affiliates' => $affiliates,
            'locations' => $locations,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'location_name' => $location_name,
            'location' => $location,
            'totalStudents' => $totals->totalStudents,
            'totalStudentProcess' => $totals->totalStudentProcess,
            'totalStudentPre' => $totals->totalStudentPre,
            'totalStudentRegister' => $totals->totalStudentRegister,
            'totalStudentReject' => $totals->totalStudentReject,
        ]);
    }

    public function affiliateAchievementDetails(Request $request, $id, $start_date = null, $end_date = null, $location = null)
    {
        $affiliate = User::where('id', $id)
            ->where('type', 0)
            ->first();

        if (!$affiliate) {
            return redirect()->back()->with('error', 'Affiliate not found.');
        }

        $applications = DB::table('students')
            ->where('students.referral_code', $affiliate->referral_code)
            ->where(function ($query) {
                        $query->whereNotNull('students.ic')
                            ->where('students.ic', '!=', '');
                    })
            ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
            ->select('students.name', 'students.created_at', 'students.source', 'students.incentive', 'students.commission')
            ->orderByDesc('students.id');

                if ($location == 3) {
                    $applications ->whereIn('students.location_id', [1, 2]);
                } else {
                    $applications ->where('students.location_id', '=', $location);
                }

            $totalIncentive = number_format($applications->sum('students.incentive'), 2, '.', '');
            $totalCommission = $applications->sum('students.commission');

        $applications = $applications->get();

        return view('admin.affiliateachievementDetails', compact('affiliate', 'applications', 'totalIncentive', 'totalCommission'));
    }

}
