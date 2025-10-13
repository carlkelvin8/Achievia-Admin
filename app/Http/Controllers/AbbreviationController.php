<?php

namespace App\Http\Controllers;

use App\Models\Abbreviation;
use App\Models\Subject;
use Illuminate\Http\Request;

class AbbreviationController extends Controller
{
    public function index(Request $request)
    {
        $subjectId = $request->input('subject_id');
    
        // Load subjects for the filter dropdown
        $subjects = Subject::all();
    
        // Query abbreviations, optionally filtering by subject
        $abbreviations = Abbreviation::with('subject')
            ->when($subjectId, fn($query) => $query->where('subject_id', $subjectId))
            ->latest()
            ->get();
    
        return view('admin.abbreviation_index', compact('abbreviations', 'subjects', 'subjectId'));
    }
    
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.abbreviation_create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'short_form' => 'required|string|max:100',
            'full_form' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Validate subject
        ]);

        Abbreviation::create($request->only('short_form', 'full_form', 'subject_id'));

        return redirect()->route('abbreviations.index')->with('success', 'Abbreviation added successfully.');
    }

    public function edit(Abbreviation $abbreviation)
    {
        $subjects = Subject::all(); // Pass subjects for dropdown
        return view('admin.abbreviation_edit', compact('abbreviation', 'subjects'));
    }

    public function update(Request $request, Abbreviation $abbreviation)
    {
        $request->validate([
            'short_form' => 'required|string|max:100',
            'full_form' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Validate subject
        ]);

        $abbreviation->update($request->only('short_form', 'full_form', 'subject_id'));

        return redirect()->route('abbreviations.index')->with('success', 'Abbreviation updated successfully.');
    }

    public function destroy(Abbreviation $abbreviation)
    {
        $abbreviation->delete();

        return redirect()->route('abbreviations.index')->with('success', 'Abbreviation deleted successfully.');
    }
}
