<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\PaymentMethods;
use App\Models\Social;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $api = ApiKey::all();
        $apiKey = $api->first();
        $platforms = Social::all()->keyBy('platform');
        $paymentMethods = PaymentMethods::all()->keyBy('methods_name');
        return view('pages.settings.settings', compact('apiKey', 'platforms', 'paymentMethods'));
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
                    $oldImagePath = str_replace('/storage/', '', $socialLink->platform_icon);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
                $imageFile = $request->file($imageField);
                $imageName = $platform . '_' . time() . '.' . $imageFile->extension();
                $imagePath = $imageFile->storeAs('social-icons', $imageName, 'public');
                $socialLink->platform_icon = Storage::url($imagePath);
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
                    $oldImagePath = str_replace('/storage/', '', $payment->methods_icon);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
                $imageFile = $request->file($imageField);
                $imageName = $method . '_' . time() . '.' . $imageFile->extension();
                $imagePath = $imageFile->storeAs('payment-icons', $imageName, 'public');
                $payment->methods_icon = Storage::url($imagePath);
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
            'phone' => 'required|numeric|unique:about,phone',
            'position' => 'required|string|max:255',
            'nationality' => 'required|string|max:1000',
            'about_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    }
}
