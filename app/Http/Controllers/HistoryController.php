<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use App\Models\Balence;
use App\Models\History;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Maatwebsite\Excel\Facades\Excel;


class HistoryController extends Controller
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
    public function store(Request $request, Balence $balence)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'note' => 'nullable',
            'category' => 'nullable',
            'date' => 'required|date',
        ]);

        History::create([
            'user_id' => auth()->id(),
            'profile_id' => session()->get('profile_id'),
            'type' => $request->type,
            'amount' => $request->amount,
            'note' => $request->note,
            'category' => $request->category ?? 'Not Exist',
            'date' => $request->date
        ]);

        if ($request->type == 'expense') {
            $balence->decrement('balance', $request->amount);
        }

        if ($request->type == 'income') {
            $balence->increment('balance', $request->amount);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }

    public function pdf(History $history){
        $data = [
            'title' => 'History Pdf',
            'history' => $history->where('user_id', auth()->id())->count(),
            'histories' => $history->where('user_id', auth()->id())->get(),
            'profile_id' => session()->get('profile_id'),
            'profile_email' => session()->get('full_name')
        ];

        $pdf = Pdf::loadView('pdf_template', $data);
        return $pdf->download('document.pdf');
    }

    public function excel(History $history){
        return Excel::download(new HistoryExport, 'history.xlsx');
    }
}
