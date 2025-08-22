<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

Route::get('/image-proxy', function (Request $request) {
    $url = $request->query('url');
    $download = $request->boolean('download');

    if (!$url) {
        abort(400, "Image URL is required.");
    }

    try {
        $response = Http::withOptions(['stream' => true])->get($url);

        if ($response->failed()) {
            abort(404, "Image not found.");
        }

        $contentType = $response->header('Content-Type', 'image/jpeg');
        $filename = basename(parse_url($url, PHP_URL_PATH)) ?: 'image.jpg';

        $headers = [
            "Content-Type" => $contentType,
            "Cache-Control" => "public, max-age=86400",
        ];

        if ($download) {
            $headers["Content-Disposition"] = "attachment; filename=\"{$filename}\"";
        }

        return Response::stream(function () use ($response) {
            // Stream chunks instead of loading entire file into memory
            echo $response->getBody()->getContents();
        }, 200, $headers);

    } catch (\Exception $e) {
        abort(500, "Error fetching image: " . $e->getMessage());
    }
});

// Route::get('/db-check', function () {
//     try {
//         DB::connection('mysql')->getPdo();
//         echo "Default DB Connected.<br>";

//         DB::connection('mysql2')->getPdo();
//         echo "Second DB Connected.<br>";

//         DB::connection('mysql3')->getPdo();
//         echo "Third DB Connected.<br>";

//     } catch (\Exception $e) {
//         return 'Connection failed: ' . $e->getMessage();
//     }
// });

// Route::get('/', function (Request $request) {
//     if (auth()->check()) {
//         switch (auth()->user()->type) {
//             case 'user':
//                 return redirect('/user/dashboard');
//             case 'advisor':
//                 return redirect('/advisor/dashboard');
//             case 'admin':
//                 return redirect('/admin/dashboard');
//         }
//     }

//     $ref = $request->query('ref');

//     // $source = $request->query('source') ?? (new \App\Http\Controllers\StudentController)->determineSource($request);

//     if (empty($source) || $source === 'other') {
//         $source = 'e-Daftar';
//     }
    
//     return view('welcome', compact('ref', 'source')); // Or any other public view
// });

if (!function_exists('determineSourceFromReferrer')) {
    function determineSourceFromReferrer($referrer)
    {
        $referrer = strtolower($referrer); // case insensitive

        if ($referrer === 'other') {
            return 'e-Daftar';
        } elseif ($referrer === 'tiktok') {
            return 'tiktok';
        }

        if (strpos($referrer, 'facebook.com') !== false) {
            return 'facebook';
        } elseif (strpos($referrer, 'whatsapp.com') !== false) {
            return 'whatsapp';
        } elseif (strpos($referrer, 'tiktok.com') !== false || strpos($referrer, 'pangleglobal.com') !== false || strpos($referrer, 'pangle.io') !== false) {
            return 'tiktok';
        } elseif (strpos($referrer, 'instagram.com') !== false) {
            return 'instagram';
        } elseif (strpos($referrer, 'edaftarkolej.uniticms.edu.my') !== false) {
            return 'e-Daftar';
        } elseif (strpos($referrer, 'uniti.edu.my') !== false) {
            return 'website';
        } elseif (strpos($referrer, 'google.com') !== false || strpos($referrer, 'google.com.my') !== false) {
            return 'google';
        } elseif (strpos($referrer, 'youtube.com') !== false) {
            return 'youtube';
        }

        return 'e-Daftar'; // default fallback
    }
}

Route::get('/', function (Request $request) {
    if (auth()->check()) {
        switch (auth()->user()->type) {
            case 'user':
                return redirect('/user/dashboard');
            case 'advisor':
                return redirect('/advisor/dashboard');
            case 'admin':
                return redirect('/admin/dashboard');
        }
    }

    $ref = $request->query('ref');
    
    // Get referrer from headers
    $referrer = $request->headers->get('referer', 'other');

    // Check if source is in query, else determine from referrer
    $source = $request->query('source');

    if (empty($source)) {
        $source = determineSourceFromReferrer($referrer);
    }

    return view('welcome', compact('ref', 'source'));
});

// Route::get('/example', function () {
//     return view('example');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/affiliate', [RegisterController::class, 'about'])->name('about');
Route::get('/affiliate/register', [RegisterController::class, 'showRegistrationForm'])->name('affiliate.register');
Route::post('/affiliate/register', [RegisterController::class, 'register']);

// admin route
Route::middleware(['auth', 'user-access:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::match(['get', 'post'],'/admin/program', [AdminController::class, 'program'])->name('admin.program');
    Route::post('/admin/program/add', [AdminController::class, 'addprogram'])->name('admin.program.submit');
    Route::post('/admin/program/update/{id}', [AdminController::class, 'updateprogram'])->name('admin.program.update');
    Route::get('/admin/daftar/pengguna', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/daftar/pengguna', [AdminController::class, 'register']);
    Route::match(['get', 'post'], '/admin/senarai/permohonan', [AdminController::class, 'applications'])->name('admin.application');
    Route::post('/admin/maklumat/permohonan', [AdminController::class, 'applicationDetail'])->name('admin.application.detail');
    Route::put('/admin/kemaskini/permohonan/{id}', [AdminController::class, 'update'])->name('admin.application.update');
    Route::get('/admin/senarai/pengguna', [AdminController::class, 'userlist'])->name('admin.userlist');
    Route::post('/admin/senarai/pengguna/detail', [AdminController::class, 'userDetail'])->name('admin.userlist.detail');
    Route::put('/admin/kemaskini/pengguna/{id}', [AdminController::class, 'updateUser'])->name('admin.userlist.update');
    Route::match(['get', 'post'], '/admin/laporan/permohonan', [AdminController::class, 'studentlist'])->name('admin.studentlist');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/update/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/admin/update/password', [AdminController::class, 'password'])->name('admin.profile.password');
    // Route::get('/admin/summary', [AdminController::class, 'summary'])->name('admin.summary');
    Route::match(['get', 'post'], '/admin/laporan/statistik', [AdminController::class, 'summary'])->name('admin.summary');
    Route::post('/admin/maklumat/statistik', [AdminController::class, 'summaryDetail'])->name('admin.summary.detail');
    Route::match(['get', 'post'], '/admin/laporan/sumber', [AdminController::class, 'leadReports'])->name('admin.leadreports');
    Route::match(['get', 'post'], '/admin/laporan/tahunan', [AdminController::class, 'yearReports'])->name('admin.yearreports');
    Route::match(['get', 'post'], '/admin/laporan/pencapaian/ea', [AdminController::class, 'achievements'])->name('admin.achievements');
    Route::get('/admin/maklumat/pencapaian/ea/{id}/{start_date?}/{end_date?}/{location?}', [AdminController::class, 'achievementDetails'])->name('admin.achievement.details');
    Route::match(['get', 'post'], '/admin/laporan/pencapaian/affiliate', [AdminController::class, 'affiliateAchievements'])->name('admin.affiliateachievements');
    Route::get('/admin/maklumat/pencapaian/affiliate/{id}/{start_date?}/{end_date?}/{location?}', [AdminController::class, 'affiliateAchievementDetails'])->name('admin.affiliate.achievement.details');
    Route::match(['get', 'post'],'/admin/kandungan-media', [AdminController::class, 'contents'])->name('admin.content');
    Route::post('/admin/content/add', [AdminController::class, 'addcontent'])->name('admin.content.add');
    Route::delete('/admin/contents/{id}', [AdminController::class, 'destroy'])->name('admin.contents.destroy');


});

// advisor route
Route::middleware(['auth', 'user-access:advisor'])->group(function() {
    Route::get('/advisor/dashboard', [AdvisorController::class, 'dashboard'])->name('advisor.dashboard');
    Route::get('/advisor/list/applications', [AdvisorController::class, 'applications'])->name('advisor.application');
    Route::post('/advisor/application/detail', [AdvisorController::class, 'applicationDetail'])->name('advisor.application.detail');
    Route::put('/advisor/application/{id}', [AdvisorController::class, 'update'])->name('advisor.application.update');
    Route::get('/advisor/profile', [AdvisorController::class, 'profile'])->name('advisor.profile');
    Route::put('/advisor/update/profile', [AdvisorController::class, 'updateProfile'])->name('advisor.profile.update');
    Route::put('/advisor/update/password', [AdvisorController::class, 'password'])->name('advisor.profile.password');
    Route::get('/advisor/list/affiliates', [AdvisorController::class, 'affiliate'])->name('advisor.affiliate');
});

// user route
Route::middleware(['auth', 'user-access:user'])->group(function() {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/list/applications', [UserController::class, 'applications'])->name('user.application');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/user/update/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::put('/user/update/password', [UserController::class, 'password'])->name('user.profile.password');
    Route::get('/user/list/affiliates', [UserController::class, 'affiliate'])->name('user.affiliate');
    Route::match(['get', 'post'],'/user/kandungan-media', [UserController::class, 'contents'])->name('user.content');
});

// student route
Route::prefix('student')->group(function() {
    // Route::get('/register', [App\Http\Controllers\StudentController::class, 'index'])->name('student.register');
    // Route::post('/register', [App\Http\Controllers\StudentController::class, 'register'])->name('student.register.post');
    // Route::get('/confirmation', [App\Http\Controllers\StudentController::class, 'confirmation'])->name('student.confirmation');
    // Route::get('/search', [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');
    // Route::get('/location/{id}', [App\Http\Controllers\StudentController::class, 'location']);
    // Route::get('/offerletter', [App\Http\Controllers\StudentController::class, 'offerletter'])->name('student.offerletter');
    // Route::get('/about', [App\Http\Controllers\StudentController::class, 'about'])->name('student.about');
    
    // Test route
    Route::post('/register_test', [App\Http\Controllers\StudentController::class, 'registerTest'])->withoutMiddleware(VerifyCsrfToken::class);

    // mini form route
    Route::post('/mini-form', [App\Http\Controllers\StudentController::class, 'miniForm'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/mini-form-kukb', [App\Http\Controllers\StudentController::class, 'miniForm_kukb'])->withoutMiddleware(VerifyCsrfToken::class);
});

// register route
Route::prefix('daftar')->group(function() {
    Route::get('/port-dickson', [App\Http\Controllers\StudentController::class, 'index_kupd'])->name('student.register-kupd');
    Route::post('/port-dickson', [App\Http\Controllers\StudentController::class, 'register_kupd'])->name('student.register-kupd.post');
    Route::get('/port-dickson/pengesahan', [App\Http\Controllers\StudentController::class, 'pengesahan_kupd'])->name('student.confirmation-kupd');
    Route::get('/kota-bharu', [App\Http\Controllers\StudentController::class, 'index_kukb'])->name('student.register-kukb');
    Route::post('/kota-bharu', [App\Http\Controllers\StudentController::class, 'register_kukb'])->name('student.register-kukb.post');
    Route::get('/kota-bharu/pengesahan', [App\Http\Controllers\StudentController::class, 'pengesahan_kukb'])->name('student.confirmation-kukb');
});

// semak permohonan route
Route::prefix('semak-permohonan')->group(function() {
    Route::get('/port-dickson', [App\Http\Controllers\StudentController::class, 'semak_permohonan_kupd'])->name('semak.permohonan.kupd');
    Route::get('/kota-bharu', [App\Http\Controllers\StudentController::class, 'semak_permohonan_kukb'])->name('semak.permohonan.kukb');
    Route::put('/kemaskini/kupd/{id}/{email}', [App\Http\Controllers\StudentController::class, 'kemaskini_permohonan_kupd'])->name('kemaskini.permohonan.kupd');
    Route::put('/kemaskini/kukb/{id}/{email}', [App\Http\Controllers\StudentController::class, 'kemaskini_permohonan_kukb'])->name('kemaskini.permohonan.kukb');
    Route::get('/surat-tawaran', [App\Http\Controllers\StudentController::class, 'offerletter'])->name('student.offerletter');
});

// campus route
Route::prefix('kampus')->group(function() {
    Route::get('/port-dickson', [App\Http\Controllers\StudentController::class, 'kupd'])->name('student.kupd');
    Route::get('/kota-bharu', [App\Http\Controllers\StudentController::class, 'kukb'])->name('student.kukb');
});

// test route
Route::get('/test-route', function() {
    return 'Route is working';
});

// logout route
Route::get('/logout', function () {
    return redirect('/');
});

// Email testing route
// Route::get('/test-email', function () {
//     $data = [
//         'message' => 'This is a test message sent at ' . now()->format('Y-m-d H:i:s')
//     ];
    
//     try {
//         Mail::to('faizulsoknan@gmail.com')->send(new TestMail($data));
//         return 'Email sent successfully! Check your inbox.';
//     } catch (\Exception $e) {
//         return 'Email sending failed: ' . $e->getMessage();
//     }
// });

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/kampus/port-dickson'))
        ->add(Url::create('/daftar/port-dickson'))
        ->add(Url::create('/semak-permohonan/port-dickson'))
        ->add(Url::create('/kampus/kota-bharu'))
        ->add(Url::create('/daftar/kota-bharu'))
        ->add(Url::create('/semak-permohonan/kota-bharu'))
        ->add(Url::create('/affiliate'))
        ->add(Url::create('/affiliate/register'));

    return $sitemap->toResponse(request());
});

Route::get('/test-slow-query', function () {
    $results = DB::table('students')->get(); // adjust to your table
    return $results;
});

Route::get('/other-slow-query', function () {
    $results = DB::connection('mysql2')->table('student_subjek')->get();
    return $results;
});
