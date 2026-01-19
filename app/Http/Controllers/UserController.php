<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\Content;

class UserController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user();
        $referralCode = $user->referral_code;

        // Build dynamic last 3 months data
        $monthlyStats = [];
        for ($i = 0; $i < 3; $i++) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;

            $count = DB::table('students')
                ->where('referral_code', $referralCode)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->count();

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

            $monthlyStats[] = [
                'month_name' => $malayMonths[$month],  // e.g. Julai
                'month_number' => $month,              // e.g. 7
                'count' => $count
            ];
        }

        // Last registered student via user link
        $lastRegisteredStudent = DB::table('students')
            ->where('referral_code', $referralCode)
            ->latest('created_at')
            ->first();

        $lastRegisteredDate = optional($lastRegisteredStudent)->created_at
            ? Carbon::parse($lastRegisteredStudent->created_at)->format('d-m-Y')
            : '-';

        // Total registered students via user link
        $totalRegistered = DB::table('students')
            ->where('referral_code', $referralCode)
            ->count();

        $totalSuccessRegistered = DB::table('students')
            ->where('referral_code', $referralCode)
            ->whereIn('status_id', [20, 21])
            ->count();

        // Top 5 students (latest registrations)
        $topStudents = DB::table('students')
            ->where('referral_code', $referralCode)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact(
            'user',
            'monthlyStats',
            'lastRegisteredDate',
            'totalRegistered',
            'topStudents',
            'totalSuccessRegistered'
        ));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applications()
    {
        $user = Auth::user();

        $ref = $user->referral_code;
        $url = url('/') . '?ref=' . $ref; // Generates the referral URL

        // Generate and return the QR code as an SVG string for use in Blade
        $qrCode = QrCode::size(200)->generate($url);

        // Generate and save QR code as a PNG file in the public folder
        QrCode::size(200)
            ->format('svg')
            ->generate($url, public_path('qrcode.svg'));

        $applicants = DB::table('students')
            ->leftjoin('state', 'students.state_id', '=', 'state.id')
            ->leftjoin('users', 'students.user_id', '=', 'users.id')
            ->join('location', 'students.location_id', '=', 'location.id')
            ->leftjoin('status', 'students.status_id', '=', 'status.id')
            ->select('students.*', 'state.name AS state', 'users.name AS user', 'users.phone AS user_phone', 'location.name AS location', 'status.name AS status', DB::raw('DATE_ADD(students.register_at, INTERVAL 18 DAY) AS commission_date'))
            ->where('students.referral_code', $ref)
            ->orderBy('students.created_at', 'desc')
            ->get();

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

        return view('user.application', ['applicantsWithPrograms' => $applicantsWithPrograms, 'url' => $url, 'qrCode' => $qrCode]);
    }

    public function profile()
    {
        $banks = DB::table('bank')->get();
        $professions = DB::table('profession')->get();

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

        return view('user.profile', compact('banks', 'user', 'userAddress', 'professions'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $phone = $request->input('phone');
        $bank_account = $request->input('bank_account');
        $bank = $request->input('bank');
        $profession = $request->input('profession');

        $user = DB::table('users')
            ->where('users.id', Auth::id())
            ->update(['phone' => $phone, 'bank_account' => $bank_account, 'bank_id' => $bank, 'profession' => $profession]);

        return redirect()->route('user.profile')->with('success', 'Maklumat anda berjaya dikemaskini.');;
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

        return redirect()->route('user.profile')->with('success', 'Katalaluan anda berjaya dikemaskini.');;
    }

    public function affiliate()
    {
        $user = Auth::user();

        $ref = $user->referral_code;
        $url = url('/affiliate') . '?ref=' . $ref; // Generates the referral URL

        // Generate and return the QR code as an SVG string for use in Blade
        $qrCode = QrCode::size(200)->generate($url);

        // Generate and save QR code as a PNG file in the public folder
        QrCode::size(200)
            ->format('svg')
            ->generate($url, public_path('qrcode.svg'));

        $affiliates = User::where('leader_id', Auth::id())->orderBy('name')->get();

        return view('user.affiliate', compact('affiliates', 'url', 'qrCode'));
    }

    public function contents()
    {
        $user = Auth::user();

        $ref = $user->referral_code;
        $url = url('/') . '?ref=' . $ref;

        $contents = Content::orderBy('created_at', 'desc')->get();

        return view('user.contents', compact('contents', 'ref', 'url'));
    }

    public function contentsEnhanced()
    {
        $user = Auth::user();

        $ref = $user->referral_code;
        $url = url('/') . '?ref=' . $ref;

        $contents = Content::orderBy('created_at', 'desc')->get();

        return view('user.kandungan-media-enhanced', compact('contents', 'ref', 'url'));
    }
}
