<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::latest()->paginate(40);
        return view('reports.index', ['reports'=>$reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            // 'category' => 'required|string|max:30|in_array:App\Models\Report::$categories',
            'category' => 'required|string|max:30',
            'report_message' => 'required|string|max:1000',
            'reportable_type' => 'required|string',
            // 'reportable_type' => 'required|string|in:[Post, Comment]',
            // 'reportable_id' => 'required|numeric|exists:App\Models\\'
            // . $request['reportable_type'] . ',id'
            'reportable_id' => 'required|numeric'
        ]);
        $report = new Report();
        $report->user_id = $request->user()->id;
        $report->category = $validatedData['category'];
        $report->message = $validatedData['report_message'];
        $report->reportable_id = $validatedData['reportable_id'];
        $report->reportable_type = 'App\Models\\' . $validatedData['reportable_type'];
        $report->save();
        return redirect()->back()
            ->with('flash_msg', 'Your report of this ' . $validatedData['reportable_type']
                . ' was submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('reports.show', ['report'=>$report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
