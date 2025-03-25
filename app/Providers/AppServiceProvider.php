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



    public function boot()
    {
        // Ensure Auth::check() runs only when an authenticated user exists
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $roletype = Auth::user()->type;
                $roledata = Role::where('name', $roletype)->first();

                if ($roledata) {
                    $roleId = $roledata->id;
                    if($roletype =='Admin' || $roletype =='Superadmin'){
                    $permissions = DB::table('permission_role')
                        ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                        ->where('permission_role.role_id', $roleId)
                        ->pluck('permissions.name')
                        ->toArray();
                    }else{
                        $permissions = DB::table('user_permissions')
                        ->join('permissions', 'permissions.id', '=', 'user_permissions.permission_id')
                        ->where('user_permissions.user_id', Auth::user()->id)
                        ->pluck('permissions.name')
                        ->toArray();
                    }
                    // Share globally
                    view()->share('permissions', $permissions); // For views
                    app()->singleton('userPermissions', fn() => $permissions); // For controllers/services
                }
            } else {
                view()->share('permissions', []); // Default to empty for guests
            }
        });
    }

    // public function boot()
    // {
    //     View::composer('*', function ($view) {  // Or specify views if needed
    //         if (Auth::check()) {
    //             $userId = Auth::user()->id;

    //             $permissions = DB::table('permission_role')
    //                 ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
    //                 ->where('permission_role.assigned_user_id', $userId)
    //                 ->pluck('permissions.name')
    //                 ->toArray();

    //             $view->with('permissions', $permissions); // Use $view->with()
    //         } else {
    //             $view->with('permissions', []); // Share an empty array if not logged in
    //         }
    //     });
    // }



}
