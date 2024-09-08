<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{

    public function index(){

        if(Auth::check()){
          return redirect(route('home'));
        }
        if(session()->get('logout') == 1 || !url()->previous() || url()->previous() == route('login')) {
            session(['url_previous' => '/']);
        }else{
            $domain_previous = parse_url(url()->previous(), PHP_URL_HOST);
            $domain = parse_url(config('app.url'), PHP_URL_HOST);
            session(['url_previous' => $domain_previous!=$domain? url('/'): url()->previous()]);
            if (session('logout')){
                session(['url_previous' =>   url('/')]);
            }elseif($domain_previous!=$domain ){
                session(['url_previous' => url('/')]);
            }elseif(!session('logout') && url()->previous())
                session(['url_previous' =>url()->previous()]);
        }
        return view('pages.auth.login');
    }
      

}
