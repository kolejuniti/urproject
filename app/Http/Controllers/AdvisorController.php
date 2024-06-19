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

        $applicants = DB::table('students')
                ->join('state', 'students.state_id', '=', 'state.id')
                ->leftjoin('users', 'students.user_id', '=', 'users.id')
                ->join('location', 'students.location_id', '=', 'location.id')
                ->leftjoin('status', 'students.status_id', '=', 'status.id')
                ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location', 'status.name AS status')
                ->where(function($query) use ($ref, $id) {
                    $query->where('students.referral_code', $ref)
                          ->orWhere('students.user_id', $id);
                })
                ->orderBy('students.created_at', 'desc')
                ->get();
                
        $statusApplications = DB::table('status')->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $jpgFilePath = 'urproject/student/resultspm/' . $applicant->ic . '.jpg';
            $jpegFilePath = 'urproject/student/resultspm/' . $applicant->ic . '.jpeg';
            $pngFilePath = 'urproject/student/resultspm/' . $applicant->ic . '.png';
            $pdfFilePath = 'urproject/student/resultspm/' . $applicant->ic . '.pdf';

            if (Storage::disk('linode')->exists($jpgFilePath)) {
                // If the .jpg file exists, use its URL
                $fileUrl = Storage::disk('linode')->url($jpgFilePath);
            } elseif (Storage::disk('linode')->exists($jpegFilePath)) {
                // If the .jpeg file exists, use its URL
                $fileUrl = Storage::disk('linode')->url($jpegFilePath);
            } elseif (Storage::disk('linode')->exists($pngFilePath)) {
                // If the .png file exists, use its URL
                $fileUrl = Storage::disk('linode')->url($pngFilePath);
            } elseif (Storage::disk('linode')->exists($pdfFilePath)) {
                // If the .png file exists, use its URL
                $fileUrl = Storage::disk('linode')->url($pdfFilePath);
            } else {
                // If neither file exists, set $fileUrl to null or a default value
                $fileUrl = null; // You can customize this to any default value you prefer
            }

            $programs = DB::table('student_programs')
                        ->join('program', 'student_programs.program_id', '=', 'program.id')
                        ->select('student_programs.id', 'program.name', 'student_programs.status', 'student_programs.notes')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs,
                'file_url' => $fileUrl
            ];

        }

        return view('advisor.application', ['applicantsWithPrograms' => $applicantsWithPrograms], ['statusApplications' => $statusApplications]);
    }

    public function update(Request $request, $id)
    {
        $programs = $request->input('programs'); // This should be an array
        $statusApplication = $request->input('statusApplication');
        $offer_letter_date = $request->input('offer_letter_date');
        $register_letter_date = $request->input('register_letter_date');

        DB::table('students')
            ->where('students.ic', $id)
            ->update(['students.status_id' => $statusApplication, 'offer_letter_date' => $offer_letter_date, 'register_letter_date' => $register_letter_date]);        

        foreach ($programs as $program) {
            $status = $program['status'];
            $notes = $program['notes'];
            $id = $program['id'];

            DB::table('student_programs')
                ->where('student_programs.student_ic', $id)
                ->where('student_programs.id', $id)
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
        $affiliates = User::where('leader_id', Auth::id())->orderBy('name')->get();

        return view('advisor.affiliate', compact('affiliates'));
    }
}
