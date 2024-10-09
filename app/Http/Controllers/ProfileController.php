<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Update profiled
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        if ( auth()->check() ) {
            $user = Auth::user();
            $sections = Section::getSections();
            return view('auth.profile',compact('user','sections'));
        } 
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate erorr messages
        $messages = [
            'employee_id.required' => __('profile.employee_id_required'),
            'extension.required' => __('profile.extension_required'),
            'section.required' => __('profile.section_required'),
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:255',
            'extension' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255',
            'section' => 'required',
        ], $messages);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->extension = $request->input('extension');
        $user->employee_id = $request->input('employee_id');
        $user->section_id = $request->input('section');

        if ( $user->save() ) {
            return redirect()->route('profile')->with('success', __('profile.profile_update_success'));
        } else {
            return redirect()->route('profile')->with('fail', __('profile.profile_update_failed'));
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Update password
    |--------------------------------------------------------------------------
    */

    public function editPassword()
    {
        if ( auth()->check() ) {
            $user = Auth::user();
            $sections = Section::getSections();
            return view('auth.update-password',compact('user','sections'));
        } 
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validate erorr messages
        $messages = [
            'new_password.confirmed' => __('profile.error_passwords_mismatch')
        ];

        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ], $messages);

        if ( !Hash::check( $request->input('current_password'), $user->password ) ) {
            return back()->with('fail', __('profile.error_current_password'));
        }

        $user->password = Hash::make($request->input('new_password'));
        
        if ( $user->save() ) {
            return redirect()->route('password')->with('success', __('profile.password_update_success'));
        } else {
            return redirect()->route('password')->with('fail', __('profile.password_update_failed'));
        }

    }
}
