<?php

namespace App\Http\Controllers;

use App\Models\Journal;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::latest()->get();

        return view('kuga.journals', compact('journals'));
    }

    public function view($title)
    {
        $journal = Journal::where('title', $title)->firstOrFail();

        return view('kuga.journal-view', compact('journal'));
    }
}
