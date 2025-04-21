<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Pricing;
use App\Models\Projects;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $projectCount = Projects::count();
        $categoryCount = Categories::count();
        $planCount = Pricing::count();
        return view('pages.dashboard.index', compact('projectCount', 'categoryCount', 'planCount'));
    }
}
