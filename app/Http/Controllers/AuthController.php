<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function loginForm()
    {
        if (! auth()->check()) {
            return view('auth.login');
        } else {
            return redirect()->intended(route('dashboard'));
        }
    }

    public function executeLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            
            $user = Auth::user();

            // Check if the user account is active
            if ( !$user->is_active ) {
                Auth::logout();
                return back()->with('fail', __('auth.account_not_active'));
            }

            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));

        } else {
            return back()->with('fail', __('auth.failed'));
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Log the user out of the application
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
    
    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    */

    public function registration()
    {
        if (! auth()->check()) {
            return view('auth.registration');
        } else {
            return view('index');
        }
    }

    public function registerUser(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email:users|unique:users',
            'password'=>'required|min:8|max:12'
        ]);

        //$user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if( $user->save() ){
            return redirect(route('login'))->with('success', __('auth.register_success'));
        } else {
            return back()->with('fail', __('auth.register_fail'));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        if ( auth()->check() ) {
            $user = Auth::user();
            $tickets = Ticket::getLastUserTickets(6);
            return view('auth.dashboard',compact('user', 'tickets'));
        } else {
            return view('auth.login');
        }
    }

}
