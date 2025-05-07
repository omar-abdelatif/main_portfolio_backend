<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Testmonials;
use Illuminate\Http\Request;

class TestmonialsController extends Controller
{
    public function index($slug) {
        $project = Projects::where('slug', $slug)->first();
        return view('pages.testmonials.index', compact('project'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required|string',
        ]);
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $destinationPath = 'assets/images/testmonials/';
            $imageFile->move(public_path($destinationPath), $imageName);
            $imageUrl = asset($destinationPath . $imageName);
        }
        $project = Projects::where('slug', $request->slug)->first();
        if ($project) {
            $store = Testmonials::create([
                'name' => $request->name,
                'image' => $imageUrl,
                'content' => $request->content,
                'projects_id' => $project->id,
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
    }
}
