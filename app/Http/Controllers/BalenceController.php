<?php

namespace App\Http\Controllers;

use App\Models\Balence;
use Illuminate\Http\Request;

class BalenceController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Balence $balence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balence $balence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Balence $balence)
    {

        $request->validate([
            'Montly_income' => 'required|integer|min:0',
        ]);

        $balence->where('user_id', auth()->id())->update([
            'Montly_income' => $request->input('Montly_income')
        ]);

        return redirect()->route('dash');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balence $balence)
    {
        //
    }
}
