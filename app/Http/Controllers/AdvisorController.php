<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    public function update(Request $request, $ic)
    {
        $programs = $request->input('programs'); // This should be an array
        $statusApplication = $request->input('statusApplication');

        DB::table('students')
            ->where('students.ic', $ic)
            ->update(['students.status_id' => $statusApplication]);        

        foreach ($programs as $program) {
            $status = $program['status'];
            $notes = $program['notes'];
            $id = $program['id'];

            DB::table('student_programs')
                ->where('student_programs.student_ic', $ic)
                ->where('student_programs.id', $id)
                ->update(['student_programs.status' => $status, 'student_programs.notes' => $notes]);
        }

        $statusApplications = DB::table('status')->get();

        $updateDates = DB::table('students')
                    ->where('students.ic', $ic)
                    ->update(['updated_at' => Carbon::now()]);

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
                        ->select('student_programs.id', 'program.name', 'student_programs.status', 'student_programs.notes')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs,
                'file_url' => $fileUrl
            ];

        }

        return view('advisor.application', ['applicantsWithPrograms' => $applicantsWithPrograms], ['statusApplications' => $statusApplications])->with('success', 'Status permohonan program pelajar berjaya dikemaskini.');
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

        return redirect()->route('advisor.profile')->with('success', 'Maklumat anda berjaya dikemaskini.');;
    }
}
