<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyJobApplicationController extends Controller
{
    public function index()
    {
        $applications = Auth::user()->jobApplications()
            ->with([
                'job' => function ($query) {
                    $query->withCount('jobApplications')
                        ->withAvg('jobApplications', 'expected_salary')
                        ->withTrashed()
                        ->with('employer');
                }
            ])
            ->latest()
            ->get();

        return view('my_job_application.index', compact('applications'));
    }

    public function destroy(JobApplication $myJobApplication)
    {
        // Ensure the job application belongs to the authenticated user
        if ($myJobApplication->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $myJobApplication->delete();

        return redirect()->back()->with('success', 'Job application removed.');
    }
}