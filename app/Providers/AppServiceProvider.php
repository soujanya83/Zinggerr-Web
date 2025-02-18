<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot()
    // {
    //     // Ensure Auth::check() runs only when an authenticated user exists
    //     view()->composer('*', function ($view) {
    //         if (Auth::check()) {
    //             $roletype = Auth::user()->type;
    //             $roledata = Role::where('name', $roletype)->first();

    //             if ($roledata) {
    //                 $roleId = $roledata->id;

    //                 $permissions = DB::table('permission_role')
    //                     ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
    //                     ->where('permission_role.role_id', $roleId)
    //                     ->pluck('permissions.name')
    //                     ->toArray();

    //                 // Share globally
    //                 view()->share('permissions', $permissions); // For views
    //                 app()->singleton('userPermissions', fn() => $permissions); // For controllers/services
    //             }
    //         } else {
    //             view()->share('permissions', []); // Default to empty for guests
    //         }
    //     });
    // }

    public function boot()
    {

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::user()->id;

                // Fetch permissions assigned directly to the user
                $permissions = DB::table('permission_role')
                    ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                    ->where('permission_role.assigned_user_id', $userId) // Checking by user_id, not role_id
                    ->pluck('permissions.name')
                    ->toArray();

                view()->share('permissions', $permissions);
            }
        });
    }


}
