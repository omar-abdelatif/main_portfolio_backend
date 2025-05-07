<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Testmonials;
use Illuminate\Http\Request;

class TestmonialsController extends Controller
{
    public function index($slug) {
        $project = Projects::where('slug', $slug)->with('testmonials')->first();
        return view('pages.testmonials.index', compact('project'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required|string',
        ]);
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $destinationPath = 'assets/images/projects/testmonials/';
            $imageFile->move(public_path($destinationPath), $imageName);
            $imageUrl = asset($destinationPath . $imageName);
        }
        $project = Projects::where('slug', $request->slug)->first();
        if ($project) {
            $store = Testmonials::create([
                'name' => $request->name,
                'position' => $request->position,
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
    public function update(Request $request)
    {
        $testmonial = Testmonials::find($request->id);
        if ($testmonial) {
            if ($request->hasFile('image')) {
                if ($testmonial->image) {
                    $oldImageName = basename($testmonial->image);
                    $oldPath = public_path('assets/images/projects/testmonials/' . $oldImageName);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = 'assets/images/projects/testmonials/';
                $imageFile->move(public_path($destinationPath), $imageName);
                $imageUrl = asset($destinationPath . $imageName);
                $testmonial->image = $imageUrl;
            }
            $testmonial->name = $request->name;
            $testmonial->position = $request->position;
            $testmonial->content = $request->content;
            $save = $testmonial->save();
            if ($save) {
                sweetalert()->success('Updated Successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        }
    }
    public function destroy($id)
    {
        $testmonial = Testmonials::find($id);
        if ($testmonial) {
            if ($testmonial->image) {
                $oldImageName = basename($testmonial->image);
                $oldPath = public_path('assets/images/projects/testmonials/' . $oldImageName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $testmonial->delete();
            sweetalert()->success('Deleted Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
}
