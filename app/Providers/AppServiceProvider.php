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



    // public function boot()
    // {

    //     view()->composer('*', function ($view) {
    //         if (Auth::check()) {
    //             $userId = Auth::user()->id;

    //             // Fetch permissions assigned directly to the user
    //             $permissions = DB::table('permission_role')
    //                 ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
    //                 ->where('permission_role.assigned_user_id', $userId) // Checking by user_id, not role_id
    //                 ->pluck('permissions.name')
    //                 ->toArray();

    //                 $UserRole=Auth::user()->type=='Superadmin';

    //             view()->share('permissions', $permissions,);
    //         }
    //     });
    // }

    public function boot()
    {
        View::composer('*', function ($view) {  // Or specify views if needed
            if (Auth::check()) {
                $userId = Auth::user()->id;

                $permissions = DB::table('permission_role')
                    ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                    ->where('permission_role.assigned_user_id', $userId)
                    ->pluck('permissions.name')
                    ->toArray();

                $view->with('permissions', $permissions); // Use $view->with()
            } else {
                $view->with('permissions', []); // Share an empty array if not logged in
            }
        });
    }



}
