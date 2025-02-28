<?php

namespace App\Http\Controllers;

use App\Models\Balence;
use App\Models\goal;
use App\Models\History;
use App\Models\profile;
use Illuminate\Http\Request;
use Validator;

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
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048',
            'target_date' => 'required',
            'description' => 'nullable',
        ]);

        if (
            $validator = Validator::make($request->all(), [
                'goal' => 'required',
                'category' => 'required',
                'amount' => 'required',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048',
                'target_date' => 'required',
            ])->fails()
        ) {
            return back()->withInput()->withErrors($validator);
        }

        goal::create([
            'user_id' => auth()->id(),
            'profile_id' => session()->get('profile_id'),
            'goal' => $request->goal,
            'category' => $request->category,
            'amount' => $request->amount,
            'avatar' => $request->file('avatar')->store('images', 'public'),
            'target_date' => $request->target_date,
            'description' => $request->description ?? 'No description provided',
            'current_amount' => 0,
            'status' => 'active',
        ]);

        return back()->with('success', 'Goal created successfully');

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
        $goal->delete();

        return back()->with('success', 'Goal deleted successfully');
    }

    public function bet(Request $request, Goal $goal, Balence $balence, History $history)
    {
        if ($goal->user_id != auth()->id()) {
            return back()->with('error', 'Unauthorized action');
        }
        if ($goal->status == 'completed') {
            return back()->with('error', 'Goal has already been completed');
        }
        if (now()->gt($goal->target_date)) {
            return back()->with('error', 'This goal has expired');
        }
        $amount = intval($goal->amount / 10);

        if ($request->has('custom_amount')) {
            $amount = $request->validate([
                'custom_amount' => 'required|numeric|min:1'
            ])['custom_amount'];
        }
        $balance = $balence->where('user_id', auth()->id())->value('balance');
        if ($amount > $balance) {
            return back()->with('error', 'Insufficient balance. You need $' . $amount . ' but have $' . $balance);
        }
        $newTotal = $goal->current_amount + $amount;
        if ($newTotal > $goal->amount) {
            $amount = $goal->amount - $goal->current_amount;
            $newTotal = $goal->amount;

            if ($amount <= 0) {
                return back()->with('error', 'Cannot contribute more than the goal amount');
            }
        }
        $goal->update([
            'current_amount' => $newTotal,
            'status' => ($newTotal >= $goal->amount) ? 'completed' : 'active',
            'last_contribution_date' => now()
        ]);
        $balence->where('user_id', auth()->id())->decrement('balance', $amount);
        $history->create([
            'user_id' => auth()->id(),
            'profile_id' => session()->get('profile_id'),
            'type' => 'expense',
            'amount' => $amount,
            'category' => 'Goal Contribution',
            'date' => now(),
            'note' => 'Contributed $' . $amount . ' to goal: ' . $goal->goal
        ]);
        if ($newTotal >= $goal->amount) {
            return back()->with('success', 'Congratulations! You have completed your goal: ' . $goal->goal);
        }
        return back()->with('success', 'Successfully contributed $' . $amount . ' to your goal');
    }
}
