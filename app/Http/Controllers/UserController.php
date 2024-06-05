<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        return view('user.dashboard');
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

        $applicants = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
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

        return view('user.application', ['applicantsWithPrograms' => $applicantsWithPrograms]);
    }

    public function profile()
    {
        $user = Auth::user()
                ->join('religion', 'users.religion_id', '=', 'religion.id')
                ->join('nation', 'users.nation_id', '=', 'nation.id')
                ->join('sex', 'users.sex_id', '=', 'sex.id')
                ->join('bank', 'users.bank_id', '=', 'bank.id')
                ->select('users.*', 'religion.name AS religion', 'nation.name AS nation', 'sex.name AS sex', 'bank.name AS bank')
                ->where('users.id', Auth::id())
                ->first();

        dd($user);

        return view('user.profile', compact('user'));
    }
}
