<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index() {
        $plans = Pricing::all();
        return view('pages.pricing.pricing', compact('plans'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'features' => 'nullable|string',
            'currency' => 'EGP',
        ]);
        $store = Pricing::create($request->all());
        if ($store) {
            sweetalert()->success('Plan created successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
    public function update(Request $request) {
        $price = Pricing::find($request->id);
        if ($price) {
            $update = $price->update($request->all());
            if ($update) {
                sweetalert()->success('Plan updated successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        }
    }
    public function destroy($id) {
        $price = Pricing::find($id);
        if($price){
            $price->items()->delete();
            $price->delete();
            sweetalert()->success('Plan deleted successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
}
