<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'required|url',
            'tags' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
        ]);
        $slug = Str::slug($request->name, '-');
        $category = Categories::where('name', $request->category)->first();
        if($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->extension();
            $imagePath = $imageFile->storeAs('images', $imageName, 'public');
            $imageUrl = Storage::url($imagePath);
        }
        $store = Projects::create([
            'name' => $request->name,
            'slug' => $slug,
            'link' => $request->link,
            'tags' => $request->tags,
            'image' => $imageUrl,
            'category' => $request->category,
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
                if ($projects->image && Storage::disk('public')->exists(str_replace('/storage/', '', $projects->image))) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $projects->image));
                }
                $imageFile = $request->file('image');
                $imageName = time() . '.' . $imageFile->extension();
                $imagePath = $imageFile->storeAs('images', $imageName, 'public');
                $imageUrl = Storage::url($imagePath);
                $projects->image = $imageUrl;
            }
            $tags = array_filter(explode(',', $request->input('tags')));
            $update = $projects->update([
                'name' => $request->name,
                'link' => $request->link,
                'tags' => json_encode(array_map(fn($tag) => ['value' => $tag], $tags)),
                'category' => $request->category,
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
                $imagePath = str_replace('/storage/', '', $projects->image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
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
