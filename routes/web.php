<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\ClearCacheAfterLogout;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('login');
})->name('logout');

Route::get('/login-page', function () {
    return  view('auth.login');
})->name('loginpage');



// ................................................use email verify..........................................
Route::get('/email', function () {
    return view('emails.email_verify');
})->name('user_email');

Route::get('/thank-you', function () {
    return view('auth.thankyou_register');
})->name('thankyou_register');

Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])
    ->name('verification.verify');

Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username')->defaults('field', 'username');
Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');

/////////////////////////////////////use for mail testing only/////////////////////////////////////////
// Route::get('/test-email', function () {
//     Mail::raw('This is a test email sent using Gmail SMTP.', function ($message) {
//         $message->to('chandantafi1996@gmail.com')
//                 ->subject('Test Email from Laravel');
//     });
//     return 'Test email sent successfully!';
// });
////////////////////////////////////////////////////////////////////////////////////////////////////





Route::middleware(['web', ClearCacheAfterLogout::class, 'auth'])->group(function () {
    Route::get('/app', function () {
        return view('app.dashboard');
    })->name('app');

    Route::get('/dashboard', function () {
        return view('app.dashboard');
    })->name('dashboard');

    Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username')->defaults('field', 'username');
    Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
    Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');


    Route::post('courses-create', [CourseController::class, 'createCourse'])->name('courses_create');
    Route::match(['get', 'post'], 'courses', [CourseController::class, 'courselist'])->name('courses');
    Route::get('courses/{id}', [CourseController::class, 'coursedetails'])->name('course_details');
    Route::get('courses-edit/{id}', [CourseController::class, 'courseedit'])->name('course_edit');
    Route::post('courses-update/{id}', [CourseController::class, 'courseupdate'])->name('course_update');
    Route::get('courses-add', [CourseController::class, 'courseadd'])->name('addCourse');
    Route::get('/courses-delete/{id}', [CourseController::class, 'coursedelete'])
        ->name('course_delete')
        ->middleware('can:role');



    Route::get('/user-delete/{user}', [UserController::class, 'user_delete'])
        ->name('user_delete')
        ->middleware('can:role');
    Route::get('/users-edit/{id}', [UserController::class, 'useredit'])->name('user_edit')->middleware('can:role');
    Route::get('/users-update', [UserController::class, 'updateuser'])->name('updateuser');


    Route::get('/change-status', [UserController::class, 'changeStatus'])->name('changeStatus');
     Route::get('/changes-status', [UserController::class, 'changeStatus'])->name('changeStatus');
    Route::post('users-add', [UserController::class, 'createuser'])->name('createuser');



    Route::middleware(['auth'])->group(function () {
        Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
       
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    });

    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::post('add-user', [UserController::class, 'createuser'])->name('createuser');
    Route::get('users-create', [UserController::class, 'useradd'])->name('useradd');
    Route::get('/users-list', [UserController::class, 'userlist'])->name('userlist');
    Route::get('/user_search', [UserController::class, 'search'])->name('user_search');
    Route::POST('users/{userId}/status', [UserController::class, 'changeStatus'])->name('change_user_status');



    Route::delete('/student-delete/{id}', [StudentController::class, 'student_delete'])->name('student_delete')->middleware('can:role');
    Route::get('/student-update', [StudentController::class, 'updatestudent'])->name('updatestudent')->middleware('can:role');
    Route::get('/student-edit/{id}', [StudentController::class, 'studentedit'])->name('student_edit')->middleware('can:role');


    Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
    // Route::post('add-teacher', [TeacherController::class, 'createteacher'])->name('createteacher');
    Route::post('student-add', [StudentController::class, 'store'])->name('store');
    Route::get('student-create', [StudentController::class, 'studentadd'])->name('studentadd');
    Route::get('student-list', [StudentController::class, 'studentlist'])->name('studentlist');
    // Route::put('/teacher/{id}/change-status', [TeacherController::class, 'changeStatus'])->name('change_teacher_status');


    Route::delete('/teacher-delete/{id}', [TeacherController::class, 'teacher_delete'])->name('teacher_delete')->middleware('can:role');
    Route::get('/teacher-update', [TeacherController::class, 'updateteacher'])->name('updateteacher')->middleware('can:role');
    Route::get('/teacher-edit/{id}', [TeacherController::class, 'teacheredit'])->name('teacher_edit')->middleware('can:role');

    // Route::post('add-teacher', [TeacherController::class, 'createteacher'])->name('createteacher');
    Route::get('teachers-create', [TeacherController::class, 'teacheradd'])->name('teacheradd');
    Route::get('teachers-list', [TeacherController::class, 'teacherlist'])->name('teacherlist');
    // Route::put('/teacher/{id}/change-status', [TeacherController::class, 'changeStatus'])->name('change_teacher_status');

    Route::get('account-profile', [ProfileController::class, 'profilepage'])->name('userprofile');
    Route::post('users/profile-update', [ProfileController::class, 'updateProfile'])->name('user.profile.update');


    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('login');
    })->name('logout');
});
