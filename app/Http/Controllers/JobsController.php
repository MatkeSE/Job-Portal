<?php

namespace App\Http\Controllers;
use App\Mail\JobNotificationEmail;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class JobsController extends Controller
{
     // This method will show jobs page
     public function index(Request $request) {



        $categories = Category::where('status',1)->get();
        $jobTypes = JobType::where('status',1)->get();

        $jobs = Job::where('status',1)->with('jobType')->orderBy('created_at','DESC')->paginate(9);

        //  // Search using keyword
        // if (!empty($request->keyword)) {
        //     $jobs = $jobs->where(function($query) use ($request) {
        //         $query->orWhere('title','like','%'.$request->keyword.'%');
        //         $query->orWhere('keywords','like','%'.$request->keyword.'%');
        //     });
        // }

        return view('front.jobs',[
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs
        ]);
   }
}
