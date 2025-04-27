<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index() {
        $skills = Skills::all();
        return view('pages.skills.skills', compact('skills'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|numeric|min:1|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $destinationPath = 'assets/images/skills/';
            $imageFile->move(public_path($destinationPath), $imageName);
            $imageUrl = asset($destinationPath . $imageName);
        }
        $createdSkill = Skills::create([
            'name'  => $request->name,
            'level' => $request->level,
            'image' => $imageUrl,
        ]);
        if ($createdSkill) {
            sweetalert()->success('Skill Added Successfully!', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
    public function update(Request $request) {
        $skill = Skills::find($request->id);
        if ($skill) {
            if (isset($request->name)) {
                $skill->name = $request->name;
            }
            if (isset($request->level)) {
                $skill->level = $request->level;
            }
            if ($request->hasFile('image')) {
                // Extract the filename from the stored URL
                if ($skill->image) {
                    $oldImageName = basename($skill->image);
                    $oldPath = public_path('assets/images/skills/' . $oldImageName);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = 'assets/images/skills/';
                $imageFile->move(public_path($destinationPath), $imageName);
                $imageUrl = asset($destinationPath . $imageName);
                $skill->image = $imageUrl;
            }
            if ($skill->save()) {
                sweetalert()->success('Skill Updated Successfully!', [
                    'customClass' => [
                        'confirmButton' => 'text-white'
                    ]
                ]);
                return redirect()->back();
            }
        }
    }
    public function destroy(Request $request) {
        $skill = Skills::find($request->id);
        if ($skill) {
            if ($skill->image) {
                $oldImageName = basename($skill->image);
                $oldPath = public_path('assets/images/skills/' . $oldImageName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $skill->delete();
            sweetalert()->success('Skill Deleted Successfully!', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
}
