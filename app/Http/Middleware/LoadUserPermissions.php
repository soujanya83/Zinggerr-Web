<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class LoadUserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // if (Auth::check()) {
        //     $roletype = Auth::user()->type;
        //     $roledata = Role::where('name', $roletype)->first();
        //     $roleId = $roledata->id;

        //     $permissions = DB::table('permission_role')
        //     ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
        //     ->where('permission_role.role_id', $roleId)
        //     ->select('permissions.name')
        //     ->get()
        //     ->pluck('name')
        //     ->toArray();
        //     view()->share('permissions', $permissions); // For views/
        //     app()->singleton('userPermissions', fn() => $permissions); // For code



        // }

        // return $next($request);
    }
}
