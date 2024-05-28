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
                ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location')
                ->where(function($query) use ($ref, $id) {
                    $query->where('students.referral_code', $ref)
                          ->orWhere('students.user_id', $id);
                })
                ->orderBy('students.created_at', 'desc')
                ->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $filePath = 'urproject/student/resultspm/' . $applicant->ic . '.jpg';
            // $fileUrl = Storage::disk('linode')->url($filePath);

            if (Storage::disk('linode')->exists($filePath)) {
                // Generate the file URL
                $fileUrl = Storage::disk('linode')->url($filePath);
            } else {
                // If the file doesn't exist, set $fileUrl to null or any other default value
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

        return view('advisor.application', ['applicantsWithPrograms' => $applicantsWithPrograms]);
    }

    public function update(Request $request, $ic)
    {
        $programs = $request->input('programs'); // This should be an array

        foreach ($programs as $program) {
            $status = $program['status'];
            $notes = $program['notes'];
            $id = $program['id'];

            DB::table('student_programs')
                ->where('student_programs.student_ic', $ic)
                ->where('student_programs.id', $id)
                ->update(['student_programs.status' => $status, 'student_programs.notes' => $notes]);
        }

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
                ->select('students.*', 'state.name AS state', 'users.name AS user', 'location.name AS location')
                ->where(function($query) use ($ref, $id) {
                    $query->where('students.referral_code', $ref)
                          ->orWhere('students.user_id', $id);
                })
                ->orderBy('students.created_at', 'desc')
                ->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $filePath = 'urproject/student/resultspm/' . $applicant->ic . '.jpg';
            // $fileUrl = Storage::disk('linode')->url($filePath);

            if (Storage::disk('linode')->exists($filePath)) {
                // Generate the file URL
                $fileUrl = Storage::disk('linode')->url($filePath);
            } else {
                // If the file doesn't exist, set $fileUrl to null or any other default value
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

        return view('advisor.application', ['applicantsWithPrograms' => $applicantsWithPrograms])->with('success', 'Status permohonan program pelajar berjaya dikemaskini.');
    }
}
