<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use App\Models\Skills;
use App\Models\Social;
use App\Models\Pricing;
use App\Models\Projects;
use App\Models\PaymentMethods;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function allProjects(){
        $projects = Projects::all();
        return response()->json($projects);
    }
    public function projectDetails($slug){
        $project = Projects::where('slug', $slug)->first();
        if($project){
            return response()->json($project);
        }
    }
    public function PricingPlan(){
        $plans = Pricing::with('items')->get();
        return response()->json($plans);
    }
    public function socialLinks(){
        $socials = Social::all();
        return response()->json($socials);
    }
    public function paymentMethods(){
        $paymentMethods = PaymentMethods::all();
        return response()->json($paymentMethods);
    }
    public function aboutDev(){
        $about = About::all();
        return response()->json($about);
    }
    public function allSkills(){
        $skills = Skills::all();
        return response()->json($skills);
    }
    public function sendEmail(){}
}
