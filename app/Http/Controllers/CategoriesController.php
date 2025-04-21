<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $cats = Categories::all();
        return view('pages.categories.index', compact('cats'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
        $slug = Str::slug($request->name);
        $store = Categories::create([
            'name' => $request->name,
            'slug' => $slug
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
    public function update(Request $request) {
        $slug = Str::slug($request->name);
        $update = Categories::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => $slug
        ]);
        if ($update) {
            sweetalert()->success('Updated Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
    public function delete($id) {
        $delete = Categories::where('id', $id)->delete();
        if ($delete) {
            sweetalert()->success('Deleted Successfully', [
                'customClass' => [
                    'confirmButton' => 'text-white'
                ]
            ]);
            return redirect()->back();
        }
    }
}
