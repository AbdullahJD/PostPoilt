<?php

use App\Http\Controllers\PlatformController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return response()->json(['message' => 'Laravel is running!']);
// });

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// عند زيارة "/" يتم التوجيه حسب حالة المستخدم
Route::get('/', function () {
    return redirect(auth()->check() ? '/dashboard' : route('login'));
});

// ✅ صفحة التسجيل
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// ✅ تنفيذ التسجيل
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    auth()->login($user);
    return redirect('/dashboard');
});

// ✅ تنفيذ تسجيل الدخول
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ]);
});

// ✅ تنفيذ تسجيل الخروج
Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth');

// ✅ الصفحة الرئيسية بعد تسجيل الدخول
Route::get('/dashboard', function () {
    $posts = Post::where('user_id', auth()->id())->latest()->get();
    $postCount = $posts->count();
    $postss = Post::with('platforms')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
    return view('dashboard.index', compact('posts', 'postCount', 'postss'));
})->middleware('auth');

// ✅ صفحة إنشاء منشور جديد
Route::get('/post', function () {
    return view('dashboard.post');
})->middleware('auth');

// ✅ حفظ منشور جديد
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');

// ✅ إعدادات المنصات
Route::get('/settings/platforms', [PlatformController::class, 'edit'])->middleware('auth');
Route::post('/settings/platforms', [PlatformController::class, 'update'])->middleware('auth');