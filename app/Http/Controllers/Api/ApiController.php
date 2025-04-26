<?php

namespace App\Http\Controllers\Api;

use App\Models\Social;
use App\Models\Pricing;
use App\Models\Projects;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
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
        $plan = Pricing::all();
        return response()->json($plan);
    }
    public function socialLinks(){
        $socials = Social::all();
        return response()->json($socials);
    }
    public function paymentMethods(){
        $paymentMethods = PaymentMethods::all();
        return response()->json($paymentMethods);
    }
}
