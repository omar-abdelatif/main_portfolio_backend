<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use App\Models\ProjectGallery;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectGalleryController extends Controller {
    public function index($slug){
        $project = Projects::where('slug', $slug)->with('galleries')->first();
        return view('pages.projects.gallery.index', compact('project'));
    }
    public function store(Request $request) {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $project = Projects::where('slug', $request->slug)->first();
        if ($request->hasFile('images')) {
            $gallery = $request->file('images');
            if(is_array($gallery)){
                $destinationPath = 'assets/images/projects/'.$project->slug.'/gallery/';
                foreach ($request->file('images') as $imageFile) {
                    $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->move(public_path($destinationPath), $imageName);
                    $imageUrl = asset($destinationPath . $imageName);
                    $store = ProjectGallery::create([
                        'image' => $imageUrl,
                        'projects_id' => $project->id,
                    ]);
                }
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
    public function destroy($id) {
        $galleryImage = ProjectGallery::find($id);
        $projectId = $galleryImage->projects_id;
        $project = Projects::find($projectId);
        if ($galleryImage) {
            if ($galleryImage->image) {
                $oldImageName = basename($galleryImage->image);
                $oldPath = public_path('assets/images/projects/' . $project->slug . '/gallery/' . $oldImageName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $delete = $galleryImage->delete();
            if ($delete) {
                sweetalert()->success('Image Deleted Successfully', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
            } else {
                sweetalert()->error('Failed to delete image', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
            }
        }
        return redirect()->back();
    }
}
