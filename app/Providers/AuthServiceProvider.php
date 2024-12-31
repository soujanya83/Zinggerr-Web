<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Course;

class AuthServiceProvider extends ServiceProvider
{



    public function show($courseId)
    {
        $course = Course::findOrFail($courseId);

        if (Gate::denies('view-course', $course)) {
            abort(403, 'Unauthorized');
        }

        return view('courses.show', compact('course'));
    }

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('role', function ($user) {
            if ($user->type == 'Superadmin') {
                return true;
            }
            return false;
        });

        Gate::define('student-role', function ($user) {
            if ($user->type == 'Student') {
                return true;
            }
            return false;
        });

        Gate::define('staff-role', function ($user) {
            if ($user->type == 'Staff') {
                return true;
            }
            return false;
        });

        Gate::define('teacher-role', function ($user) {
            if ($user->type == 'Teacher') {
                return true;
            }
            return false;
        });

        Gate::define('admin-role', function ($user) {
            if ($user->type == 'Admin') {
                return true;
            }
            return false;
        });
    }
}
