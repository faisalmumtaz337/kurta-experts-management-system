<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validated data
        $validatedData = $request->validate([
            'name' => 'required',
            'caste' => 'required',
            'contact' => 'required|max:11',
            'password' => 'required|min:8',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // Profile Image Upload
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');

            // extension
            $extension = $file->getClientOriginalExtension();

            // unique file name (UUID)
            $imageName = Str::uuid() . '.' . $extension;

            // store file
            $path = $file->storeAs('profile-images', $imageName, 'public');

            $validatedData['profile_image'] = $path;
        } else {
            // Default image
            $validatedData['profile_image'] = 'profile_images/avatar.png';
        }

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create user 
        User::create($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'The user is created successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Delete user
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'The user is deleted successfully.');
    }
}
