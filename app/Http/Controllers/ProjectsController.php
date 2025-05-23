<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Projects;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Projects::all();
        $categories = Categories::all();
        return view('pages.projects.index', compact('projects', 'categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url',
            'tags' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'github_url' => 'nullable|url',
            'subcategory' => 'required|string|max:255',
        ]);
        $slug = Str::slug($request->name, '-');
        $category = Categories::where('name', $request->category)->first();
        $imageUrl = null;
        if($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $destinationPath = 'assets/images/projects/';
            $imageFile->move(public_path($destinationPath), $imageName);
            $imageUrl = asset($destinationPath . $imageName);
        }
        $store = Projects::create([
            'name' => $request->name,
            'slug' => $slug,
            'link' => $request->link,
            'tags' => $request->tags,
            'image' => $imageUrl,
            'category' => $request->category,
            'github_url' => $request->github_url,
            'description' => $request->description,
            'categories_id' => $category->id,
        ]);
        if($store){
            sweetalert()->success('Added Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
    public function update(Request $request){
        $projects = Projects::find($request->id);
        if($projects){
            if(isset($request->name)){
                $slug = Str::slug($request->name, '-');
                $projects->slug = $slug;
            }
            $category = Categories::where('name', $request->category)->first();
            if ($request->hasFile('image')) {
                if ($projects->image !== null) {
                    $oldImageName = basename($projects->image);
                    $oldPath = public_path('assets/images/projects/' . $oldImageName);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = 'assets/images/projects/';
                $imageFile->move(public_path($destinationPath), $imageName);
                $imageUrl = asset($destinationPath . $imageName);
                $projects->image = $imageUrl;
            }
            $tags = array_filter(explode(',', $request->input('tags')));
            $update = $projects->update([
                'name' => $request->name,
                'link' => $request->link,
                'tags' => json_encode(array_map(fn($tag) => ['value' => $tag], $tags)),
                'category' => $request->category,
                'github_url' => $request->github_url,
                'subcategory' => $request->subcategory,
                'description' => $request->description,
                'categories_id' => $category->id,
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
    public function delete($id){
        $projects = Projects::find($id);
        if($projects){
            if ($projects->image) {
                $oldImageName = basename($projects->image);
                $oldPath = public_path('assets/images/projects/' . $oldImageName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $projects->galleries()->delete();
            $projects->testmonials()->delete();
            $delete = $projects->delete();
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
}
