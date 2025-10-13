<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; 
class StudentSettingsController extends Controller
{
    public function index() {

        $user = Auth::user();
        return view('pages.settings', compact('user'));

    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'first_name'     => 'string|max:255',
            'last_name'      => 'string|max:255',
            'email'          => 'email|unique:users,email,' . $user->id,
            'age'            => 'integer|min:1',
            'profile_image'  => 'nullable|image|max:10000',
            'password'       => 'nullable|string|min:8|confirmed',
        ]);
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $validatedData['profile_image'] = $request->file('profile_image')->store('uploads/images', 'public');
        }
    
        // Handle password (only if provided)
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
        $user->update($validatedData);
    
        return redirect()->route('settings.student')->with('success', 'Account updated successfully.');
    }

    
}
