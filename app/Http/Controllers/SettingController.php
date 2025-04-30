<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\ApiKey;
use App\Models\Social;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethods;

class SettingController extends Controller
{
    public function index(){
        $api = ApiKey::all();
        $apiKey = $api->first();
        $platforms = Social::all()->keyBy('platform');
        $paymentMethods = PaymentMethods::all()->keyBy('methods_name');
        $about = About::all();
        $aboutdata = $about->first();
        return view('pages.settings.settings', compact('apiKey', 'platforms', 'paymentMethods', 'aboutdata'));
    }
    public function apiRequest(Request $request){
        $apiKey = ApiKey::find($request->id);
        if($apiKey){
            do {
                $newKey = Str::random(32);
            } while (ApiKey::where('key', $newKey)->exists());

            $update = $apiKey->update(['key' => $newKey]);
            if($update){
                sweetalert()->success('API Key Updated Successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        }
    }
    public function socialUpdate(Request $request) {
        $platforms = ['facebook', 'github', 'linkedin', 'whatsapp'];
        $rules = [];
        foreach ($platforms as $platform) {
            $rules["social_{$platform}"] = 'nullable|url';
            $rules["platform_icon"] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }
        $request->validate($rules);
        foreach ($platforms as $platform) {
            $socialLink = Social::firstOrNew(['platform' => $platform]);
            $socialLink->platform = $platform;
            $urlField = 'social_' . $platform;
            if ($request->filled($urlField)) {
                $socialLink->url = $request->input($urlField);
            }
            $statusField = $platform . '_status';
            $socialLink->status = $request->has($statusField) ? 'active' : 'inactive';
            $imageField = $platform . '_image';
            if ($request->hasFile($imageField)) {
                if ($socialLink->platform_icon) {
                    $oldImageName = basename($socialLink->platform_icon);
                    $oldPath = public_path('assets/images/social-icons/' . $oldImageName);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $imageFile = $request->file($imageField);
                $imageName = $platform . '_' . time() . '.' . $imageFile->extension();
                $destinationPath = 'assets/images/social-icons/';
                $imageFile->move(public_path($destinationPath), $imageName);
                $socialLink->platform_icon = asset($destinationPath . $imageName);
            }
            $update = $socialLink->save();
        }
        if ($update) {
            sweetalert()->success('Social Updated Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
    public function paymentUpdate(Request $request) {
        $methods = ['paypal', 'instapay', 'vfCash', 'fawry'];
        $rules = [];
        foreach ($methods as $method) {
            $rules["payment_{$method}"] = 'nullable|string';
            $rules["methods_icon"] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }
        $request->validate($rules);
        foreach ($methods as $method) {
            $payment = PaymentMethods::firstOrNew(['methods_name' => $method]);
            $payment->methods_name = $method;
            $valueField = 'payment_' . $method;
            if ($request->filled($valueField)) {
                $payment->methods_value = $request->input($valueField);
            }
            $statusField = 'active_' . $method;
            $payment->methods_status = $request->has($statusField) ? 'active' : 'inactive';
            $imageField = $method . '_image';
            if ($request->hasFile($imageField)) {
                if ($payment->methods_icon) {
                    $oldImageName = basename($payment->methods_icon);
                    $oldPath = public_path('assets/images/payment-icons/' . $oldImageName);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $imageFile = $request->file($imageField);
                $imageName = $method . '_' . time() . '.' . $imageFile->extension();
                $destinationPath = 'assets/images/payment-icons/';
                $imageFile->move(public_path($destinationPath), $imageName);
                $payment->methods_icon = asset($destinationPath . $imageName);
            }
            $update = $payment->save();
        }
        if ($update) {
            sweetalert()->success('Payment Updated Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
    public function aboutUpdate(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'position' => 'required|string|max:255',
            'nationality' => 'required|string|max:1000',
            'about_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'about_cv' => 'nullable|mimes:pdf|max:10240',
            'description' => 'nullable|string',
        ]);
        $about = About::first();
        $imageUrl = null;
        $cvUrl = null;
        if ($request->hasFile('about_img')) {
            if ($about && $about->about_img) {
                $oldImageName = basename($about->about_img);
                $oldPath = public_path('assets/images/about-img/' . $oldImageName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $imageFile = $request->file('about_img');
            $imageName = time() . '.' . $imageFile->extension();
            $destinationPath = 'assets/images/about-img/';
            $imageFile->move(public_path($destinationPath), $imageName);
            $imageUrl = asset($destinationPath . $imageName);
        }
        if ($request->hasFile('about_cv')) {
            if ($about && $about->about_cv) {
                $oldImageName = basename($about->about_cv);
                $oldPath = public_path('assets/images/about-cv/' . $oldImageName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $cvFile = $request->file('about_cv');
            $cvName = time() . '.' . $cvFile->extension();
            $destinationPath = 'assets/files/about-cv/';
            $cvFile->move(public_path($destinationPath), $cvName);
            $cvUrl = asset($destinationPath . $cvName);
        }
        if ($about) {
            $about->name = $request->name;
            $about->email = $request->email;
            $about->phone = $request->phone;
            $about->position = $request->position;
            $about->nationality = $request->nationality;
            if ($imageUrl) {
                $about->about_img = $imageUrl;
            }
            if ($cvUrl) {
                $about->about_cv = $cvUrl;
            }
            $about->description = $request->description;
            $save = $about->save();
            if ($save) {
                sweetalert()->success('Updated Successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        } else {
            $store = About::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'nationality' => $request->nationality,
                'about_img' => NULL,
                'about_cv' => NULL,
                'description' => $request->description,
            ]);
            if ($store) {
                sweetalert()->success('Added Successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        }
        sweetalert()->error('Failed to update or create about information', [
            'customClass' => [
                'confirmButton' => 'text-white'
            ]
        ]);
        return redirect()->back();
    }
}
