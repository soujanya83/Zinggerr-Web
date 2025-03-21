<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MontessoriController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoQuizController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\ClearCacheAfterLogout;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register-page', function () {

    return view('auth.register');
});



Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('login');
})->name('logout');

Route::get('/login-page', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return  view('auth.login');
})->name('loginpage');


// ................................................use email verify..........................................
Route::get('/email', function () {
    return view('emails.email_verify');
})->name('user_email');

Route::get('/thank-you', function () {
    return view('auth.thankyou_register');
})->name('thankyou_register');



Route::get('/email/verify', function () {
    return view('auth.thankyou_register');
})->middleware('auth')->name('verification.notice');

// Verify the email
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])
    ->name('verification.verify');




// Resend email verification
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('verification-resend/{id}', [RegisterController::class, 'resend_email_verification'])->name('verification.resend');


Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username')->defaults('field', 'username');
Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');

Route::post('/reset/password', [ProfileController::class, 'sendOtp'])->name('reset.password');
Route::post('/otp-submit', [ProfileController::class, 'submitOtp'])->name('opt.submit');
Route::post('/set-new-password', [ProfileController::class, 'set_new_password'])->name('set.new.password');

Route::get('/resend-otp', [ProfileController::class, 'resendOtp'])->name('resend.otp');
Route::get('/forgot-password/send-otp', [ProfileController::class, 'sendForgotPasswordOtp'])->name('forgot.password.sendOtp');  /// this use for after login
Route::post('/check-username-suggestions/register', [RegisterController::class, 'checkUsernameSuggestionsregister'])->name('check.username.suggestion');

Route::get('/course-link/{slug}/', [StudentController::class, 'generateShareLink'])
->name('share.course_link');

Route::get('/share-user/register-page', [StudentController::class, 'share_user_register_page'])
->name('user.share_link');

Route::get('/otp-verify', function () {
    return view('auth.passwords.otp_verify');
})->name('otp.verify');

Route::get('/reset-password', function () {
    return view('auth.passwords.reset_password');
})->name('password.reset.form');



Route::middleware(['web', 'auth', ClearCacheAfterLogout::class])->group(function () {
    Route::get('/app', function () {
        return view('app.dashboard');
    })->name('app');

    Route::get('/otp-verify-page', function () {
        return view('profiles.otp_verify_page');
    })->name('profile.otp.verify');

    Route::post('user/reset/password', [ProfileController::class, 'profileOtpsubmit'])->name('profile.otp.submit');
    Route::post('user/update/password', [ProfileController::class, 'update_set_new_password'])->name('user.password.update');
    Route::get('user/resend-otp', [ProfileController::class, 'profile_resendOtp'])->name('user.resend.otp');

    Route::get('user/reset-password', function () {
        return view('profiles.reset_password_form');
    })->name('profiles.reset_password_form');

    // Route::get('/dashboard', function () {
    //     return view('app.dashboard');
    // })->name('dashboard')->middleware('can:role');

    Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username')->defaults('field', 'username');
    Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
    Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
    Route::post('/check-username-suggestions', [RegisterController::class, 'checkUsernameSuggestions'])->name('check.username.suggestions');


    Route::get('courses/change-status', [CourseController::class, 'couserchangeStatus'])->name('coursechangeStatus');
    Route::get('/api/users', [CourseController::class, 'getUsers']);
    Route::get('/api/teachers', [CourseController::class, 'getTeachers']);
    Route::post('/courses/assign', [CourseController::class, 'couserassign'])->name('course.assign');
    Route::post('courses-create', [CourseController::class, 'createCourse'])->name('courses.create');
    Route::match(['get', 'post'], 'courses', [CourseController::class, 'courselist'])->name('courses');
    Route::get('course/{id}', [CourseController::class, 'coursedetails'])->name('course_details');
    Route::get('course/{slug}/edit', [CourseController::class, 'courseedit'])->name('course_edit');
    Route::get('course/{slug}/format', [CourseController::class, 'courseedit'])->name('after_course_create');
    Route::post('course-update/{id}', [CourseController::class, 'courseupdate'])->name('course_update');
    Route::match(['get', 'post'], 'create/course', [CourseController::class, 'courseadd'])->name('addCourse');

    Route::get('/courses-delete/{id}', [CourseController::class, 'coursedelete'])
        ->name('course_delete')
        ->middleware('can:role');
    Route::post('courses/chapter-status', [CourseController::class, 'chapterStatus'])->name('chapterStatus');
    Route::post('courses/assets-status', [CourseController::class, 'assetsStatus'])->name('assetsStatus');
    Route::post('courses/chapter-update', [CourseController::class, 'chapterupdate'])->name('chapter.update');

    Route::get('api-asset/{id}/delete', [CourseController::class, 'api_asset_delete'])->name('api.assetsdelete');



    Route::get('/chapter-delete/{id}', [CourseController::class, 'chapterdelete'])->name('chapter_delete');
    Route::get('/assets-delete/{id}', [CourseController::class, 'assetsdelete'])->name('assets_delete');
    Route::post('/assets-edit', [CourseController::class, 'assetsedit'])->name('edit_assets');

    Route::post('course/pause-users', [CourseController::class, 'courses_pause_users'])->name('course.pause_users');
    Route::post('course/permissions/update', [CourseController::class, 'updatePermissions'])->name('course.update_permissions');
    Route::get('/user/{userId}/permissions', [CourseController::class, 'getUserPermissions']);
    Route::post('/courses/assigned-remove-with-remark', [CourseController::class, 'assigned_delete_with_remark'])->name('assigned_delete_with_remark');


    Route::post('/category/update', [CourseController::class, 'update_category'])->name('update.category');

    Route::post('category/submit', [CourseController::class, 'submit_category'])->name('category.store');
    Route::get('/category-delete/{user}', [CourseController::class, 'category_delete'])->name('category_delete');

    Route::get('cousers/{slug}/create-chapter', [CourseController::class, 'add_assets'])->name('add_assets');
    Route::get('cousers/{slug}/create-section', [CourseController::class, 'create_section'])->name('create_section');
    Route::post('cousers/section-submit', [CourseController::class, 'section_submit'])->name('section.submit');
    Route::get('cousers/section/{slug}/list', [CourseController::class, 'section_list'])->name('section.list');
    // Route::post('cousers/section/update', [CourseController::class, 'update_section'])->name('section.update');

    Route::get('cousers/section/delete/{id}', [CourseController::class, 'delete_section'])->name('section.delete');
    Route::get('cousers/{slug}/manage-activity', [CourseController::class, 'manage_activity'])->name('manage_activity');


    Route::post('/upload-video-chunk', [CourseController::class, 'uploadVideoChunk'])->name('upload.video.chunk');

    Route::post('/sections/update/{id}', [CourseController::class, 'sections_update'])->name('section.update');
    Route::post('/sections/video/update', [CourseController::class, 'updatesectionvideo']);


    Route::post('/save-checkpoint', [CourseController::class, 'interactive_setup'])->name('save.checkpoint');
    Route::post('add/fillintheblanks', [CourseController::class, 'storefillintheblanks'])->name('add.fillintheblanks');
    Route::post('get/video/quizzes', [CourseController::class, 'getvideoQuizzes'])->name('get.video.quizzes');
    Route::post('get/video/fillblanks', [CourseController::class, 'getvideofillintheblanks'])->name('get.video.fillblanks');
    Route::post('/update-quiz/{id}', [CourseController::class, 'updateQuiz'])->name('update.quiz');
    Route::delete('/delete-quiz/{id}', [CourseController::class, 'deleteQuiz'])->name('delete.quiz');
    Route::delete('/delete-interactive/{id}', [CourseController::class, 'deleteInteractive']);

    Route::post('/update/fillintheblanks', [CourseController::class, 'updatefillintheblanks'])->name('update.fillintheblanks');
    Route::post('/delete/fillintheblanks', [CourseController::class, 'deletefillintheblanks'])->name('delete.fillintheblanks');


    // Route::get('/getInteractiveAsset/{videoId}', [CourseController::class, 'getInteractiveAsset']);
    Route::get('/get-checkpoints', [CourseController::class, 'getCheckpoints'])->name('get.checkpoints');
    Route::get('/interactive/play', [CourseController::class, 'play'])->name('interactive.play');

    // Route::get('/interactive/{assetId}', [CourseController::class, 'getInteractiveAsset']);
    Route::get('/api/interactive/{assetId}', [CourseController::class, 'getInteractiveAsset']);


    Route::post('cousers/chapter-submit', [CourseController::class, 'chepter_submit'])->name('chepter.submit');
    Route::get('cousers/chapter-assets', [CourseController::class, 'blog_assets'])->name('blogs.assets.form');
    Route::post('cousers/blog-assets', [CourseController::class, 'blog_assets_submit'])->name('blog.assets.submit');


    Route::post('assets/upload', [CourseController::class, 'submitAssets'])->name('assets.submit');
    Route::post('assets/update', [CourseController::class, 'updateAssets'])->name('assets.update');
    Route::get('courses/category/create', [CourseController::class, 'courses_category'])->name('course.category');
    // Route::post('/upload-chunk', [CourseController::class, 'uploadChunk']);
    Route::get('assigned/user-delete/{user}', [CourseController::class, 'assigned_delete'])
        ->name('assigned_delete');

    Route::post('upload/quizess', [CourseController::class, 'uploadQuizes'])->name('upload.quizess');

    Route::post('interactive/setup', [CourseController::class, 'setupinteractive'])->name('interactive.setup');
    Route::post('get/video/interactives', [CourseController::class, 'getvideointeractives'])->name('get.video.interactives');
    Route::post('get/asset/details', [CourseController::class, 'getassetdetails'])->name('get.asset.details');

    Route::get('montessori/areas-list', [MontessoriController::class, 'montessori_areas_list'])->name('montessori.areas_list');
    Route::get('montessori/age-group-list', [MontessoriController::class, 'montessori_agegroup_list'])->name('montessori.age_groups');

    Route::get('montessori/areas-create', [MontessoriController::class, 'montessori_areas_create'])->name('montessori.areas_create');
    Route::get('montessori/age-group-create', [MontessoriController::class, 'montessori_agegroup_create'])->name('montessori.age_groups_create');

    Route::post('montessori/areas-store', [MontessoriController::class, 'montessori_areas_stores'])->name('montessori.areas_store');
    Route::post('montessori/agegroup-store', [MontessoriController::class, 'montessori_agegroup_stores'])->name('montessori.agegroup_store');

    Route::get('montessori/age-group/{slug}/edit', [MontessoriController::class, 'montessori_agegroup_edit'])->name('montessori.agegroup_edit');
    Route::get('montessori/area/{slug}/edit', [MontessoriController::class, 'montessori_areas_edit'])->name('montessori.areas_edit');

    Route::post('montessori/areas-update', [MontessoriController::class, 'montessori_areas_update'])->name('montessori.areas_update');
    Route::post('montessori/agegroup-update', [MontessoriController::class, 'montessori_agegroup_update'])->name('montessori.agegroup_update');

    Route::get('montessori/areas-delete/{id}', [MontessoriController::class, 'montessori_areas_delete'])->name('montessori.areas_delete');
    Route::get('montessori/age-group-delete/{id}', [MontessoriController::class, 'montessori_agegroup_delete'])->name('montessori.agegroup_delete');

    Route::get('/search-users', [UserController::class, 'searchUsers'])->name('search.users');




    Route::get('/courses/{ageGroup}/{area}', [MontessoriController::class, 'show'])->name('montessori.course.show');
    Route::post('user/share-course', [StudentController::class, 'shareCourse'])->name('share.course');




    Route::get('/user-delete/{user}', [UserController::class, 'user_delete'])
        ->name('user_delete')
        ->middleware('can:role');
    Route::get('/users-edit/{slug}', [UserController::class, 'useredit'])->name('user_edit')->middleware('can:role');
    Route::post('/users-update', [UserController::class, 'updateuser'])->name('updateuser')->middleware('can:role');
    Route::get('/change-status', [UserController::class, 'changeStatus'])->name('changeStatus');
    // Route::get('/changes-status', [UserController::class, 'changeStatus'])->name('changeStatus');

    Route::get('/admin/dashboard', [UserController::class, 'admindashboard'])->name('admin.dashboard');


    Route::post('add-user', [UserController::class, 'createuser'])->name('createuser');
    Route::get('users-create', [UserController::class, 'useradd'])->name('useradd');
    Route::get('/users-list', [UserController::class, 'userlist'])->name('userlist');
    Route::get('/user_search', [UserController::class, 'search'])->name('user_search');
    Route::POST('users/{userId}/status', [UserController::class, 'changeStatus'])->name('change_user_status');
    Route::get('user/dashboard', [UserController::class, 'dashboard'])->name('dashboard_user');

    Route::get('dashboard', [UserController::class, 'dashboardmain'])->name('dashboard');



    // Route::delete('/student-delete/{id}', [StudentController::class, 'student_delete'])->name('student_delete')->middleware('can:role');
    Route::post('/students-update', [StudentController::class, 'updatestudent'])->name('updatestudent');
    Route::get('/student-edit/{slug}', [StudentController::class, 'studentedit'])->name('student_edit');

    Route::get('/students/dashboard', [StudentController::class, 'studentdashboard'])->name('student.dashboard')->middleware('can:student-role');
    // Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
    // Route::post('add-teacher', [TeacherController::class, 'createteacher'])->name('createteacher');
    // Route::post('student-add', [StudentController::class, 'store'])->name('store');
    Route::get('students-create', [StudentController::class, 'studentadd'])->name('studentadd');
    Route::get('students', [StudentController::class, 'studentlist'])->name('studentlist');

    // Route::put('/teacher/{id}/change-status', [TeacherController::class, 'changeStatus'])->name('change_teacher_status');
    Route::get('courses/{slug}', [StudentController::class, 'courses_views'])->name('courses.viwes');


    // Route::delete('/teacher-delete/{id}', [TeacherController::class, 'teacher_delete'])->name('teacher_delete')->middleware('can:role');
    Route::post('/teacher-update', [TeacherController::class, 'updateteacher'])->name('updateteacher');
    Route::get('/faculty-edit/{slug}', [TeacherController::class, 'teacheredit'])->name('teacher_edit');
    Route::get('/faculty/dashboard', [TeacherController::class, 'teacherdashboard'])->name('teacher.dashboard');

    // Route::post('add-teacher', [TeacherController::class, 'createteacher'])->name('createteacher');
    Route::get('faculty-create', [TeacherController::class, 'teacheradd'])->name('teacheradd');
    Route::get('faculty-list', [TeacherController::class, 'teacherlist'])->name('teacherlist');
    // Route::put('/teacher/{id}/change-status', [TeacherController::class, 'changeStatus'])->name('change_teacher_status');


    Route::get('user/account-profile', [ProfileController::class, 'profilepage'])->name('userprofile');
    Route::get('user/social-profile', [ProfileController::class, 'socialprofilepage'])->name('user.socialprofile');
    Route::post('users/profile-update', [ProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('users/change-password', [ProfileController::class, 'changePassword'])->name('user.changepassword');




    Route::get('permission/{slug}/assign', [PermissionsController::class, 'user_assign_permission'])->name('user.assign_permission');

    Route::get('permissions/create', [PermissionsController::class, 'create_permission'])->name('permissions.create');
    Route::get('permissions/list', [PermissionsController::class, 'list_permission'])->name('permissions.list');
    Route::post('permission/submit', [PermissionsController::class, 'submit_permission'])->name('submit.permission');
    Route::post('/permissions/update', [PermissionsController::class, 'update_permission'])->name('update.permission');
    Route::get('permission/{id}/edit', [PermissionsController::class, 'permission_edit'])->name('permission.edit');


    Route::get('permission/{id}/delete', [PermissionsController::class, 'destroy'])->name('permission.delete');

    Route::get('permissions/assign', [PermissionsController::class, 'role_permission'])->name('permissions.role');
    Route::get('permissions/assigned-list', [PermissionsController::class, 'permissions_assigned_list'])->name('permissions.assignedlist');
    Route::post('permissions/role-assign', [PermissionsController::class, 'assignpermissions'])->name('role.permission.assign');

    Route::post('roles/submit', [PermissionsController::class, 'submit_roles'])->name('roles.store');
    Route::post('roles/submit-new', [PermissionsController::class, 'new_submit_roles'])->name('roles.newstore');
    Route::post('roles/update', [PermissionsController::class, 'update_role'])->name('roles.update');
    Route::post('/assign-permissions', [PermissionsController::class, 'user_assign_permissions'])->name('assign.permissions');

    Route::get('roles/create', [PermissionsController::class, 'createroles'])->name('roles.create');
    Route::get('roles/list', [PermissionsController::class, 'listroles'])->name('roles.list');
    Route::get('roles/{id}/edit', [PermissionsController::class, 'editroles'])->name('roles.edit');
    Route::get('/role-delete/{user}', [PermissionsController::class, 'role_delete'])
        ->name('role_delete')
        ->middleware('can:role');
    Route::get('/permissions/assigned-delete/{user}', [PermissionsController::class, 'permissions_assigned_delete'])->name('permission_assigned_delete');

    Route::get('/video/{id}', [VideoQuizController::class, 'showVideo'])->name('video.show');


    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('login');
    })->name('logout');
});
