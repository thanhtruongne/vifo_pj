<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use App\Models\Profile;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request)
    // {
    //    $user = Auth::user();

    // }

    public function handle(Request $request, Closure $next){
        $user = Auth::user();

        if(!Auth::check()) {
            if($request->ajax()){
                return response()->json(["message", trans('message.authencation_required')],401);
            }
            // save link hiện tại truy cập
            session()->put('target_url',$request->fullUrl());
            return redirect(route('login'));
        }
        //check login theo method
        if(session()->has('login_from_method')){
            session()->forget('login_from_login_method');
            if($user->re_login){
                $user->re_login = 0;
                $user->save();
            }
        }
        else {
            session()->forget('login_from_login_method');
            if($user->re_login){
                $user->re_login = 0;
                Auth::guard()->logout();
                session()->flush();
                return redirect(route('backend.login'));
            }
        }
        if (Auth::check()){
            $userId = \auth()->id();
            if (!session()->get('profile')) {
                $profile = Profile::whereUserId($userId)->first();
                $group_permission = Auth::user()->roles()->first()->code;
                session(['group_permission' => $group_permission]);
                session(['profile' => $profile]);
                session(['login' => 1]);
                session()->save();
            }

            $session_role = \session()->get('user_role');
            $currentRole = $session_role;
            $unit = null;
            if (!$session_role ) {
                $role = null;
                $roles = User::getRoles();
                // check vai trò có quyền vào url
                $check= false;
                if($request->segment(2)=='admin') {
                    $role = 'manager';
                }
                if (count($roles) >= 1 && $role) {
                    \session()->put(['user_role'=> $role]);
                    \session()->save();
                }
            }
            // else{
            //     if($request->segment(2)=='provider' && Permissions::isProvider())
            //     {
            //         $switchRole = 'provider';
            //         \session()->put('user_role', 'unit_manager');
            //         \session()->save();
            //     }
            //     elseif($request->segment(2)=='saleman' && Permissions::isSaleMan()){
            //         $switchRole = 'saleman';
            //         \session()->put('user_role', 'teacher');
            //         \session()->save();
            //     }
            //     elseif($request->segment(2)=='distributor' && Auth::user()->existsRole())
            //     {
            //         $switchRole = 'distributor';
            //         \session()->put('user_role', 'manager');
            //         \session()->save();
            //     }
            // }
            if(!cache('avatar_'.profile()->user_id)){
                $avatar = Profile::whereUserId(\profile()->user_id)->value('avatar');
                Cache::forever('avatar_'. \profile()->user_id, $avatar ?? '');
            }
            return next($request);
        }

    }
}
