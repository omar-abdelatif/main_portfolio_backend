<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\PricingItems;
use Illuminate\Http\Request;

class PricingItemsController extends Controller
{
    public function index($pricing_plan_id) {
        $plan = Pricing::find($pricing_plan_id)->first();
        if($plan){
            $items = PricingItems::where('pricing_plan_id', $pricing_plan_id)->get();
            return view('pages.pricing.plan_details', compact('items', 'plan'));
        }
    }
    public function store(Request $request, $pricing_plan_id) {
        $validated = $request->validate([
            'name'=> 'required',
        ]);
        if($validated){
            $plan = Pricing::find($pricing_plan_id);
            $planId = $plan->id;
            if($plan){
                if($request->name){
                    $featureName = $request->input('name');
                    foreach($featureName as $name){
                        $store = PricingItems::create([
                            'title' => $name,
                            'pricing_plan_id' => $planId,
                        ]);
                    }
                }
                if($store){
                    sweetalert()->success('Added Successfully', [
                        'customClass' => [
                            'confirmButton' => 'text-white'
                        ]
                    ]);
                    return redirect()->back();
                }
            }
        }
    }
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title'=> 'required',
        ]);
        if($validated){
            $update = PricingItems::find($id)->update([
                'title' => $request->title,
            ]);
            if($update){
                sweetalert()->success('Updated Successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        }
    }
    public function delete($id) {
        $delete = PricingItems::find($id)->delete();
        if($delete){
            sweetalert()->success('Deleted Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
}
