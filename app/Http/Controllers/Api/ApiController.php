<?php

namespace App\Http\Controllers\Api;

use App\Models\Social;
use App\Models\Pricing;
use App\Models\Projects;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\PaymentMethods;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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
    public function sendEmail(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
            'phone' => 'required|string|max:20',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone,
        ];
        Mail::to('max_payne9494@yahoo.com')->send(new ContactMail($data));
        return response()->json(['message' => 'Email sent successfully']);
    }
}
