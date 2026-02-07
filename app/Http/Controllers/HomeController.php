<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Journal;
use App\Models\Service;
use App\Models\ServiceCategories;

class HomeController extends Controller
{
    public function index()
    {
        $galeris = Galery::all();
        $journals = Journal::latest()->take(6)->get();
        // TODO: if journal < 6 or journal is empty, get all journal
        if ($journals->count() < 6 || $journals->isEmpty()) {
            $journals = Journal::latest()->get();
        }

        // Count journals
        $journalCount = Journal::count() - $journals->count();

        // Get service data by CategoryService
        $categories = ServiceCategories::with(['services' => function ($q) {
            $q->orderBy('name');
        }])->get();

        // Get Special Packages
        $specialPackages = \App\Models\SpecialPackage::orderBy('sort_order')->get();

        return view('kuga.index', compact('galeris', 'journals', 'journalCount', 'categories', 'specialPackages'));
    }
}
