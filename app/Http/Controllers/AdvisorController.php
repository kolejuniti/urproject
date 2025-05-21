<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdvisorController extends Controller
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
        return view('advisor.dashboard');
    }

    public function applications()
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

        $applicants = DB::table('students')
                ->leftjoin('state', 'students.state_id', '=', 'state.id')
                ->leftJoin('users', 'students.user_id', '=', 'users.id')
                ->join('location', 'students.location_id', '=', 'location.id')
                ->leftJoin('status', 'students.status_id', '=', 'status.id')
                ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location', 'status.name AS status')
                ->where(function($query) use ($ref, $id) {
                    $query->where('students.referral_code', $ref)
                        ->orWhere('students.user_id', $id);
                })
                ->where(function ($query) {
                    $query->whereNotNull('students.ic')
                        ->where('students.ic', '!=', '');
                })
                ->orderBy('students.created_at', 'desc')
                ->get();

        $affiliates = [];

        foreach ($applicants as $applicant) {
            // Find the affiliate(s) associated with the current student's referral code
            $affiliate = User::where('referral_code', $applicant->referral_code)
                        ->whereIn('type', [0, 1])
                        ->get();

            // Store the affiliate(s) in the $affiliates array, using student ID as key
            $affiliates[$applicant->id] = $affiliate;
        }

        return view('advisor.application', compact('applicants', 'affiliates', 'url', 'qrCode'));
    }

    public function applicationDetail(Request $request)
    {
        $ic = $request->input('ic');

        $applicants = DB::table('students')
                    ->leftJoin('state', 'students.state_id', '=', 'state.id')
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
                        'students.reason',
                        DB::raw("DATE_FORMAT(students.offer_letter_date, '%Y-%m-%d') as offer_letter_date"),
                        DB::raw("DATE_FORMAT(students.register_letter_date, '%Y-%m-%d') as register_letter_date")
                    )
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->first();

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
                    ->select('program.name', 'student_programs.status', 'student_programs.notes', 'student_programs.id')
                    ->where('student_programs.student_ic', 'LIKE', "{$ic}")
                    ->get();

        $statusApplications = DB::table('status')->get();

        if ($request->ajax()) {
            return response()->json(['applicants' => $applicants, 'fileUrl' => $fileUrl, 'programs' => $programs, 'statusApplications' => $statusApplications]);
        }

        return view('advisor.application', compact('applicants', 'fileUrl', 'programs', 'statusApplications'));

    }

    public function update(Request $request, $id)
    {
        $programs = $request->input('programs'); // This should be an array
        $statusApplication = $request->input('statusApplication');
        $reason = $request->input('reason');
        $offer_letter_date = $request->input('offer_letter_date');
        $register_letter_date = $request->input('register_letter_date');

        DB::table('students')
            ->where('students.id', $id)
            ->update(['students.status_id' => $statusApplication, 'reason' => $reason, 'offer_letter_date' => $offer_letter_date, 'register_letter_date' => $register_letter_date]);     

        foreach ($programs as $program) {
            $status = $program['status'];
            $notes = $program['notes'];
            $idProgram = $program['id'];

            DB::table('student_programs')
                ->where('student_programs.id', $idProgram)
                ->update(['student_programs.status' => $status, 'student_programs.notes' => $notes]);
        }

        return redirect()->route('advisor.application')->with('success', 'Status permohonan program pelajar berjaya dikemaskini.');;
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

        return view('advisor.profile', compact('banks', 'user', 'userAddress'));
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

        return redirect()->route('advisor.profile')->with('success', 'Maklumat anda berjaya dikemaskini.');
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

        return redirect()->route('advisor.profile')->with('success', 'Katalaluan anda berjaya dikemaskini.');;
    }

    public function affiliate()
    {     
        $user = Auth::user();

        $ref = $user->referral_code;
        $url = url('/affiliate').'?ref='.$ref; // Generates the referral URL

        // Generate and return the QR code as an SVG string for use in Blade
        $qrCode = QrCode::size(200)->generate($url);

        // Generate and save QR code as a PNG file in the public folder
        QrCode::size(200)
            ->format('svg')
            ->generate($url, public_path('qrcode.svg'));
        
        $affiliates = User::where('leader_id', Auth::id())->orderBy('name')->get();

        return view('advisor.affiliate', compact('affiliates', 'url', 'qrCode'));
    }
}
