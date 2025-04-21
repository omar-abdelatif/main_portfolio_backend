<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = $imageFile->storeAs('images/skills', $imageName, 'public');
            $imageUrl = Storage::url($imagePath);
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
                if ($skill->image) {
                    $oldPath = str_replace('/storage/', '', $skill->image);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('images/skills', $imageName, 'public');
                $imageUrl = Storage::url($imagePath);
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
                $imagePath = str_replace('/storage/', '', $skill->image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
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
