<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $states = DB::table('state')->get();
        $locations = DB::table('location')->get();
        $ref = $request->query('ref');

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);

        return view('student.register', compact('ref', 'states', 'locations', 'years'));
    }

    public function location($id)
    {
        $programs = DB::table('program')->where('location_id', $id)->get();
        return response()->json($programs);
    }

    public function register(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:10240', // max 10MB
        ]);

        $referral_code = $request->input('referral_code');

        $user = User::where('referral_code', 'LIKE', $referral_code)->first();

        $ref = $user ? $user : null;

        $ic = $request->input('ic');
        $students = DB::table('students')
                    ->where('ic', $ic)
                    ->first();
                    
        if ($students === null)
        {
            $name = $request->input('name');
            $ic = $request->input('ic');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $address1 = $request->input('address1');
            $address2 = $request->input('address2');
            $postcode = $request->input('postcode');
            $city = $request->input('city');
            $state = $request->input('state');
            $year = $request->input('year');
            $location = $request->input('location');
            $programA = $request->input('programA');
            $programB = $request->input('programB');

            if ($referral_code !== null) {
                $user = User::where('referral_code', $referral_code)
                        ->where('type', 1)
                        ->first();
                
                if ($user) {
                    $userID = $user->id;
                } else {
                    $userID = null;
                }
            } else {
                $userID = null;
            }

            DB::table('students')->insert([
                'name'=>$name,
                'ic'=>$ic,
                'phone'=>$phone,
                'email'=>$email,
                'address1'=>$address1,
                'address2'=>$address2,
                'postcode'=>$postcode,
                'city'=>$city,
                'state_id'=>$state,
                'spm_year'=>$year,
                'location_id'=>$location,
                'referral_code'=>$ref,
                'user_id'=>$userID
            ]);

            $student = DB::table('students')->where('ic', $ic)->first();

            DB::table('student_programs')->insert([
                'student_ic'=>$ic,
                'program_id'=>$programA
            ]);

            DB::table('student_programs')->insert([
                'student_ic'=>$ic,
                'program_id'=>$programB
            ]);

            $stateName = DB::table('state')->where('id', $state)->value('name');
            
            $locationName = DB::table('location')->where('id', $location)->value('name');

            $programNames = DB::table('student_programs')
                            ->join('program', 'student_programs.program_id', '=', 'program.id')
                            ->select('program.name', 'student_programs.status')
                            ->where('student_programs.student_ic', $ic)
                            ->get();

            $file = $request->file('file');

             // Upload file to Linode and set it as public
            $filePath = 'urproject/student/resultspm/' . $ic . '.' . $file->getClientOriginalExtension();

            // Get the file URL from Linode
            $fileUrl = Storage::disk('linode')->url($filePath);

            // dd($filePath);

            Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

            return redirect()->route('student.confirmation')
            ->with([
                'name'=>$name, 
                'ic'=>$ic,
                'phone'=>$phone,
                'email'=>$email,
                'address1'=>$address1,
                'address2'=>$address2,
                'postcode'=>$postcode,
                'city'=>$city,
                'state'=>$stateName,
                'year'=>$year,
                'location'=>$locationName,
                'program'=>$programNames,
                'created_at' => $student->created_at,
                'msg_reg' => 'Maklumat berjaya didaftarkan.'
            ]);
        }
        else
        {
            return redirect()->back()->with('msg_error', 'No. kad pengenalan telah didaftar di dalam sistem.');
        }
    }

    public function confirmation(Request $request)
    {
        if (!$request->session()->has('ic')) {
            return redirect()->route('student.register')->with('msg_error', 'Tiada data pelajar. Sila daftar terlebih dahulu.');
        }

        return view('student.confirmation');
    }

    public function search(Request $request)
    {
        $ic = $request->input('ic');
        
        $students = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
                    ->leftjoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS user', 'users.phone AS user_phone', 'location.name AS location')
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->get();

        $studentPrograms = DB::table('student_programs')
                            ->join('program', 'student_programs.program_id', '=', 'program.id')
                            ->select('program.name AS program', 'student_programs.status AS status', 'student_programs.notes')
                            ->where('student_programs.student_ic', 'LIKE', "{$ic}")
                            ->get();

        return view('student.search', compact('students', 'ic', 'studentPrograms'));
    }

    public function offerletter(Request $request)
    {
        $ic = $request->input('ic');

        $students = DB::table('students')
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->get();

        return view('student.offerletter', compact('students'));
    }
}
