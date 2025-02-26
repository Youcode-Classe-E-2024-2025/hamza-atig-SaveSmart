<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'spended' => 'numeric|min:0',
        ]);

        profile::create([
            'user_id' => auth()->id(),
            'avatar' => $request->file('avatar')->store('images', 'public'),
            'full_name' => $request->full_name,
            'password' => bcrypt($request->password),
            'spended' => $request->spended ?? 0,
        ]);

        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $profileId = $user->id;
        session()->forget('clicked_profile_id');
        session(['clicked_profile_id' => $profileId]);

        return redirect('dash');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profile $profile)
    {
        //
    }
}
