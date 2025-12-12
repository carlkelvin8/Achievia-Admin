<?php

namespace App\Http\Controllers;

use App\Models\Abbreviation;
use App\Models\Subject;
use Illuminate\Http\Request;

class AbbreviationController extends Controller
{
    /** Allow only the tags needed for nomenclature */
    protected function cleanAbbrev(?string $html): ?string
    {
        if ($html === null) return null;
        $html = trim($html);
        // Keep only <i>/<em>/<sub>/<sup>
        $html = strip_tags($html, '<i><em><sub><sup>');
        // Normalize whitespace a bit
        $html = preg_replace('/\s+/u', ' ', $html);
        return $html;
    }

    public function index(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $q         = $request->input('q');

        $subjects = Subject::orderBy('title')->get();

        $abbreviations = Abbreviation::with('subject')
            ->when($subjectId, fn($qry) => $qry->where('subject_id', $subjectId))
            ->when($q, function ($qry) use ($q) {
                $like = '%'.$q.'%';
                $qry->where(function ($w) use ($like) {
                    $w->where('short_form', 'like', $like)
                      ->orWhere('full_form',  'like', $like);
                });
            })
            ->latest()
            ->paginate(15)
            ->appends($request->query());

        $total = $abbreviations->total();

        return view('admin.abbreviation_index', compact('abbreviations','subjects','subjectId','q','total'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('title')->get();
        return view('admin.abbreviation_create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'short_form' => 'required|string|max:255',
            'full_form'  => 'required|string|max:1000',
        ]);

        Abbreviation::create([
            'subject_id' => (int)$request->subject_id,
            'short_form' => $this->cleanAbbrev($request->short_form),
            'full_form'  => $this->cleanAbbrev($request->full_form),
        ]);

        return redirect()->route('abbreviations.index')->with('success', 'Abbreviation added successfully.');
    }

    public function edit(Abbreviation $abbreviation)
    {
        $subjects = Subject::orderBy('title')->get();
        return view('admin.abbreviation_edit', compact('abbreviation','subjects'));
    }

    public function update(Request $request, Abbreviation $abbreviation)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'short_form' => 'required|string|max:255',
            'full_form'  => 'required|string|max:1000',
        ]);

        $abbreviation->update([
            'subject_id' => (int)$request->subject_id,
            'short_form' => $this->cleanAbbrev($request->short_form),
            'full_form'  => $this->cleanAbbrev($request->full_form),
        ]);

        return redirect()->route('abbreviations.index')->with('success', 'Abbreviation updated successfully.');
    }

    public function destroy(Abbreviation $abbreviation)
    {
        $abbreviation->delete();
        return redirect()->route('abbreviations.index')->with('success', 'Abbreviation deleted successfully.');
    }
}