<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentRegistrationNotification;

class StudentController extends Controller
{
    public function index(Request $request)
    {   
        $states = DB::table('state')->get();
        $locations = DB::table('location')->get();
        $ref = $request->query('ref');
        $source = $request->query('source');

        $isEmbedded = $request->query('embed') === 'true';

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);

        return view('student.register', compact('ref', 'states', 'locations', 'years', 'source', 'isEmbedded'));
    }

    public function index_kupd(Request $request)
    {   
        $states = DB::table('state')->get();
        $locations = DB::table('location')->where('location.id', 1)->get();
        $ref = $request->query('ref');
        $source = $request->query('source');

        $isEmbedded = $request->query('embed') === 'true';

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);

        $programs = DB::table('program')
            ->where('location_id', '1')
            ->where('program.offered', 1)
            ->get();

        return view('student.register-kupd', compact('ref', 'states', 'locations', 'years', 'source', 'isEmbedded', 'programs'));
    }

    public function index_kukb(Request $request)
    {   
        $states = DB::table('state')->get();
        $locations = DB::table('location')->where('location.id', 2)->get();
        $ref = $request->query('ref');
        $source = $request->query('source');

        $isEmbedded = $request->query('embed') === 'true';

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);

        $programs = DB::table('program')
            ->where('location_id', '2')
            ->where('program.offered', 1)
            ->get();

        return view('student.register-kukb', compact('ref', 'states', 'locations', 'years', 'source', 'isEmbedded', 'programs'));
    }

    public function location($id)
    {
        $programs = DB::table('program')
            ->where('location_id', $id)
            ->where('program.offered', 1)
            ->get();
        return response()->json($programs);
    }

    public function register(Request $request)
    {
        $ref = $request->query('ref');
        $source = $request->input('source');
        
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:5120', // max 5MB
        ], [
            'file.required' => 'Salinan SPM diperlukan.',
            'file.mimes' => 'Salinan SPM mestilah dalam bentuk fail jpg, jpeg, png atau pdf.',
            'file.max' => 'Saiz salinan SPM mestilah tidak melebihi 5MB.',
        ]);

        $referral_code = $request->input('referral_code');

        $ref = null;
        $userID = null;
        $update = null;

        if ($referral_code !== null) {
            $user = User::where('referral_code', $referral_code)->first();

            if ($user !== null) { // Check if user is found
                $ref = $user->referral_code;

                if ($user->type === 'advisor') { // Adjust the comparison based on actual returned value
                    $userID = $user->id;
                    $update = date('Y-m-d H:i:s');
                }
                else {
                    $userID = $user->leader_id;
                }
            }
        }

        $ic = $request->input('ic');
        $studentlists = DB::connection('mysql2')->table('students')->where('ic', $ic)
        ->first();

        if($studentlists === null)
        {
            $ic = $request->input('ic');
            $students = DB::table('students')
                        ->where('ic', $ic)
                        ->first();
                        
            if ($students === null)
            {
                $name = strtoupper($request->input('name'));
                $ic = $request->input('ic');
                $phone = $request->input('phone');
                $email = $request->input('email');
                $address1 = strtoupper($request->input('address1'));
                $address2 = strtoupper($request->input('address2'));
                $postcode = $request->input('postcode');
                $city = strtoupper($request->input('city'));
                $state = $request->input('state');
                $year = $request->input('year');
                $location = 1;
                $source = $request->input('source') ?? 'e-Daftar';
                $programA = $request->input('programA');
                $programB = $request->input('programB');

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
                    'user_id'=>$userID,
                    'source'=>$source,
                    'updated_at'=> $update
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

                Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

                // Get the file URL from Linode
                $fileUrl = Storage::disk('linode')->url($filePath);

                DB::table('student_url_path')->insert([
                    'student_ic'=>$ic,
                    'email'=>$email,
                    'path'=>$fileUrl
                ]);

                // Send data to UChatWebhook
                try {
                    $webhookUrl = env('UCHAT_WEBHOOK_URL');
                    
                    
                    if (!$webhookUrl) {
                        throw new \Exception('Webhook URL not configured');
                    }
                
                    $webhook = Http::post($webhookUrl, [
                        'name' => $name,
                        'phone' => $phone,
                        'email' => $email
                    ]);
                    
                    if (!$webhook->successful()) {
                        throw new \Exception('Webhook request failed: ' . $webhook->status());
                    }
                    
                } catch (\Exception $e) {
                    \Log::error('UChatWebhook Error: ' . $e->getMessage());
                }

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
        else {
            return redirect()->back()->with('msg_error', 'No. kad pengenalan telah didaftar di dalam Sistem Maklumat Pelajar Kolej UNITI.');
        }
    }

    public function register_kupd(Request $request)
    {
        $ref = $request->query('ref');
        $source = $request->input('source');
        
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:5120', // max 5MB
        ], [
            'file.required' => 'Salinan SPM diperlukan.',
            'file.mimes' => 'Salinan SPM mestilah dalam bentuk fail jpg, jpeg, png atau pdf.',
            'file.max' => 'Saiz salinan SPM mestilah tidak melebihin 5MB.',
        ]);

        $referral_code = $request->input('referral_code');

        $ref = null;
        $userID = null;
        $update = null;

        if ($referral_code !== null) {
            $user = User::where('referral_code', $referral_code)->first();

            if ($user !== null) { // Check if user is found
                $ref = $user->referral_code;

                if ($user->type === 'advisor') { // Adjust the comparison based on actual returned value
                    $userID = $user->id;
                    $update = date('Y-m-d H:i:s');
                }
                else {
                    $userID = $user->leader_id;
                }
            }
        }

        $ic = $request->input('ic');
        $studentlists = DB::connection('mysql2')->table('students')->where('ic', $ic)
        ->first();

        if($studentlists === null)
        {
            $ic = $request->input('ic');
            $students = DB::table('students')
                        ->where('ic', $ic)
                        ->first();
                        
            if ($students === null)
            {
                $name = strtoupper($request->input('name'));
                $ic = $request->input('ic');
                $phone = $request->input('phone');
                $email = $request->input('email');
                $address1 = strtoupper($request->input('address1'));
                $address2 = strtoupper($request->input('address2'));
                $postcode = $request->input('postcode');
                $city = strtoupper($request->input('city'));
                $state = $request->input('state');
                $year = $request->input('year');
                $location = '1';
                $source = $request->input('source') ?? 'e-Daftar';
                $programA = $request->input('programA');
                $programB = $request->input('programB');

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
                    'user_id'=>$userID,
                    'source'=>$source,
                    'updated_at'=> $update
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

                Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

                // Get the file URL from Linode
                $fileUrl = Storage::disk('linode')->url($filePath);

                DB::table('student_url_path')->insert([
                    'student_ic'=>$ic,
                    'email'=>$email,
                    'path'=>$fileUrl
                ]);
                
                // Prepare student data for the email
                $studentData = [
                    'name' => $name,
                    'ic' => $ic,
                    'email' => $email,
                    'phone' => $phone,
                    'programA' => $programA,
                    'programB' => $programB,
                    'source' => $source
                ];

                // Send the email notification
                try {
                    Mail::to('faizulsoknan@gmail.com')->send(new \App\Mail\StudentRegistrationNotification($studentData));
                    // Optional: log success or set a session variable
                    // Log::info('Registration notification email sent successfully');
                } catch (\Exception $e) {
                    // Optional: log the error
                    // Log::error('Failed to send registration notification email: ' . $e->getMessage());
                }

                // Send data to UChatWebhook
                try {
                    $webhookUrl = env('UCHAT_WEBHOOK_URL');
                    
                    
                    if (!$webhookUrl) {
                        throw new \Exception('Webhook URL not configured');
                    }
                
                    $webhook = Http::post($webhookUrl, [
                        'name' => $name,
                        'phone' => $phone,
                        'email' => $email
                    ]);
                    
                    if (!$webhook->successful()) {
                        throw new \Exception('Webhook request failed: ' . $webhook->status());
                    }
                    
                } catch (\Exception $e) {
                    \Log::error('UChatWebhook Error: ' . $e->getMessage());
                }

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
        else {
            return redirect()->back()->with('msg_error', 'No. kad pengenalan telah didaftar di dalam Sistem Maklumat Pelajar Kolej UNITI.');
        }
    }

    public function register_kukb(Request $request)
    {
        $ref = $request->query('ref');
        $source = $request->input('source');
        
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:5120', // max 5MB
        ], [
            'file.required' => 'Salinan SPM diperlukan.',
            'file.mimes' => 'Salinan SPM mestilah dalam bentuk fail jpg, jpeg, png atau pdf.',
            'file.max' => 'Saiz salinan SPM mestilah tidak melebihin 5MB.',
        ]);

        $referral_code = $request->input('referral_code');

        $ref = null;
        $userID = null;
        $update = null;

        if ($referral_code !== null) {
            $user = User::where('referral_code', $referral_code)->first();

            if ($user !== null) { // Check if user is found
                $ref = $user->referral_code;

                if ($user->type === 'advisor') { // Adjust the comparison based on actual returned value
                    $userID = $user->id;
                    $update = date('Y-m-d H:i:s');
                }
                else {
                    $userID = $user->leader_id;
                }
            }
        }

        $ic = $request->input('ic');
        $studentlists = DB::connection('mysql2')->table('students')->where('ic', $ic)
        ->first();

        if($studentlists === null)
        {
            $ic = $request->input('ic');
            $students = DB::table('students')
                        ->where('ic', $ic)
                        ->first();
                        
            if ($students === null)
            {
                $name = strtoupper($request->input('name'));
                $ic = $request->input('ic');
                $phone = $request->input('phone');
                $email = $request->input('email');
                $address1 = strtoupper($request->input('address1'));
                $address2 = strtoupper($request->input('address2'));
                $postcode = $request->input('postcode');
                $city = strtoupper($request->input('city'));
                $state = $request->input('state');
                $year = $request->input('year');
                $location = '2';
                $source = $request->input('source') ?? 'e-Daftar';
                $programA = $request->input('programA');
                $programB = $request->input('programB');

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
                    'user_id'=>$userID,
                    'source'=>$source,
                    'updated_at'=> $update
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

                Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

                // Get the file URL from Linode
                $fileUrl = Storage::disk('linode')->url($filePath);

                DB::table('student_url_path')->insert([
                    'student_ic'=>$ic,
                    'email'=>$email,
                    'path'=>$fileUrl
                ]);

                // Prepare student data for the email
                $studentData = [
                    'name' => $name,
                    'ic' => $ic,
                    'email' => $email,
                    'phone' => $phone,
                    'programA' => $programA,
                    'programB' => $programB,
                    'source' => $source
                ];

                // Send the email notification
                try {
                    Mail::to('faizulsoknan@gmail.com')->send(new \App\Mail\StudentRegistrationNotification($studentData));
                    // Optional: log success or set a session variable
                    // Log::info('Registration notification email sent successfully');
                } catch (\Exception $e) {
                    // Optional: log the error
                    // Log::error('Failed to send registration notification email: ' . $e->getMessage());
                }

                // Send data to UChatWebhook
                try {
                    $webhookUrl = env('UCHAT_WEBHOOK_URL');
                    
                    
                    if (!$webhookUrl) {
                        throw new \Exception('Webhook URL not configured');
                    }
                
                    $webhook = Http::post($webhookUrl, [
                        'name' => $name,
                        'phone' => $phone,
                        'email' => $email
                    ]);
                    
                    if (!$webhook->successful()) {
                        throw new \Exception('Webhook request failed: ' . $webhook->status());
                    }
                    
                } catch (\Exception $e) {
                    \Log::error('UChatWebhook Error: ' . $e->getMessage());
                }

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
        else {
            return redirect()->back()->with('msg_error', 'No. kad pengenalan telah didaftar di dalam Sistem Maklumat Pelajar Kolej UNITI.');
        }
    }

    public function confirmation(Request $request)
    {
        $ref = $request->query('ref');
        
        if (!$request->session()->has('ic')) {
            return redirect()->route('student.register')->with('msg_error', 'Tiada data pelajar. Sila daftar terlebih dahulu.');
        }

        return view('student.confirmation', compact('ref'));
    }

    public function search(Request $request)
    {
        $ref = $request->query('ref');
        $ic = $request->input('ic');
        
        $states = DB::table('state')->get();

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);
        
        $students = DB::table('students')
                    ->leftjoin('state', 'students.state_id', '=', 'state.id')
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

        return view('student.search', compact('ref', 'students', 'states', 'years', 'ic', 'studentPrograms'));
    }

    public function offerletter(Request $request)
    {
        $ref = $request->query('ref');
        $ic = $request->input('ic');

        $students = DB::table('students')
                    ->join('state', 'students.state_id', '=', 'state.id')
                    ->join('users', 'students.user_id', '=', 'users.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS advisor', 'users.phone')
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->get();
        
        foreach ($students as $student) {
            $studentprograms = DB::table('student_programs')
                            ->join('program', 'student_programs.program_id', '=', 'program.id')
                            ->select('program.name AS program')
                            ->where('student_programs.student_ic', $student->ic)
                            ->where('student_programs.status', '=', 'layak' )
                            ->get();
        }

        return view('student.offerletter', compact('ref','students', 'studentprograms'));
    }

    public function about(Request $request)
    {
        // Get the referrer from the headers, or 'other' if not available
        $referrer = $request->headers->get('referer', 'other');

        if (strpos($referrer, 'ttclid') !== false || $request->query('ttclid')) {
            $source = 'tiktok';
        } elseif (strpos($referrer, 'gclid') !== false || $request->query('gclid')) {
            $source = 'google';
        } elseif (strpos($referrer, 'fbclid') !== false || $request->query('fbclid')) {
            $source = 'facebook';
        } elseif (strpos($referrer, 'msclkid') !== false || $request->query('msclkid')) {
            $source = 'microsoft';
        } elseif (strpos($referrer, 'twclid') !== false || $request->query('twclid')) {
            $source = 'twitter';
        } elseif (strpos($referrer, '_gl') !== false || $request->query('_gl')) {
            $source = 'google-analytics';
        } elseif (strpos($referrer, 'tiktok.com') !== false) {
            $source = 'tiktok';
        } else {
            // Log the referrer and other relevant request data
            \Log::info('Referrer: ' . $referrer);
            \Log::info('Full Request URL: ' . $request->fullUrl());
            \Log::info('Request Query String: ' . json_encode($request->query()));

            // Check if source is provided in the query string or determine source
            $source = $request->query('source', $this->determineSource($referrer));
        }

        // Set default to "e-Daftar" if source is empty or still "other"
        if (empty($source) || $source === 'other') {
            $source = 'e-Daftar';
        }

        $ref = $request->query('ref');

        return view('student.about', compact('ref', 'source'));
    }

    public function kupd(Request $request)
    {
        // Get the referrer from the headers, or 'other' if not available
        $referrer = $request->headers->get('referer', 'other');

        if (strpos($referrer, 'ttclid') !== false || $request->query('ttclid')) {
            $source = 'tiktok';
        } elseif (strpos($referrer, 'gclid') !== false || $request->query('gclid')) {
            $source = 'google';
        } elseif (strpos($referrer, 'fbclid') !== false || $request->query('fbclid')) {
            $source = 'facebook';
        } elseif (strpos($referrer, 'msclkid') !== false || $request->query('msclkid')) {
            $source = 'microsoft';
        } elseif (strpos($referrer, 'twclid') !== false || $request->query('twclid')) {
            $source = 'twitter';
        } elseif (strpos($referrer, '_gl') !== false || $request->query('_gl')) {
            $source = 'google-analytics';
        } elseif (strpos($referrer, 'tiktok.com') !== false) {
            $source = 'tiktok';
        } else {
            // Log the referrer and other relevant request data
            \Log::info('Referrer: ' . $referrer);
            \Log::info('Full Request URL: ' . $request->fullUrl());
            \Log::info('Request Query String: ' . json_encode($request->query()));

            // Check if source is provided in the query string or determine source
            $source = $request->query('source', $this->determineSource($referrer));
        }

        // Set default to "e-Daftar" if source is empty or still "other"
        if (empty($source) || $source === 'other') {
            $source = 'e-Daftar';
        }

        $ref = $request->query('ref');

        return view('student.kupd', compact('ref', 'source'));
    }

    public function kukb(Request $request)
    {
        // Get the referrer from the headers, or 'other' if not available
        $referrer = $request->headers->get('referer', 'other');

        if (strpos($referrer, 'ttclid') !== false || $request->query('ttclid')) {
            $source = 'tiktok';
        } elseif (strpos($referrer, 'gclid') !== false || $request->query('gclid')) {
            $source = 'google';
        } elseif (strpos($referrer, 'fbclid') !== false || $request->query('fbclid')) {
            $source = 'facebook';
        } elseif (strpos($referrer, 'msclkid') !== false || $request->query('msclkid')) {
            $source = 'microsoft';
        } elseif (strpos($referrer, 'twclid') !== false || $request->query('twclid')) {
            $source = 'twitter';
        } elseif (strpos($referrer, '_gl') !== false || $request->query('_gl')) {
            $source = 'google-analytics';
        } elseif (strpos($referrer, 'tiktok.com') !== false) {
            $source = 'tiktok';
        } else {
            // Log the referrer and other relevant request data
            \Log::info('Referrer: ' . $referrer);
            \Log::info('Full Request URL: ' . $request->fullUrl());
            \Log::info('Request Query String: ' . json_encode($request->query()));

            // Check if source is provided in the query string or determine source
            $source = $request->query('source', $this->determineSource($referrer));
        }

        // Set default to "e-Daftar" if source is empty or still "other"
        if (empty($source) || $source === 'other') {
            $source = 'e-Daftar';
        }

        $ref = $request->query('ref');

        return view('student.kukb', compact('ref', 'source'));
    }

    private function determineSource($referrer)
    {
        $referrer = strtolower($referrer); // Ensure case-insensitivity

        if ($referrer === 'other') {
            return 'e-Daftar'; // Default to e-Daftar if referrer is not recognized
        } elseif ($referrer === 'tiktok') {
            return 'tiktok';
        }

        // Check for various referrer strings
        if (strpos($referrer, 'https://l.facebook.com') !== false) {
            return 'facebook';
        } elseif (strpos($referrer, 'https://lm.facebook.com/') !== false) {
            return 'facebook';
        } elseif (strpos($referrer, 'https://m.facebook.com/') !== false) {
            return 'facebook';
        } elseif (strpos($referrer, 'https://www.facebook.com/') !== false) {
            return 'facebook';
        } elseif (strpos($referrer, 'https://www.whatsapp.com/') !== false) {
            return 'whatsapp';
        } elseif (strpos($referrer, 'https://web.whatsapp.com/') !== false) {
            return 'whatsapp';
        } elseif (strpos($referrer, 'https://www.tiktok.com/') !== false) {
            return 'tiktok';
        } elseif (strpos($referrer, 'https://www.pangleglobal.com/') !== false) {
            return 'tiktok';
        } elseif (strpos($referrer, 'https://ether-pack-va.pangle.io/') !== false) {
            return 'tiktok';
        } elseif (strpos($referrer, 'https://www.instagram.com/') !== false) {
            return 'instagram';
        } elseif (strpos($referrer, 'https://l.instagram.com/') !== false) {
            return 'instagram';
        } elseif (strpos($referrer, 'https://edaftarkolej.uniticms.edu.my/') !== false) {
            return 'e-Daftar';
        } elseif (strpos($referrer, 'https://uniti.edu.my/') !== false) {
            return 'website';
        } elseif (strpos($referrer, 'https://www.google.com/') !== false) {
            return 'google';
        } elseif (strpos($referrer, 'https://www.google.com.my/') !== false) {
            return 'google';
        } elseif (strpos($referrer, 'https://.youtube.com/') !== false) {
            return 'youtube';
        }

        // Default to "e-Daftar" if no other source matches
        return 'e-Daftar';
    }

    public function registerTest(Request $request)
    {
        // Log incoming data for debugging
        \Log::info('Gravity Form webhook data received:', $request->all());

        try {
            // Get program value by checking all possible program field IDs
            $program = $request->input('4') ?? 
                      $request->input('5') ?? 
                      $request->input('6') ?? null;

            // Validate that required fields are present
            if (!$request->input('3') || !$program || !$request->input('7') || 
                !$request->input('8') || !$request->input('1')) {
                \Log::warning('Missing required fields in form submission', [
                    'faculty' => $request->input('3'),
                    'program' => $program,
                    'name' => $request->input('7'),
                    'email' => $request->input('8'),
                    'mobile' => $request->input('1')
                ]);
                return response()->json(['error' => 'Missing required fields'], 400);
            }

            // Store in database using Gravity Forms field IDs
            DB::table('student_tests')->insert([
                'faculty' => $request->input('3'),    // Faculty (ID: 3)
                'program' => $program,                // Program (IDs: 4,5,6)
                'level' => $request->input('9'),      // Level (ID: 9)
                'name' => $request->input('7'),       // Name (ID: 7)
                'email' => $request->input('8'),      // Email (ID: 8)
                'mobile' => $request->input('1'),     // Mobile (ID: 1)
                'created_at' => now()
            ]);

            return response()->json(['success' => true, 'message' => 'Data stored successfully']);
        } catch (\Exception $e) {
            \Log::error('Error storing Gravity Form data: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function miniForm(Request $request)
    {
        // Log incoming data for debugging
        \Log::info('Mini form webhook data received:', $request->all());

        try {

            // Store in database using Gravity Forms field IDs
            DB::table('students')->insert([
                'name' => strtoupper($request->input('1')),
                'ic' => $request->input('3'),
                'phone' => $request->input('19'),
                'email' => $request->input('7'),
                'location_id' => 1,
                'source' => 'website',
                'created_at' => now()
            ]);

            // 1st program choice
            $programA = $request->input('9') ?? null;

            if ($programA) {
                $programA_id = DB::table('program')
                    ->whereRaw('BINARY UPPER(TRIM(name)) = ?', [strtoupper(trim($programA))])
                    ->value('id');

                if ($programA_id) {
                    DB::table('student_programs')->insert([
                        'student_ic' => $request->input('3'),
                        'program_id' => $programA_id
                    ]);
                }
            }

            // 2nd program choice
            $programB = $request->input('20') ?? null;

            if ($programB) {
                $programB_id = DB::table('program')
                    ->whereRaw('BINARY UPPER(TRIM(name)) = ?', [strtoupper(trim($programB))])
                    ->value('id');

                if ($programB_id) {
                    DB::table('student_programs')->insert([
                        'student_ic' => $request->input('3'),
                        'program_id' => $programB_id
                    ]);
                }
            }

            return response()->json(['success' => true, 'message' => 'Data stored successfully']);
            
        } catch (\Exception $e) {
            \Log::error('Error storing mini form data: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function semak_permohonan(Request $request)
    {
        $ref = $request->query('ref');
        $ic = $request->input('ic');
        
        $states = DB::table('state')->get();

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);
        
        $students = DB::table('students')
                    ->leftjoin('state', 'students.state_id', '=', 'state.id')
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
                            
        $extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $foundFile = null;
        
        foreach ($extensions as $ext) {
            $filePath = 'urproject/student/resultspm/' . $ic . '.' . $ext; // Path without disk URL
        
            if (Storage::disk('linode')->exists($filePath)) {
                $foundFile = Storage::disk('linode')->url($filePath); // Get the actual URL
                break;
            }
        }                            

        return view('student.search', compact('ref', 'students', 'states', 'years', 'ic', 'studentPrograms', 'foundFile'));
    }

    public function semak_permohonan_kupd(Request $request)
    {
        $ref = $request->query('ref');
        $ic = $request->input('ic');
        
        $states = DB::table('state')->get();

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);
        
        $students = DB::table('students')
                    ->leftjoin('state', 'students.state_id', '=', 'state.id')
                    ->leftjoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS user', 'users.phone AS user_phone', 'location.name AS location')
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->where('location.id', '=', 1)
                    ->get();

        $studentPrograms = DB::table('student_programs')
                            ->join('program', 'student_programs.program_id', '=', 'program.id')
                            ->select('program.name AS program', 'student_programs.status AS status', 'student_programs.notes')
                            ->where('student_programs.student_ic', 'LIKE', "{$ic}")
                            ->get();
                            
        $extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $foundFile = null;
        
        foreach ($extensions as $ext) {
            $filePath = 'urproject/student/resultspm/' . $ic . '.' . $ext; // Path without disk URL
        
            if (Storage::disk('linode')->exists($filePath)) {
                $foundFile = Storage::disk('linode')->url($filePath); // Get the actual URL
                break;
            }
        }                            

        return view('student.search-kupd', compact('ref', 'students', 'states', 'years', 'ic', 'studentPrograms', 'foundFile'));
    }

    public function kemaskini_permohonan_kupd($id, $email, Request $request)
    {   
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $postcode = $request->input('postcode');
        $city = $request->input('city');
        $state = $request->input('state');
        $year = $request->input('year');

        $update_student = DB::table('students')
                            ->where('students.ic', $id)
                            ->update(['address1'=>$address1, 'address2'=>$address2, 'postcode'=>$postcode, 'city'=>$city, 'state_id'=>$state, 'spm_year'=>$year]);

        

        $file = $request->file('file');

        // Upload file to Linode and set it as public
        $filePath = 'urproject/student/resultspm/' . $id . '.' . $file->getClientOriginalExtension();

        Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

        // Get the file URL from Linode
        $fileUrl = Storage::disk('linode')->url($filePath);

        DB::table('student_url_path')->insert([
            'student_ic'=>$id,
            'email'=>$email,
            'path'=>$fileUrl
        ]);

        return redirect()->route('semak.permohonan.kupd');
    }

    public function semak_permohonan_kukb(Request $request)
    {
        $ref = $request->query('ref');
        $ic = $request->input('ic');
        
        $states = DB::table('state')->get();

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);
        
        $students = DB::table('students')
                    ->leftjoin('state', 'students.state_id', '=', 'state.id')
                    ->leftjoin('users', 'students.user_id', '=', 'users.id')
                    ->join('location', 'students.location_id', '=', 'location.id')
                    ->select('students.*', 'state.name AS state', 'users.name AS user', 'users.phone AS user_phone', 'location.name AS location')
                    ->where('students.ic', 'LIKE', "{$ic}")
                    ->where('location.id', '=', 2)
                    ->get();

        $studentPrograms = DB::table('student_programs')
                            ->join('program', 'student_programs.program_id', '=', 'program.id')
                            ->select('program.name AS program', 'student_programs.status AS status', 'student_programs.notes')
                            ->where('student_programs.student_ic', 'LIKE', "{$ic}")
                            ->get();
                            
        $extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $foundFile = null;
        
        foreach ($extensions as $ext) {
            $filePath = 'urproject/student/resultspm/' . $ic . '.' . $ext; // Path without disk URL
        
            if (Storage::disk('linode')->exists($filePath)) {
                $foundFile = Storage::disk('linode')->url($filePath); // Get the actual URL
                break;
            }
        }                            

        return view('student.search-kukb', compact('ref', 'students', 'states', 'years', 'ic', 'studentPrograms', 'foundFile'));
    }

    public function kemaskini_permohonan_kukb($id, $email, Request $request)
    {   
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $postcode = $request->input('postcode');
        $city = $request->input('city');
        $state = $request->input('state');
        $year = $request->input('year');

        $update_student = DB::table('students')
                            ->where('students.ic', $id)
                            ->update(['address1'=>$address1, 'address2'=>$address2, 'postcode'=>$postcode, 'city'=>$city, 'state_id'=>$state, 'spm_year'=>$year]);

        

        $file = $request->file('file');

        // Upload file to Linode and set it as public
        $filePath = 'urproject/student/resultspm/' . $id . '.' . $file->getClientOriginalExtension();

        Storage::disk('linode')->put($filePath, file_get_contents($file), 'public');

        // Get the file URL from Linode
        $fileUrl = Storage::disk('linode')->url($filePath);

        DB::table('student_url_path')->insert([
            'student_ic'=>$id,
            'email'=>$email,
            'path'=>$fileUrl
        ]);

        return redirect()->route('semak.permohonan.kukb');
    }

}
