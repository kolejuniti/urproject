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
use App\Models\Content;

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
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $referralCode = $user->referral_code;

        $currentYear = $request->input('year') ?? Carbon::now()->year;

        // Array of Malay month names
        $malayMonths = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Mac',
            4 => 'April',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Julai',
            8 => 'Ogos',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Disember',
        ];

        // Build dynamic last 12 months data
        $monthlyStatsKUPD = [];
        $monthlySuccessStatsKUPD = [];

        for ($i = 1; $i <= 12; $i++) {
            $count = DB::table('students')
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where('students.location_id', 1) // KUPD location_id
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', $currentYear)
                ->count();

            $successCount = DB::table('students')
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where('students.location_id', 1) // KUPD location_id
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', $currentYear)
                ->count();

            $monthlyStatsKUPD[] = [
                'month_name' => $malayMonths[$i],
                'month_number' => $i,
                'count' => $count
            ];

            $monthlySuccessStatsKUPD[] = [
                'month_name' => $malayMonths[$i],
                'month_number' => $i,
                'count' => $successCount
            ];
        }

        $monthlyStatsKUKB = [];
        $monthlySuccessStatsKUKB = [];

        for ($i = 1; $i <= 12; $i++) {
            $count = DB::table('students')
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where('students.location_id', 2) // KUKB location_id
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', $currentYear)
                ->count();

            $successCount = DB::table('students')
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where('students.location_id', 2) // KUKB location_id
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', $currentYear)
                ->count();

            $monthlyStatsKUKB[] = [
                'month_name' => $malayMonths[$i],
                'month_number' => $i,
                'count' => $count
            ];

            $monthlySuccessStatsKUKB[] = [
                'month_name' => $malayMonths[$i],
                'month_number' => $i,
                'count' => $successCount
            ];
        }

        $locations = [
            1 => 'KUPD',
            2 => 'KUKB'
        ];

        // Last registered student via user link
        $lastRegisteredStudents = [];

        foreach ($locations as $id => $name) {
            $student = DB::table('students')
                ->where('location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->latest('created_at')
                ->first();

            $lastRegisteredStudents[$name] = $student
                ? Carbon::parse($student->created_at)->format('d-m-Y')
                : '-';
        }

        // Total registered students
        $totalRegistered = [];
        $totalRegisteredBreakdown = [];

        foreach ($locations as $id => $name) {
            $count = DB::table('students')
                ->where('location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->count();

            $totalRegistered[$name] = $count;

            $affiliateCount = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->where('affiliate.type', '=', 0)
                ->count();

            $eaCount = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->whereIn('advisor.type', [1, 2])
                ->count();

            $nonEaAffiliateCount = max(0, $count - $affiliateCount - $eaCount);

            $totalRegisteredBreakdown[$name] = [
                'ea' => $eaCount,
                'affiliate' => $affiliateCount,
                'non' => $nonEaAffiliateCount,
                'total' => $count,
            ];
        }

        $totalRegisteredCurrentYear = [];
        $totalRegisteredCurrentYearBreakdown = [];

        foreach ($locations as $id => $name) {
            $count = DB::table('students')
                ->where('location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereYear('created_at', $currentYear)
                ->count();

            $totalRegisteredCurrentYear[$name] = $count;

            $affiliateCount = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereYear('students.created_at', $currentYear)
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->where('affiliate.type', '=', 0)
                ->count();

            $eaCount = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereYear('students.created_at', $currentYear)
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->whereIn('advisor.type', [1, 2])
                ->count();

            $nonEaAffiliateCount = max(0, $count - $affiliateCount - $eaCount);

            $totalRegisteredCurrentYearBreakdown[$name] = [
                'ea' => $eaCount,
                'affiliate' => $affiliateCount,
                'non' => $nonEaAffiliateCount,
                'total' => $count,
            ];
        }

        $totalSuccessRegistered = [];
        $totalSuccessRegisteredBreakdown = [];

        foreach ($locations as $id => $name) {
            $count = DB::table('students')
                ->where('location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereIn('status_id', [20, 21, 22])
                ->count();

            $totalSuccessRegistered[$name] = $count;

            $affiliateCount = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->where('affiliate.type', '=', 0)
                ->count();

            $eaCount = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->whereIn('advisor.type', [1, 2])
                ->count();

            $nonEaAffiliateCount = max(0, $count - $affiliateCount - $eaCount);

            $totalSuccessRegisteredBreakdown[$name] = [
                'ea' => $eaCount,
                'affiliate' => $affiliateCount,
                'non' => $nonEaAffiliateCount,
                'total' => $count,
            ];
        }

        $totalSuccessRegisteredCurrentYear = [];
        $totalSuccessRegisteredCurrentYearBreakdown = [];

        foreach ($locations as $id => $name) {
            $count = DB::table('students')
                ->where('location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereIn('status_id', [20, 21, 22])
                ->whereYear('created_at', $currentYear)
                ->count();

            $totalSuccessRegisteredCurrentYear[$name] = $count;

            $affiliateCount = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereYear('students.created_at', $currentYear)
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->where('affiliate.type', '=', 0)
                ->count();

            $eaCount = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.location_id', $id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereYear('students.created_at', $currentYear)
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', '')
                ->where('students.referral_code', '!=', 'null')
                ->whereIn('advisor.type', [1, 2])
                ->count();

            $nonEaAffiliateCount = max(0, $count - $affiliateCount - $eaCount);

            $totalSuccessRegisteredCurrentYearBreakdown[$name] = [
                'ea' => $eaCount,
                'affiliate' => $affiliateCount,
                'non' => $nonEaAffiliateCount,
                'total' => $count,
            ];
        }

        // Top 5 students (latest registrations)
        $topStudents = DB::table('students')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            })
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'user',
            'monthlyStatsKUPD',
            'monthlySuccessStatsKUPD',
            'monthlyStatsKUKB',
            'monthlySuccessStatsKUKB',
            'lastRegisteredStudents',
            'totalRegistered',
            'totalRegisteredBreakdown',
            'currentYear',
            'totalRegisteredCurrentYear',
            'totalRegisteredCurrentYearBreakdown',
            'topStudents',
            'totalSuccessRegistered',
            'totalSuccessRegisteredBreakdown',
            'totalSuccessRegisteredCurrentYear',
            'totalSuccessRegisteredCurrentYearBreakdown'
        ));
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

        $url = url('/') . '?ref=' . $ref; // Generates the referral URL

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
            ->select(
                'students.id',
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
                'state.name AS state',
                'users.name AS user',
                'location.code AS location',
                'student_foundations.foundation AS note',
                'students.remark AS remark'
            )
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
                ->whereIn('type', [0, 1])
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
                DB::raw("DATE_FORMAT(students.created_at, '%d-%m-%Y %H:%i') as created_at"),
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
            ->where(function ($query) {
                $query->where('name', 'like', 'KB-%')
                    ->orWhere('name', 'like', 'PD-%');
            })
            ->whereIn('accept_data', [0, 1])
            ->whereIn('affiliate_data', [0, 1])
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

        $ids = [29, 30, 31, 11, 19, 20, 21, 22, 32, 33, 25];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $statusApplications = DB::table('status')
            ->whereIn('id', $ids)
            ->orderByRaw("FIELD(id, $placeholders)", $ids)
            ->get();

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
                ->update(['register_at' => $register_at, 'commission' => '500', 'status_id' => $statusApplication]);

            return redirect()->route('admin.application')->with('success', 'Tarikh pendaftaran berjaya dikemaskini.');
        } elseif ($statusApplication !== null) {
            $studentStatus = DB::table('students')
                ->where('students.id', $id)
                ->update(['status_id' => $statusApplication]);

            return redirect()->route('admin.application')->with('success', 'Status permohonan pelajar berjaya dikemaskini.');
        } else {
            $studentPIC = DB::table('students')
                ->where('students.id', $id)
                ->update(['user_id' => $pic, 'updated_at' => date('Y-m-d H:i:s'), 'auto_assign' => 0]);

            return redirect()->route('admin.application')->with('success', 'Agihan pegawai perhubungan kepada pelajar telah berjaya.');
        }
    }

    public function bulkAssignKupd(Request $request)
    {
        $pendingQuery = DB::table('students')
            ->where('location_id', 1)
            ->where('user_id', 0)
            ->whereNotNull('ic')
            ->where('ic', '!=', '');

        if ($request->isMethod('get')) {
            $pendingCount = $pendingQuery->count();
            return view('admin.bulk-assign-kupd', compact('pendingCount'));
        }

        $students = $pendingQuery->orderBy('id')->get();

        if ($students->isEmpty()) {
            return redirect()->back()->with('success', 'Tiada pelajar untuk diagihkan.');
        }

        $prefix = 'PD-';
        $currentUserID = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('users.name', 'users.id', DB::raw("SUBSTRING_INDEX(users.name, ' ', 1) AS advisor_code"))
            ->whereNull('students.referral_code')
            ->where('users.type', '1')
            ->where('users.name', 'LIKE', 'PD-%')
            ->orderByDesc('students.id')
            ->limit(1)
            ->first();

        $startNumber = 0;

        if ($currentUserID && isset($currentUserID->advisor_code) && str_starts_with($currentUserID->advisor_code, $prefix)) {
            $startNumber = (int) str_replace($prefix, '', $currentUserID->advisor_code);
        }

        $maxNumber = DB::table('users')
            ->select(DB::raw('SUBSTRING(name, 4, 2) as code'))
            ->where('type', 1)
            ->where('name', 'like', 'PD-%')
            ->where('accept_data', 1)
            ->orderByDesc(DB::raw('SUBSTRING(name, 4, 2)'))
            ->limit(1)
            ->value('code');

        $maxNumber = (int) $maxNumber;

        if ($maxNumber <= 0) {
            return redirect()->back()->with('msg_error', 'Tiada pegawai perhubungan yang aktif untuk agihan.');
        }

        $assignedCount = 0;
        $skippedCount = 0;
        $lastAssignedCode = null;

        foreach ($students as $student) {
            $nextId = null;
            $nextNumber = null;
            $nextCode = null;

            for ($i = $startNumber + 1; $i <= $maxNumber; $i++) {
                $newCode = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);

                $user = DB::table('users')
                    ->where('name', 'like', $newCode . '%')
                    ->where('type', '1')
                    ->where('accept_data', 1)
                    ->first();

                if ($user) {
                    $nextId = $user->id;
                    $nextNumber = $i;
                    $nextCode = $newCode;
                    break;
                }
            }

            if (!$nextId) {
                for ($i = 1; $i <= $startNumber; $i++) {
                    $newCode = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);

                    $user = DB::table('users')
                        ->where('name', 'like', $newCode . '%')
                        ->where('type', 1)
                        ->where('accept_data', 1)
                        ->first();

                    if ($user) {
                        $nextId = $user->id;
                        $nextNumber = $i;
                        $nextCode = $newCode;
                        break;
                    }
                }
            }

            if (!$nextId) {
                $skippedCount++;
                continue;
            }

            DB::table('students')
                ->where('id', $student->id)
                ->update([
                    'user_id' => $nextId,
                    'referral_code' => null,
                    'updated_at' => now(),
                    'auto_assign' => 0,
                    'status_id' => null,
                    'remark' => 'N'
                ]);

            $assignedCount++;
            $startNumber = $nextNumber;
            $lastAssignedCode = $nextCode;
        }

        $message = "Agihan selesai. Jumlah dikemaskini: {$assignedCount}.";
        if ($skippedCount > 0) {
            $message .= " Tidak dapat diagihkan: {$skippedCount}.";
        }
        if ($lastAssignedCode) {
            $message .= " Kod terakhir: {$lastAssignedCode}.";
        }

        return redirect()->back()->with('success', $message);
    }

    public function bulkAssignKukb(Request $request)
    {
        $pendingQuery = DB::table('students')
            ->where('location_id', 2)
            ->where('user_id', 0)
            ->whereNotNull('ic')
            ->where('ic', '!=', '');

        if ($request->isMethod('get')) {
            $pendingCount = $pendingQuery->count();
            return view('admin.bulk-assign-kukb', compact('pendingCount'));
        }

        $students = $pendingQuery->orderBy('id')->get();

        if ($students->isEmpty()) {
            return redirect()->back()->with('success', 'Tiada pelajar untuk diagihkan.');
        }

        $prefix = 'KB-';
        $currentUserID = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('users.name', 'users.id', DB::raw("SUBSTRING_INDEX(users.name, ' ', 1) AS advisor_code"))
            ->whereNull('students.referral_code')
            ->where('users.type', '1')
            ->where('users.name', 'LIKE', 'KB-%')
            ->orderByDesc('students.id')
            ->limit(1)
            ->first();

        $startNumber = 0;

        if ($currentUserID && isset($currentUserID->advisor_code) && str_starts_with($currentUserID->advisor_code, $prefix)) {
            $startNumber = (int) str_replace($prefix, '', $currentUserID->advisor_code);
        }

        $maxNumber = DB::table('users')
            ->select(DB::raw('SUBSTRING(name, 4, 2) as code'))
            ->where('type', 1)
            ->where('name', 'like', 'KB-%')
            ->where('accept_data', 1)
            ->orderByDesc(DB::raw('SUBSTRING(name, 4, 2)'))
            ->limit(1)
            ->value('code');

        $maxNumber = (int) $maxNumber;

        if ($maxNumber <= 0) {
            return redirect()->back()->with('msg_error', 'Tiada pegawai perhubungan yang aktif untuk agihan.');
        }

        $assignedCount = 0;
        $skippedCount = 0;
        $lastAssignedCode = null;

        foreach ($students as $student) {
            $nextId = null;
            $nextNumber = null;
            $nextCode = null;

            for ($i = $startNumber + 1; $i <= $maxNumber; $i++) {
                $newCode = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);

                $user = DB::table('users')
                    ->where('name', 'like', $newCode . '%')
                    ->where('type', '1')
                    ->where('accept_data', 1)
                    ->first();

                if ($user) {
                    $nextId = $user->id;
                    $nextNumber = $i;
                    $nextCode = $newCode;
                    break;
                }
            }

            if (!$nextId) {
                for ($i = 1; $i <= $startNumber; $i++) {
                    $newCode = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);

                    $user = DB::table('users')
                        ->where('name', 'like', $newCode . '%')
                        ->where('type', 1)
                        ->where('accept_data', 1)
                        ->first();

                    if ($user) {
                        $nextId = $user->id;
                        $nextNumber = $i;
                        $nextCode = $newCode;
                        break;
                    }
                }
            }

            if (!$nextId) {
                $skippedCount++;
                continue;
            }

            DB::table('students')
                ->where('id', $student->id)
                ->update([
                    'user_id' => $nextId,
                    'referral_code' => null,
                    'updated_at' => now(),
                    'auto_assign' => 0,
                    'status_id' => null,
                    'remark' => 'N'
                ]);

            $assignedCount++;
            $startNumber = $nextNumber;
            $lastAssignedCode = $nextCode;
        }

        $message = "Agihan selesai. Jumlah dikemaskini: {$assignedCount}.";
        if ($skippedCount > 0) {
            $message .= " Tidak dapat diagihkan: {$skippedCount}.";
        }
        if ($lastAssignedCode) {
            $message .= " Kod terakhir: {$lastAssignedCode}.";
        }

        return redirect()->back()->with('success', $message);
    }

    public function bulkAssign(Request $request)
    {
        if ($request->isMethod('get')) {
            $pendingCountKupd = DB::table('students')
                ->where('location_id', 1)
                ->where('user_id', 0)
                ->whereNotNull('ic')
                ->where('ic', '!=', '')
                ->count();

            $pendingCountKukb = DB::table('students')
                ->where('location_id', 2)
                ->where('user_id', 0)
                ->whereNotNull('ic')
                ->where('ic', '!=', '')
                ->count();

            $duplicateIcs = DB::table('students')
                ->select('ic')
                ->whereNotNull('ic')
                ->where('ic', '!=', '')
                ->groupBy('ic')
                ->havingRaw('COUNT(*) > 1');

            $duplicatesByIc = DB::table('students')
                ->leftJoin('users AS advisor', 'students.user_id', '=', 'advisor.id')
                ->leftJoin('status', 'students.status_id', '=', 'status.id')
                ->select(
                    'students.id',
                    'students.name',
                    'students.ic',
                    'students.created_at',
                    'students.location_id',
                    'students.updated_at',
                    'advisor.name AS advisor_name',
                    'students.status_id',
                    'status.name AS status'
                )
                ->whereIn('students.ic', $duplicateIcs)
                ->orderBy('students.ic')
                ->orderBy('students.created_at')
                ->get();

            return view('admin.bulk-assign', compact('pendingCountKupd', 'pendingCountKukb', 'duplicatesByIc'));
        }

        $request->validate([
            'location_id' => 'required|in:1,2'
        ]);

        if ((int) $request->input('location_id') === 1) {
            return $this->bulkAssignKupd($request);
        }

        return $this->bulkAssignKukb($request);
    }

    public function deleteStudent($id)
    {
        DB::table('students')
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Data pelajar berjaya dipadam.');
    }

    public function bulkDeleteStudents(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'integer'
        ]);

        $ids = $request->input('student_ids', []);

        DB::table('students')
            ->whereIn('id', $ids)
            ->delete();

        return redirect()->back()->with('success', 'Data pelajar terpilih berjaya dipadam.');
    }

    public function userlist()
    {
        $banks = DB::table('bank')->get();

        $users = User::whereIn('type', [0, 1])
            ->join('religion', 'users.religion_id', '=', 'religion.id')
            ->join('nation', 'users.nation_id', '=', 'nation.id')
            ->join('sex', 'users.sex_id', '=', 'sex.id')
            ->join('bank', 'users.bank_id', '=', 'bank.id')
            ->leftjoin('user_address', 'users.ic', '=', 'user_address.user_ic')
            ->leftjoin('state', 'user_address.state_id', '=', 'state.id')
            ->select('users.*', DB::raw("CONCAT('', users.bank_account) as bank_account"), 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank', 'user_address.address1', 'user_address.address2', 'user_address.postcode', 'user_address.city', 'state.name AS state')
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
        $leaders = User::where('type', 1)->orderBy('name')->get(['id', 'name']);

        $users = User::whereIn('type', [0, 1])
            ->join('religion', 'users.religion_id', '=', 'religion.id')
            ->join('nation', 'users.nation_id', '=', 'nation.id')
            ->join('sex', 'users.sex_id', '=', 'sex.id')
            ->join('bank', 'users.bank_id', '=', 'bank.id')
            ->leftjoin('user_address', 'users.ic', '=', 'user_address.user_ic')
            ->leftjoin('state', 'user_address.state_id', '=', 'state.id')
            ->select('users.*', 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank', 'user_address.address1', 'user_address.address2', 'user_address.postcode', 'user_address.city', 'state.name AS state')
            ->where('users.ic', 'LIKE', "{$ic}")
            ->first();

        if ($request->ajax()) {
            return response()->json(['banks' => $banks, 'users' => $users, 'leaders' => $leaders]);
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
        $leader_id = $request->input('leader_id');
        $leader_id = $leader_id !== null && $leader_id !== '' ? (int) $leader_id : null;

        if ($position === "AFFILIATE UNITI") {
            $type = 0;
        } elseif ($position === "MANAGER" || $position === "EDUCATION ADVISOR") {
            $type = 1;
        }

        $updateData = [
            'name' => $name,
            'phone' => $phone,
            'bank_account' => $bank_account,
            'bank_id' => $bank,
            'type' => $type,
            'position' => $position,
            'status' => $status,
            'accept_data' => $accept_data,
            'affiliate_data' => $affiliate_data,
        ];

        if ($request->has('leader_id')) {
            $updateData['leader_id'] = $leader_id;
        }

        $user = DB::table('users')
            ->where('users.id', $id)
            ->update($updateData);

        return redirect()->route('admin.userlist')->with('success', 'Maklumat pengguna berjaya dikemaskini.');
    }

    public function studentlist(Request $request)
    {
        // Retrieve the start and end dates from the form input
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $show_affiliate_only = $request->input('show_affiliate_only');
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

        // If both dates are null, set the default to last 7 days
        if (!$start_date && !$end_date) {
            $start_date = now()->subDays(7)->startOfDay()->format('Y-m-d');
            $end_date = now()->endOfDay()->format('Y-m-d');
        }

        if (is_null($location)) {
            $location = 3;
        }

        $students = DB::table('students')
            ->leftjoin('status', 'students.status_id', '=', 'status.id')
            ->leftJoin('state', 'students.state_id', '=', 'state.id')
            ->join('location', 'students.location_id', '=', 'location.id')
            ->select('students.id', 'students.name', 'students.ic', 'students.phone', 'students.email', 'students.created_at', 'students.updated_at', 'status.name AS status', 'students.reason', 'students.register_at', 'students.referral_code', 'students.user_id', 'location.code AS location', 'students.city', 'state.name AS state')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            });

        if ($location == 3) {
            $students->whereIn('students.location_id', [1, 2]);
        } else {
            $students->where('students.location_id', '=', $location);
        }

        if ($show_affiliate_only == 1) {
            $students->join('users', 'students.referral_code', '=', 'users.referral_code')
                ->where('users.type', 0);
        }

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
                ->whereIn('type', [0, 1])
                ->get();

            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $affiliates[$student->id] = $affiliate;

            $advisor = User::where('id', $student->user_id)
                ->whereIn('type', [1])
                ->get();

            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $advisors[$student->id] = $advisor;
        }

        return view('admin.studentlist', compact('students', 'affiliates', 'advisors', 'start_date', 'end_date', 'locations', 'location_name'));
    }

    public function multiDatabaseReport(Request $request)
    {
        $report = [];
        $counter = 1;

        // Get students from mysql2 (KUPD) where semester = 1
        $studentsMysql2 = DB::connection('mysql2')
            ->table('students')
            ->where('semester', 1)
            ->where(function ($query) {
                $query->whereNotNull('ic')
                    ->where('ic', '!=', '');
            })
            ->orderByDesc('id')
            ->get();

        foreach ($studentsMysql2 as $student) {
            // Check if IC exists in mysql (default)
            $existsInMysql = DB::table('students')
                ->where('ic', $student->ic)
                ->exists();

            $source = $existsInMysql ? 'edaftar' : 'ucms-kupd';

            // Get status from mysql2's tblstudent_status
            $statusRecord = DB::connection('mysql2')
                ->table('tblstudent_status')
                ->where('id', $student->status)
                ->first();

            $status = $statusRecord ? ($statusRecord->name ?? 'N/A') : 'N/A';

            // Get created_at from mysql (default) students
            $mysqlStudent = DB::table('students')
                ->where('ic', $student->ic)
                ->first();

            $tarikDataMasuk = $mysqlStudent ? \Carbon\Carbon::parse($mysqlStudent->created_at)->format('d-m-Y') : 'N/A';
            $tarikDaftarKolej = $student->date_add ? \Carbon\Carbon::parse($student->date_add)->format('d-m-Y') : 'N/A';
            $tarikTawaran = $student->date_offer ? \Carbon\Carbon::parse($student->date_offer)->format('d-m-Y') : 'N/A';

            $report[] = [
                'no' => $counter,
                'name' => $student->name ?? 'N/A',
                'ic' => $student->ic,
                'status' => $status,
                'source' => $source,
                'tarik_data_masuk' => $tarikDataMasuk,
                'tarik_daftar_kolej' => $tarikDaftarKolej,
                'tarik_tawaran' => $tarikTawaran,
                'location' => 'KUPD',
            ];

            $counter++;
        }

        // Get students from mysql3 (KUKB) where semester = 1
        $studentsMysql3 = DB::connection('mysql3')
            ->table('students')
            ->where('semester', 1)
            ->where(function ($query) {
                $query->whereNotNull('ic')
                    ->where('ic', '!=', '');
            })
            ->orderByDesc('id')
            ->get();

        foreach ($studentsMysql3 as $student) {
            // Check if IC exists in mysql (default)
            $existsInMysql = DB::table('students')
                ->where('ic', $student->ic)
                ->exists();

            $source = $existsInMysql ? 'edaftar' : 'ucms-kukb';

            // Get status from mysql3's tblstudent_status
            $statusRecord = DB::connection('mysql3')
                ->table('tblstudent_status')
                ->where('id', $student->status)
                ->first();

            $status = $statusRecord ? ($statusRecord->name ?? 'N/A') : 'N/A';

            // Get created_at from mysql (default) students
            $mysqlStudent = DB::table('students')
                ->where('ic', $student->ic)
                ->first();

            $tarikDataMasuk = $mysqlStudent ? \Carbon\Carbon::parse($mysqlStudent->created_at)->format('d-m-Y') : 'N/A';
            $tarikDaftarKolej = $student->date_add ? \Carbon\Carbon::parse($student->date_add)->format('d-m-Y') : 'N/A';
            $tarikTawaran = $student->date_offer ? \Carbon\Carbon::parse($student->date_offer)->format('d-m-Y') : 'N/A';

            $report[] = [
                'no' => $counter,
                'name' => $student->name ?? 'N/A',
                'ic' => $student->ic,
                'status' => $status,
                'source' => $source,
                'tarik_data_masuk' => $tarikDataMasuk,
                'tarik_daftar_kolej' => $tarikDaftarKolej,
                'tarik_tawaran' => $tarikTawaran,
                'location' => 'KUKB',
            ];

            $counter++;
        }

        return view('admin.multidatabase-report', compact('report'));
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
            ->update(['phone' => $phone, 'bank_account' => $bank_account, 'bank_id' => $bank]);

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
            $status->percentage = $totalStudents > 0 ? ($status->total / $totalStudents) * 100 : 0;
            return $status;
        });

        // Summary of students by locations with date range filter
        $locations = DB::table('students')
            ->join('location', 'students.location_id', '=', 'location.id')
            ->select(
                DB::raw('count(students.id) AS total'),
                'location.name AS location',
                DB::raw('SUM(CASE WHEN students.status_id = 19 THEN 1 ELSE 0 END) AS total_pra_daftar'),
                DB::raw('SUM(CASE WHEN students.status_id IN (20,21,22) THEN 1 ELSE 0 END) AS total_daftar_kolej')
            )
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
            $location->percentage = $totalStudents > 0 ? ($location->total / $totalStudents) * 100 : 0;
            return $location;
        });

        // Totals for new location columns (same filters as totalStudents)
        $praDaftarTotal = DB::table('students')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            })
            ->where('students.status_id', 19);

        $daftarKolejTotal = DB::table('students')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            })
            ->whereIn('students.status_id', [20, 21, 22]);

        if ($start_date && $end_date) {
            $praDaftarTotal->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
            $daftarKolejTotal->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
        } elseif ($start_date) {
            $praDaftarTotal->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
            $daftarKolejTotal->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
        }

        $totalPraDaftar = $praDaftarTotal->count();
        $totalDaftarKolej = $daftarKolejTotal->count();

        // Summary of students by sources with KUPD and KUKB, including date range filter
        $sources = DB::table('students')
            ->select(
                'students.source',
                DB::raw('COUNT(students.id) AS total'),
                DB::raw('SUM(CASE WHEN students.status_id = 19 THEN 1 ELSE 0 END) AS total_pra_daftar'),
                DB::raw('SUM(CASE WHEN students.status_id IN (20,21,22) THEN 1 ELSE 0 END) AS total_register'),
                DB::raw('SUM(CASE WHEN students.location_id = 1 THEN 1 ELSE 0 END) AS total_kupd'), // Count for KUPD (location_id = 1)
                DB::raw('SUM(CASE WHEN students.location_id = 2 THEN 1 ELSE 0 END) AS total_kukb'),  // Count for KUKB (location_id = 2)
                DB::raw('SUM(CASE WHEN students.location_id = 1 AND students.status_id = 19 THEN 1 ELSE 0 END) AS total_kupd_pra_daftar'), // KUPD pra daftar
                DB::raw('SUM(CASE WHEN students.location_id = 2 AND students.status_id = 19 THEN 1 ELSE 0 END) AS total_kukb_pra_daftar'), // KUKB pra daftar
                DB::raw('SUM(CASE WHEN students.location_id = 1 AND students.status_id IN (20,22) THEN 1 ELSE 0 END) AS total_kupd_register'), // KUPD register
                DB::raw('SUM(CASE WHEN students.location_id = 2 AND students.status_id IN (21,22) THEN 1 ELSE 0 END) AS total_kukb_register')  // KUKB register
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

        // Sum all total_kupd
        $totalSourceKupdSum = $sources->sum('total_kupd');
        $totalSourceKukbSum = $sources->sum('total_kukb');
        $totalSourceSum = $sources->sum('total_kupd') + $sources->sum('total_kukb');
        $totalSourceKupdRegisterSum = $sources->sum('total_kupd_register');
        $totalSourceKukbRegisterSum = $sources->sum('total_kukb_register');
        $totalSourceRegisterSum = $sources->sum('total_kupd_register') + $sources->sum('total_kukb_register');
        $totalSourcePraDaftarSum = $sources->sum('total_pra_daftar');
        $totalSourceKupdPraDaftarSum = $sources->sum('total_kupd_pra_daftar');
        $totalSourceKukbPraDaftarSum = $sources->sum('total_kukb_pra_daftar');

        // Calculate percentage for each source
        $sourcessWithPercentage = $sources->map(function ($source) use ($totalStudents) {
            $source->percentage = $totalStudents > 0 ? ($source->total / $totalStudents) * 100 : 0;
            $source->pra_percentage = $totalStudents > 0 ? ($source->total_pra_daftar / $totalStudents) * 100 : 0;
            $source->register_percentage = $totalStudents > 0 ? ($source->total_register / $totalStudents) * 100 : 0;
            return $source;
        });

        // Calculate percentage for each state (total_register)
        $statesWithRegisterPercentage = $sources->map(function ($source) use ($totalStudents) {
            $source->register_percentage = $totalStudents > 0 ? ($source->total_register / $totalStudents) * 100 : 0;
            return $source;
        });

        // Summary of students by states with KUPD and KUKB, including date range filter
        $states = DB::table('students')
            ->leftjoin('state', 'students.state_id', '=', 'state.id')
            ->select(
                'state.name AS state',
                DB::raw('COUNT(students.id) AS total'),
                DB::raw('SUM(CASE WHEN students.status_id = 19 THEN 1 ELSE 0 END) AS total_pra_daftar'),
                DB::raw('SUM(CASE WHEN students.status_id IN (20,21,22) THEN 1 ELSE 0 END) AS total_register'),
                DB::raw('SUM(CASE WHEN students.location_id = 1 THEN 1 ELSE 0 END) AS total_kupd'), // Count for KUPD (location_id = 1)
                DB::raw('SUM(CASE WHEN students.location_id = 2 THEN 1 ELSE 0 END) AS total_kukb'),  // Count for KUKB (location_id = 2)
                DB::raw('SUM(CASE WHEN students.location_id = 1 AND students.status_id = 19 THEN 1 ELSE 0 END) AS total_kupd_pra_daftar'), // KUPD pra daftar
                DB::raw('SUM(CASE WHEN students.location_id = 2 AND students.status_id = 19 THEN 1 ELSE 0 END) AS total_kukb_pra_daftar'), // KUKB pra daftar
                DB::raw('SUM(CASE WHEN students.location_id = 1 AND students.status_id IN (20,22) THEN 1 ELSE 0 END) AS total_kupd_register'), // KUPD register
                DB::raw('SUM(CASE WHEN students.location_id = 2 AND students.status_id IN (21,22) THEN 1 ELSE 0 END) AS total_kukb_register')  // KUKB register
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

        // Sum all total_kupd
        $totalStateKupdSum = $states->sum('total_kupd');
        $totalStateKukbSum = $states->sum('total_kukb');
        $totalStateSum = $states->sum('total_kupd') + $states->sum('total_kukb');
        $totalStateKupdRegisterSum = $states->sum('total_kupd_register');
        $totalStateKukbRegisterSum = $states->sum('total_kukb_register');
        $totalStateRegisterSum = $states->sum('total_kupd_register') + $states->sum('total_kukb_register');
        $totalStatePraDaftarSum = $states->sum('total_pra_daftar');
        $totalStateKupdPraDaftarSum = $states->sum('total_kupd_pra_daftar');
        $totalStateKukbPraDaftarSum = $states->sum('total_kukb_pra_daftar');

        // Calculate percentage for each state (total students)
        $statesWithPercentage = $states->map(function ($state) use ($totalStudents) {
            $state->percentage = $totalStudents > 0 ? ($state->total / $totalStudents) * 100 : 0;
            $state->pra_percentage = $totalStudents > 0 ? ($state->total_pra_daftar / $totalStudents) * 100 : 0;
            $state->register_percentage = $totalStudents > 0 ? ($state->total_register / $totalStudents) * 100 : 0;
            return $state;
        });

        // Calculate percentage for each state (total_register)
        $statesWithRegisterPercentage = $states->map(function ($state) use ($totalStudents) {
            $state->register_percentage = $totalStudents > 0 ? ($state->total_register / $totalStudents) * 100 : 0;
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

        return view('admin.summary', compact('totalStudents', 'statusWithPercentage', 'locationsWithPercentage', 'totalPraDaftar', 'totalDaftarKolej', 'sourcessWithPercentage', 'currentYear', 'monthlyData', 'statesWithPercentage', 'totalStateKupdSum', 'totalStateKukbSum', 'totalStateKupdRegisterSum', 'totalStateKukbRegisterSum', 'totalStateRegisterSum', 'totalStatePraDaftarSum', 'totalStateKupdPraDaftarSum', 'totalStateKukbPraDaftarSum', 'totalSourceKupdSum', 'totalSourceKukbSum', 'totalStateSum', 'totalSourceKupdRegisterSum', 'totalSourceKukbRegisterSum', 'totalSourcePraDaftarSum', 'totalSourceKupdPraDaftarSum', 'totalSourceKukbPraDaftarSum', 'statesWithRegisterPercentage', 'totalSourceSum', 'totalSourceRegisterSum'));
    }

    public function summaryDetail(Request $request)
    {
        $status_id = $request->input('status_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch status name
        $status = DB::table('status')
            ->select('status.name AS status_name')
            ->where('status.id', '=', $status_id)
            ->first();

        $statusName = $status ? $status->status_name : 'Tiada Status';

        // Build base query
        $query = DB::table('students')
            ->leftjoin('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
            ->leftjoin('users AS advisor', 'students.user_id', '=', 'advisor.id')
            ->select(
                'students.name AS student',
                'students.ic',
                DB::raw("DATE_FORMAT(students.created_at, '%d-%m-%Y') as created_at"),
                'affiliate.name AS affiliate',
                'advisor.name AS advisor',
                'students.reason',
                DB::raw("DATE_FORMAT(students.register_at, '%d-%m-%Y') as register_at")
            )
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            });

        // Filter by status
        if (is_null($status_id)) {
            $query->whereNull('students.status_id');
        } else {
            $query->where('students.status_id', '=', $status_id);
        }

        // Filter by created_at (casted to DATE)
        if ($startDate && $endDate) {
            $query->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate(DB::raw("CAST(students.created_at AS DATE)"), '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate(DB::raw("CAST(students.created_at AS DATE)"), '<=', $endDate);
        }

        $statusDetails = $query->orderBy('students.created_at', 'desc')->get();

        // Summary by location for the same filters
        $locationTotalsQuery = DB::table('students')
            ->leftJoin('location', 'students.location_id', '=', 'location.id')
            ->select(
                DB::raw("COALESCE(location.name, 'TIADA LOKASI') AS location"),
                DB::raw('COUNT(students.id) AS total')
            )
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            });

        if (is_null($status_id)) {
            $locationTotalsQuery->whereNull('students.status_id');
        } else {
            $locationTotalsQuery->where('students.status_id', '=', $status_id);
        }

        if ($startDate && $endDate) {
            $locationTotalsQuery->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$startDate, $endDate]);
        } elseif ($startDate) {
            $locationTotalsQuery->whereDate(DB::raw("CAST(students.created_at AS DATE)"), '>=', $startDate);
        } elseif ($endDate) {
            $locationTotalsQuery->whereDate(DB::raw("CAST(students.created_at AS DATE)"), '<=', $endDate);
        }

        $locationTotals = $locationTotalsQuery
            ->groupBy(DB::raw("COALESCE(location.name, 'TIADA LOKASI')"))
            ->orderBy('location')
            ->get();

        $locationTotalsSum = $locationTotals->sum('total');

        // Summary by nota/reason for the same filters
        $notaTotalsQuery = DB::table('students')
            ->select(
                DB::raw("COALESCE(students.reason, 'TIADA NOTA') AS reason"),
                DB::raw('COUNT(students.id) AS total')
            )
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            });

        if (is_null($status_id)) {
            $notaTotalsQuery->whereNull('students.status_id');
        } else {
            $notaTotalsQuery->where('students.status_id', '=', $status_id);
        }

        if ($startDate && $endDate) {
            $notaTotalsQuery->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$startDate, $endDate]);
        } elseif ($startDate) {
            $notaTotalsQuery->whereDate(DB::raw("CAST(students.created_at AS DATE)"), '>=', $startDate);
        } elseif ($endDate) {
            $notaTotalsQuery->whereDate(DB::raw("CAST(students.created_at AS DATE)"), '<=', $endDate);
        }

        $notaTotals = $notaTotalsQuery
            ->groupBy(DB::raw("COALESCE(students.reason, 'TIADA NOTA')"))
            ->orderBy('reason')
            ->get();

        $notaTotalsSum = $notaTotals->sum('total');

        return response()->json([
            'statusDetails' => $statusDetails,
            'status' => $statusName,
            'locationTotals' => $locationTotals,
            'locationTotalsSum' => $locationTotalsSum,
            'notaTotals' => $notaTotals,
            'notaTotalsSum' => $notaTotalsSum
        ]);
    }

    public function leadReports(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $location = $request->input('location');

        $locations = DB::table('location')->get();

        $serinuhaReferralCode = 'ElPblUE3';
        $applyReferralExclusion = function ($query) use ($serinuhaReferralCode) {
            $query->where(function ($q) use ($serinuhaReferralCode) {
                $q->whereNull('students.referral_code')
                    ->orWhere('students.referral_code', '!=', $serinuhaReferralCode);
            });
        };
        $applyReferralInclusion = function ($query) use ($serinuhaReferralCode) {
            $query->where('students.referral_code', '=', $serinuhaReferralCode);
        };

        $sources = DB::table('students')
            ->select('students.source')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            })
            ->where(function ($query) use ($applyReferralExclusion) {
                $applyReferralExclusion($query);
            })
            ->groupBy('students.source')->get();

        $serinuhaSources = DB::table('students')
            ->select('students.source')
            ->where(function ($query) {
                $query->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '');
            })
            ->where('students.referral_code', '=', $serinuhaReferralCode)
            ->groupBy('students.source')->get();

        $totalDataN = [];
        $totalDataR = [];
        $totalDataWithAffiliate = [];
        $totalDataWithAffiliateN = [];
        $totalDataWithAffiliateR = [];
        $totalDataWithEA = [];
        $totalDataWithEAN = [];
        $totalDataWithEAR = [];
        $totalDataWithoutAffiliate = [];
        $totalDataWithoutAffiliateN = [];
        $totalDataWithoutAffiliateR = [];
        $totalDataPreRegisterWithAffiliate = [];
        $totalDataPreRegisterWithEA = [];
        $totalDataPreRegisterWithoutAffiliate = [];
        $totalDataRegisterWithAffiliate = [];
        $totalDataRegisterWithOtherEA = [];
        $totalDataRegisterWithEA = [];
        $totalDataRegisterWithoutAffiliate = [];
        $totalDataPreRegister = [];
        $totalDataRegister = [];
        $totalDataRejects = [];

        $serinuhaTotalDataN = [];
        $serinuhaTotalDataR = [];
        $serinuhaTotalDataWithAffiliate = [];
        $serinuhaTotalDataWithAffiliateN = [];
        $serinuhaTotalDataWithAffiliateR = [];
        $serinuhaTotalDataWithEA = [];
        $serinuhaTotalDataWithEAN = [];
        $serinuhaTotalDataWithEAR = [];
        $serinuhaTotalDataWithoutAffiliate = [];
        $serinuhaTotalDataWithoutAffiliateN = [];
        $serinuhaTotalDataWithoutAffiliateR = [];
        $serinuhaTotalDataPreRegisterWithAffiliate = [];
        $serinuhaTotalDataPreRegisterWithEA = [];
        $serinuhaTotalDataPreRegisterWithoutAffiliate = [];
        $serinuhaTotalDataRegisterWithAffiliate = [];
        $serinuhaTotalDataRegisterWithOtherEA = [];
        $serinuhaTotalDataRegisterWithEA = [];
        $serinuhaTotalDataRegisterWithoutAffiliate = [];
        $serinuhaTotalDataPreRegister = [];
        $serinuhaTotalDataRegister = [];
        $serinuhaTotalDataRejects = [];

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
                ->where(function ($query) use ($applyReferralExclusion) {
                    $applyReferralExclusion($query);
                })
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataN[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where(function ($query) use ($applyReferralExclusion) {
                    $applyReferralExclusion($query);
                })
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataR[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithAffiliate[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->where('affiliate.type', '=', 0)
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithAffiliateN[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->where('affiliate.type', '=', 0)
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithAffiliateR[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->whereIn('advisor.type', [1, 2])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithEA[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->whereIn('advisor.type', [1, 2])
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithEAN[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->whereIn('advisor.type', [1, 2])
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithEAR[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNull('students.referral_code')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithoutAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNull('students.referral_code')
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithoutAffiliateN[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNull('students.referral_code')
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataWithoutAffiliateR[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->where('students.status_id', '=', 19)
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataPreRegisterWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->where('students.status_id', '=', 19)
                ->whereIn('advisor.type', [1, 2])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataPreRegisterWithEA[$source->source] = $query->count();

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
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataPreRegisterWithoutAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->whereIn('students.status_id', [20, 21])
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataRegisterWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->whereIn('students.status_id', [22])
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataRegisterWithOtherEA[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '!=', $serinuhaReferralCode)
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereIn('advisor.type', [1, 2])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataRegisterWithEA[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNull('students.referral_code')
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataRegisterWithoutAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where(function ($query) use ($applyReferralExclusion) {
                    $applyReferralExclusion($query);
                })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [1, 2, 3, 4, 5, 6, 23, 24, 25, 26, 27, 32, 33]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $totalDataRejects[$source->source] = $query->count();
        }

        foreach ($serinuhaSources as $source) {
            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where(function ($query) use ($applyReferralInclusion) {
                    $applyReferralInclusion($query);
                })
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataN[$source->source] = $query->count();

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where(function ($query) use ($applyReferralInclusion) {
                    $applyReferralInclusion($query);
                })
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataR[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataWithAffiliate[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->where('affiliate.type', '=', 0)
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataWithAffiliateN[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->where('affiliate.type', '=', 0)
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataWithAffiliateR[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->whereIn('advisor.type', [1, 2])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataWithEA[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->whereIn('advisor.type', [1, 2])
                ->where('students.remark', 'LIKE', '%N%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataWithEAN[$source->source] = $query->count();

            $query  = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->whereIn('advisor.type', [1, 2])
                ->where('students.remark', 'LIKE', '%R%')
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataWithEAR[$source->source] = $query->count();

            $serinuhaTotalDataWithoutAffiliate[$source->source] = 0;
            $serinuhaTotalDataWithoutAffiliateN[$source->source] = 0;
            $serinuhaTotalDataWithoutAffiliateR[$source->source] = 0;

            $query = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->where('students.status_id', '=', 19)
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataPreRegisterWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->where('students.status_id', '=', 19)
                ->whereIn('advisor.type', [1, 2])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataPreRegisterWithEA[$source->source] = $query->count();
            $serinuhaTotalDataPreRegisterWithoutAffiliate[$source->source] = 0;

            $query = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->whereIn('students.status_id', [20, 21])
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataRegisterWithAffiliate[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->whereIn('students.status_id', [22])
                ->where('affiliate.type', '=', 0)
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataRegisterWithOtherEA[$source->source] = $query->count();

            $query = DB::table('students')
                ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereNotNull('students.referral_code')
                ->where('students.referral_code', '=', $serinuhaReferralCode)
                ->whereIn('students.status_id', [20, 21, 22])
                ->whereIn('advisor.type', [1, 2])
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataRegisterWithEA[$source->source] = $query->count();
            $serinuhaTotalDataRegisterWithoutAffiliate[$source->source] = 0;

            $query = DB::table('students')
                ->where('students.source', '=', $source->source)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->where(function ($query) use ($applyReferralInclusion) {
                    $applyReferralInclusion($query);
                })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [1, 2, 3, 4, 5, 6, 11, 23, 24, 25, 26, 27, 32, 33]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $serinuhaTotalDataRejects[$source->source] = $query->count();
        }

        $totalNDataCount = array_sum($totalDataN);
        $totalRDataCount = array_sum($totalDataR);
        $totalDataWithAffiliateCount = array_sum($totalDataWithAffiliate);
        $totalDataWithAffiliateNCount = array_sum($totalDataWithAffiliateN);
        $totalDataWithAffiliateRCount = array_sum($totalDataWithAffiliateR);
        $totalDataWithEACount = array_sum($totalDataWithEA);
        $totalDataWithEANCount = array_sum($totalDataWithEAN);
        $totalDataWithEARCount = array_sum($totalDataWithEAR);
        $totalDataWithoutAffiliateCount = array_sum($totalDataWithoutAffiliate);
        $totalDataWithoutAffiliateNCount = array_sum($totalDataWithoutAffiliateN);
        $totalDataWithoutAffiliateRCount = array_sum($totalDataWithoutAffiliateR);
        $totalDataPreRegisterWithAffiliateCount = array_sum($totalDataPreRegisterWithAffiliate);
        $totalDataPreRegisterWithEACount = array_sum($totalDataPreRegisterWithEA);
        $totalDataPreRegisterWithoutAffiliateCount = array_sum($totalDataPreRegisterWithoutAffiliate);
        $totalDataRegisterWithAffiliateCount = array_sum($totalDataRegisterWithAffiliate);
        $totalDataRegisterWithOtherEACount = array_sum($totalDataRegisterWithOtherEA);
        $totalDataRegisterWithEACount = array_sum($totalDataRegisterWithEA);
        $totalDataRegisterWithoutAffiliateCount = array_sum($totalDataRegisterWithoutAffiliate);
        $totalDataRejectCount = array_sum($totalDataRejects);

        $totalDataNR = $totalNDataCount + $totalRDataCount;
        $totalDataEntryNR = $totalDataWithAffiliateNCount + $totalDataWithAffiliateRCount + $totalDataWithEANCount + $totalDataWithEARCount + $totalDataWithoutAffiliateNCount + $totalDataWithoutAffiliateRCount;
        $totalDataPreRegister = $totalDataPreRegisterWithAffiliateCount + $totalDataPreRegisterWithEACount + $totalDataPreRegisterWithoutAffiliateCount;
        $totalDataRegister = $totalDataRegisterWithAffiliateCount + $totalDataRegisterWithOtherEACount + $totalDataRegisterWithEACount + $totalDataRegisterWithoutAffiliateCount;

        $serinuhaTotalNDataCount = array_sum($serinuhaTotalDataN);
        $serinuhaTotalRDataCount = array_sum($serinuhaTotalDataR);
        $serinuhaTotalDataWithAffiliateCount = array_sum($serinuhaTotalDataWithAffiliate);
        $serinuhaTotalDataWithAffiliateNCount = array_sum($serinuhaTotalDataWithAffiliateN);
        $serinuhaTotalDataWithAffiliateRCount = array_sum($serinuhaTotalDataWithAffiliateR);
        $serinuhaTotalDataWithEACount = array_sum($serinuhaTotalDataWithEA);
        $serinuhaTotalDataWithEANCount = array_sum($serinuhaTotalDataWithEAN);
        $serinuhaTotalDataWithEARCount = array_sum($serinuhaTotalDataWithEAR);
        $serinuhaTotalDataWithoutAffiliateCount = array_sum($serinuhaTotalDataWithoutAffiliate);
        $serinuhaTotalDataWithoutAffiliateNCount = array_sum($serinuhaTotalDataWithoutAffiliateN);
        $serinuhaTotalDataWithoutAffiliateRCount = array_sum($serinuhaTotalDataWithoutAffiliateR);
        $serinuhaTotalDataPreRegisterWithAffiliateCount = array_sum($serinuhaTotalDataPreRegisterWithAffiliate);
        $serinuhaTotalDataPreRegisterWithEACount = array_sum($serinuhaTotalDataPreRegisterWithEA);
        $serinuhaTotalDataPreRegisterWithoutAffiliateCount = array_sum($serinuhaTotalDataPreRegisterWithoutAffiliate);
        $serinuhaTotalDataRegisterWithAffiliateCount = array_sum($serinuhaTotalDataRegisterWithAffiliate);
        $serinuhaTotalDataRegisterWithOtherEACount = array_sum($serinuhaTotalDataRegisterWithOtherEA);
        $serinuhaTotalDataRegisterWithEACount = array_sum($serinuhaTotalDataRegisterWithEA);
        $serinuhaTotalDataRegisterWithoutAffiliateCount = array_sum($serinuhaTotalDataRegisterWithoutAffiliate);
        $serinuhaTotalDataRejectCount = array_sum($serinuhaTotalDataRejects);
        $serinuhaTotalDataNR = $serinuhaTotalNDataCount + $serinuhaTotalRDataCount;
        $serinuhaTotalDataEntryNR = $serinuhaTotalDataWithAffiliateNCount + $serinuhaTotalDataWithAffiliateRCount + $serinuhaTotalDataWithEANCount + $serinuhaTotalDataWithEARCount + $serinuhaTotalDataWithoutAffiliateNCount + $serinuhaTotalDataWithoutAffiliateRCount;
        $serinuhaTotalDataPreRegister = $serinuhaTotalDataPreRegisterWithAffiliateCount + $serinuhaTotalDataPreRegisterWithEACount + $serinuhaTotalDataPreRegisterWithoutAffiliateCount;
        $serinuhaTotalDataRegister = $serinuhaTotalDataRegisterWithAffiliateCount + $serinuhaTotalDataRegisterWithOtherEACount + $serinuhaTotalDataRegisterWithEACount + $serinuhaTotalDataRegisterWithoutAffiliateCount;

        return view('admin.leadreports', compact(
            'sources',
            'start_date',
            'end_date',
            'locations',
            'totalDataN',
            'totalDataR',
            'totalDataWithAffiliate',
            'totalDataWithAffiliateN',
            'totalDataWithAffiliateR',
            'totalDataWithEA',
            'totalDataWithEAN',
            'totalDataWithEAR',
            'totalDataWithoutAffiliate',
            'totalDataWithoutAffiliateN',
            'totalDataWithoutAffiliateR',
            'totalDataPreRegisterWithAffiliate',
            'totalDataPreRegisterWithEA',
            'totalDataPreRegisterWithoutAffiliate',
            'totalDataRegisterWithAffiliate',
            'totalDataRegisterWithOtherEA',
            'totalDataRegisterWithEA',
            'totalDataRegisterWithoutAffiliate',
            'totalDataRegister',
            'totalNDataCount',
            'totalRDataCount',
            'totalDataWithAffiliateCount',
            'totalDataWithAffiliateNCount',
            'totalDataWithAffiliateRCount',
            'totalDataWithEACount',
            'totalDataWithEANCount',
            'totalDataWithEARCount',
            'totalDataWithoutAffiliateCount',
            'totalDataWithoutAffiliateNCount',
            'totalDataWithoutAffiliateRCount',
            'totalDataPreRegisterWithAffiliateCount',
            'totalDataPreRegisterWithEACount',
            'totalDataPreRegisterWithoutAffiliateCount',
            'totalDataRegisterWithAffiliateCount',
            'totalDataRegisterWithOtherEACount',
            'totalDataRegisterWithEACount',
            'totalDataRegisterWithoutAffiliateCount',
            'totalDataPreRegister',
            'totalDataRegister',
            'location_name',
            'totalDataRejects',
            'totalDataRejectCount',
            'totalDataNR',
            'totalDataEntryNR',
            'serinuhaSources',
            'serinuhaTotalDataN',
            'serinuhaTotalDataR',
            'serinuhaTotalDataWithAffiliate',
            'serinuhaTotalDataWithAffiliateN',
            'serinuhaTotalDataWithAffiliateR',
            'serinuhaTotalDataWithEA',
            'serinuhaTotalDataWithEAN',
            'serinuhaTotalDataWithEAR',
            'serinuhaTotalDataWithoutAffiliate',
            'serinuhaTotalDataWithoutAffiliateN',
            'serinuhaTotalDataWithoutAffiliateR',
            'serinuhaTotalDataPreRegisterWithAffiliate',
            'serinuhaTotalDataPreRegisterWithEA',
            'serinuhaTotalDataPreRegisterWithoutAffiliate',
            'serinuhaTotalDataRegisterWithAffiliate',
            'serinuhaTotalDataRegisterWithOtherEA',
            'serinuhaTotalDataRegisterWithEA',
            'serinuhaTotalDataRegisterWithoutAffiliate',
            'serinuhaTotalDataRejects',
            'serinuhaTotalNDataCount',
            'serinuhaTotalRDataCount',
            'serinuhaTotalDataWithAffiliateCount',
            'serinuhaTotalDataWithAffiliateNCount',
            'serinuhaTotalDataWithAffiliateRCount',
            'serinuhaTotalDataWithEACount',
            'serinuhaTotalDataWithEANCount',
            'serinuhaTotalDataWithEARCount',
            'serinuhaTotalDataWithoutAffiliateCount',
            'serinuhaTotalDataWithoutAffiliateNCount',
            'serinuhaTotalDataWithoutAffiliateRCount',
            'serinuhaTotalDataPreRegisterWithAffiliateCount',
            'serinuhaTotalDataPreRegisterWithEACount',
            'serinuhaTotalDataPreRegisterWithoutAffiliateCount',
            'serinuhaTotalDataRegisterWithAffiliateCount',
            'serinuhaTotalDataRegisterWithOtherEACount',
            'serinuhaTotalDataRegisterWithEACount',
            'serinuhaTotalDataRegisterWithoutAffiliateCount',
            'serinuhaTotalDataRejectCount',
            'serinuhaTotalDataNR',
            'serinuhaTotalDataEntryNR',
            'serinuhaTotalDataPreRegister',
            'serinuhaTotalDataRegister',
        ));
    }

    public function yearReports(Request $request)
    {
        $locations = DB::table('location')->get();

        $currentYear = $request->input('year') ?? Carbon::now()->year;

        $yearlyData = [];
        $weeklyMonthlyData = [];

        // Monthly totals (existing logic)
        foreach ($locations as $location) {
            $students = DB::table('students')
                ->select(DB::raw('COUNT(id) as total, MONTH(created_at) as month'))
                ->whereNotNull('students.ic')
                ->where('students.ic', '!=', '')
                ->where('students.location_id', $location->id)
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('total', 'month');

            for ($month = 1; $month <= 12; $month++) {
                $yearlyData[$currentYear][$month]['total'][$location->id] = $students[$month] ?? 0;
            }
        }

        // Weekly breakdown per month
        foreach ($locations as $location) {
            for ($month = 1; $month <= 12; $month++) {
                // Get all created_at dates and count by ISO week number (all students)
                $weekly = DB::table('students')
                    ->select(DB::raw('COUNT(id) as total, WEEK(created_at, 1) as iso_week'))
                    ->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '')
                    ->where('students.location_id', $location->id)
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->groupBy(DB::raw('WEEK(created_at, 1)'))
                    ->pluck('total', 'iso_week');

                // Get all created_at dates and count by ISO week number (students with referral_code)
                $weeklyWithReferral = DB::table('students')
                    ->join('users AS affiliate', 'students.referral_code', '=', 'affiliate.referral_code')
                    ->select(DB::raw('COUNT(students.id) as total, WEEK(students.created_at, 1) as iso_week'))
                    ->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '')
                    ->where('students.location_id', $location->id)
                    ->whereYear('students.created_at', $currentYear)
                    ->whereMonth('students.created_at', $month)
                    ->whereNotNull('students.referral_code')
                    ->where('affiliate.type', '=', 0)
                    ->groupBy(DB::raw('WEEK(students.created_at, 1)'))
                    ->pluck('total', 'iso_week');

                $weeklyWithEA = DB::table('students')
                    ->join('users AS advisor', 'students.referral_code', '=', 'advisor.referral_code')
                    ->select(DB::raw('COUNT(students.id) as total, WEEK(students.created_at, 1) as iso_week'))
                    ->whereNotNull('students.ic')
                    ->where('students.ic', '!=', '')
                    ->where('students.location_id', $location->id)
                    ->whereYear('students.created_at', $currentYear)
                    ->whereMonth('students.created_at', $month)
                    ->whereNotNull('students.referral_code')
                    ->whereIn('advisor.type', [1, 2])
                    ->groupBy(DB::raw('WEEK(students.created_at, 1)'))
                    ->pluck('total', 'iso_week');

                $weeklyWithout = DB::table('students')
                    ->select(DB::raw('COUNT(id) as total, WEEK(created_at, 1) as iso_week'))
                    ->whereNotNull('students.ic')
                    ->whereNull('students.referral_code')
                    ->where('students.ic', '!=', '')
                    ->where('students.location_id', $location->id)
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->groupBy(DB::raw('WEEK(created_at, 1)'))
                    ->pluck('total', 'iso_week');

                // Determine all week numbers that fall within the month
                $weeksInMonth = [];

                $startOfMonth = Carbon::create($currentYear, $month, 1);
                $endOfMonth = $startOfMonth->copy()->endOfMonth();

                for ($date = $startOfMonth->copy(); $date <= $endOfMonth; $date->addDay()) {
                    $isoWeek = $date->isoWeek();
                    $weeksInMonth[] = $isoWeek;
                }

                $weeksInMonth = array_values(array_unique($weeksInMonth));

                foreach ($weeksInMonth as $weekIndex => $isoWeek) {
                    $weekInMonth = $weekIndex + 1;
                    $total = $weekly[$isoWeek] ?? 0;
                    $totalWithReferral = $weeklyWithReferral[$isoWeek] ?? 0;
                    $totalWithEA = $weeklyWithEA[$isoWeek] ?? 0;
                    $totalWithout = $weeklyWithout[$isoWeek] ?? 0;
                    $weeklyMonthlyData[$month][$weekInMonth]['total'][$location->id] = $total;
                    $weeklyMonthlyData[$month][$weekInMonth]['total_with_referral'][$location->id] = $totalWithReferral;
                    $weeklyMonthlyData[$month][$weekInMonth]['total_with_ea'][$location->id] = $totalWithEA;
                    $weeklyMonthlyData[$month][$weekInMonth]['total_without_affiliate'][$location->id] = $totalWithout;
                }
            }
        }

        return view('admin.yearreports', compact('currentYear', 'yearlyData', 'weeklyMonthlyData', 'locations'));
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
            ->where(function ($query) {
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

        foreach ($advisors as $advisor) {
            // Directly assign count to advisorId key in assignDatas array (no nested array)
            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $assigns[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->where(function ($query) {
                    $query->whereNull('students.status_id')
                        ->orWhere('students.status_id', '=', 0);
                });

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $notprocess[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->where(function ($query) {
                    $query->whereIn('students.status_id', [7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 29, 30, 31]);
                });

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
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
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
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
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $registers[$advisor->id] = $query->count();

            $query = DB::table('students')
                ->where('students.user_id', $advisor->id)
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date])
                ->whereIn('students.status_id', [1, 2, 3, 4, 5, 6, 11, 23, 24, 25, 26, 27, 32, 33]);

            if ($location == 3) {
                $query->whereIn('students.location_id', [1, 2]);
            } else {
                $query->where('students.location_id', '=', $location);
            }

            $rejects[$advisor->id] = $query->count();

            if ($assigns[$advisor->id] > 0) {
                $assignPercentage[$advisor->id] = (($assigns[$advisor->id]) / ($assigns[$advisor->id])) * (100);
                $notprocessPercentage[$advisor->id] = round((($notprocess[$advisor->id]) / ($assigns[$advisor->id])) * (100), 2);
                $processPercentage[$advisor->id] = round((($process[$advisor->id]) / ($assigns[$advisor->id])) * (100), 2);
                $preregisterPercentage[$advisor->id] = round((($preregisters[$advisor->id]) / ($assigns[$advisor->id])) * (100), 2);
                $registerPercentage[$advisor->id] = round((($registers[$advisor->id]) / ($assigns[$advisor->id])) * (100), 2);
                $rejectPercentage[$advisor->id] = round((($rejects[$advisor->id]) / ($assigns[$advisor->id])) * (100), 2);
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
            $totalCountAssignPercentage = array_sum($assigns) / array_sum($assigns) * 100;
            $totalCountNotProcessPercentage = round(array_sum($notprocess) / array_sum($assigns) * 100, 2);
            $totalCountProcessPercentage = round(array_sum($process) / array_sum($assigns) * 100, 2);
            $totalCountPreRegisterPercentage = round(array_sum($preregisters) / array_sum($assigns) * 100, 2);
            $totalCountRegisterPercentage = round(array_sum($registers) / array_sum($assigns) * 100, 2);
            $totalCountRejectPercentage = round(array_sum($rejects) / array_sum($assigns) * 100, 2);
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
            ->select(
                'students.name',
                'students.created_at',
                'students.updated_at',
                'users.name AS affiliate',
                'students.source',
                'students.status_id',
                'status.name AS status',
                'students.reason AS reason',
                DB::raw('DATEDIFF(CURDATE(), students.updated_at) AS days_since_update')
            )
            ->orderByDesc('students.id');

        if ($location == 3) {
            $applications->whereIn('students.location_id', [1, 2]);
        } else {
            $applications->where('students.location_id', '=', $location);
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

        $statusProcess = [7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 29, 30, 31];
        $statusPre = [19];
        $statusRegister = [20, 21, 22];
        $statusReject = [1, 2, 3, 4, 5, 6, 11, 23, 24, 25, 26, 27, 32, 33];

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
            ->select('students.name', 'students.created_at', 'students.source', 'students.incentive', 'students.register_at', 'students.commission', 'students.remark',)
            ->orderByDesc('students.id');

        if ($location == 3) {
            $applications->whereIn('students.location_id', [1, 2]);
        } else {
            $applications->where('students.location_id', '=', $location);
        }

        $totalIncentive = number_format($applications->sum('students.incentive'), 2, '.', '');
        $totalCommission = $applications->sum('students.commission');

        $applications = $applications->get();

        return view('admin.affiliateachievementDetails', compact('affiliate', 'applications', 'totalIncentive', 'totalCommission'));
    }

    public function contents()
    {
        $contents = Content::orderBy('created_at', 'desc')->get();

        return view('admin.contents', compact('contents'));
    }

    public function contentsEnhanced()
    {
        $user = Auth::user();

        // Admins might not rely on referral codes, but we pass it if available or a default
        $ref = $user->referral_code ?? 'admin';
        $url = url('/') . '?ref=' . $ref;

        $contents = Content::orderBy('created_at', 'desc')->get();

        return view('admin.kandungan-media-enhanced', compact('contents', 'ref', 'url'));
    }

    public function addcontent(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:image,video,link,text',
            'tags' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|in:kupd,kukb',

            // Platform validation
            'platform'   => 'required|array', // Must be an array
            'platform.*' => 'in:facebook,instagram,whatsapp,tiktok,telegram', // Only allowed values
        ]);

        if ($request->input('type') === 'image' && $request->hasFile('file')) {
            $file = $request->file('file');

            $extension = strtolower($file->getClientOriginalExtension());

            $filePath = 'urproject/images/contents/' . uniqid('content_') . '.' . $extension;

            Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

            $validated['file_path'] = Storage::disk('linode')->url($filePath);
        }

        if (in_array($request->input('type'), ['link', 'video'])) {
            $externalLink = $request->input('external_link');
            if ($externalLink) {
                $request->validate([
                    'external_link' => 'required|url|max:255',
                ]);
                $validated['external_link'] = $externalLink;
            }
        }

        Content::create($validated);

        return redirect()->back()->with('success', 'Bahan media yang baru berjaya ditambah ke dalam sistem.');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        if ($content->file_path) {
            // Remove domain if full URL is stored
            $filePath = str_replace(
                'https://ku-storage-object.ap-south-1.linodeobjects.com/',
                '',
                $content->file_path
            );

            if (Storage::disk('linode')->exists($filePath)) {
                Storage::disk('linode')->delete($filePath);
            }
        }

        $content->delete();

        return redirect()->back()->with('success', 'Bahan media berjaya dihapuskan.');
    }

    public function updatecontent(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:image,video,link,text',
            'tags' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|in:kupd,kukb',

            // Platform validation
            'platform'   => 'required|array', // Must be an array
            'platform.*' => 'in:facebook,instagram,whatsapp,tiktok,telegram', // Only allowed values
        ]);

        // Handle file upload for images
        if ($request->input('type') === 'image' && $request->hasFile('file')) {
            // Delete old file if exists
            if ($content->file_path) {
                $oldFilePath = str_replace(
                    'https://ku-storage-object.ap-south-1.linodeobjects.com/',
                    '',
                    $content->file_path
                );

                if (Storage::disk('linode')->exists($oldFilePath)) {
                    Storage::disk('linode')->delete($oldFilePath);
                }
            }

            // Upload new file
            $file = $request->file('file');
            $extension = strtolower($file->getClientOriginalExtension());
            $filePath = 'urproject/images/contents/' . uniqid('content_') . '.' . $extension;
            Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');
            $validated['file_path'] = Storage::disk('linode')->url($filePath);
        }

        // Handle external link for video/link types
        if (in_array($request->input('type'), ['link', 'video'])) {
            $externalLink = $request->input('external_link');
            if ($externalLink) {
                $request->validate([
                    'external_link' => 'required|url|max:255',
                ]);
                $validated['external_link'] = $externalLink;
            }
        }

        // Handle publish status
        $validated['status_id'] = $request->has('is_published') ? 1 : 0;

        // Update the content
        $content->update($validated);

        return redirect()->back()->with('success', 'Bahan media berjaya dikemaskini.');
    }

    public function programReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        // Default to last 7 days when no dates provided
        if (!$start_date && !$end_date) {
            $start_date = now()->subDays(7)->startOfDay()->format('Y-m-d');
            $end_date   = now()->endOfDay()->format('Y-m-d');
        }

        $baseQuery = function ($locationId) use ($start_date, $end_date) {
            $query = DB::table('student_programs')
                ->join('students', function ($join) {
                    $join->on('student_programs.student_ic', '=', 'students.ic')
                         ->whereNotNull('students.ic')
                         ->where('students.ic', '!=', '');
                })
                ->join('program', 'student_programs.program_id', '=', 'program.id')
                ->leftJoin('location', 'program.location_id', '=', 'location.id')
                ->select(
                    'program.name AS program_name',
                    'location.name AS location_name',
                    'location.code AS location',
                    DB::raw('COUNT(DISTINCT student_programs.student_ic) AS total')
                )
                ->where('program.name', '!=', 'TIADA MAKLUMAT')
                ->where('program.location_id', $locationId);

            if ($start_date && $end_date) {
                $query->whereBetween(DB::raw("CAST(students.created_at AS DATE)"), [$start_date, $end_date]);
            } elseif ($start_date) {
                $query->whereDate(DB::raw("CAST(students.created_at AS DATE)"), $start_date);
            }

            return $query
                ->groupBy('program.id', 'program.name', 'location.name', 'location.code')
                ->orderByDesc('total')
                ->get();
        };

        $locations = DB::table('location')->orderBy('id')->get();

        $programStatsByLocation = [];
        foreach ($locations as $location) {
            $programStatsByLocation[$location->id] = [
                'location' => $location,
                'stats'    => $baseQuery($location->id),
            ];
        }

        return view('admin.programreport', compact('programStatsByLocation', 'start_date', 'end_date'));
    }
}
