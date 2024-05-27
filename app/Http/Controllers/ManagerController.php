<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
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
        return view('manager.dashboard');
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
                ->orderBy('students.name', 'asc')
                ->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $programs = DB::table('student_programs')
                        ->join('program', 'student_programs.program_id', '=', 'program.id')
                        ->select('student_programs.id', 'program.name', 'student_programs.status')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs
            ];

        }

        return view('manager.application', ['applicantsWithPrograms' => $applicantsWithPrograms]);
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
                ->orderBy('students.name', 'asc')
                ->get();

        $applicantsWithPrograms = [];

        foreach ($applicants as $applicant) {

            $programs = DB::table('student_programs')
                        ->join('program', 'student_programs.program_id', '=', 'program.id')
                        ->select('student_programs.id', 'program.name', 'student_programs.status')
                        ->where('student_programs.student_ic', $applicant->ic)
                        ->get();

            $applicantsWithPrograms[] = [
                'applicant' => $applicant,
                'programs' => $programs
            ];

        }

        return view('manager.application', ['applicantsWithPrograms' => $applicantsWithPrograms])->with('success', '.');
    }
}
