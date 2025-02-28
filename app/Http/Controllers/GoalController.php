<?php

namespace App\Http\Controllers;

use App\Models\goal;
use App\Models\profile;
use Illuminate\Http\Request;

class GoalController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, profile $profile)
    {
        $request->validate([
            'goal' => 'required',
            'category' => 'required',
            'amount' => 'required',
            'avatar' => 'required',
            'target_date' => 'required',
            'description' => 'nullable',
        ]);


        goal::create([
            'user_id' => auth()->id(),
            'profile_id' => session()->get('profile_id'),
            'goal' => $request->goal,
            'category' => $request->category,
            'amount' => $request->amount,
            'avatar' => $request->avatar,
            'target_date' => $request->target_date,
            'description' => $request->description
        ]);

        return redirect()->route('goals');
    }

    /**
     * Display the specified resource.
     */
    public function show(goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, goal $goal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(goal $goal)
    {
        //
    }
}
