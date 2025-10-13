<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;
use App\Models\Subject;
class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $subjectId = $request->input('subject_id');
    
        // Load subjects for the filter dropdown
        $subjects = Subject::all();
    
        $procedures = Procedure::query()
            ->when($subjectId, fn($query) => $query->where('subject_id', $subjectId))
            ->latest()
            ->get();
    
        return view('admin.procedures_index', compact('procedures', 'subjects', 'subjectId'));
    }
    

    public function create()
{
    $subjects = Subject::all(); // Get all subjects
    return view('admin.procedures_create', compact('subjects'));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Validate selected subject
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ppt,pptx|max:5120',
        ]);
        
   

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('procedures', 'public');
        }

        Procedure::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'file_path' => $filePath,
        ]);
        

        return redirect()->route('procedures.index')->with('success', 'Procedure uploaded successfully.');
    }

    public function edit(Procedure $procedure)
    {
        $subjects = Subject::all(); // load all subjects for the select dropdown
        return view('admin.procedures_edit', compact('procedure', 'subjects'));
    }
    

    public function update(Request $request, Procedure $procedure)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Validate selected subject
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ppt,pptx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('procedures', 'public');
            $procedure->file_path = $filePath;
        }

        $procedure->title = $request->title;
        $procedure->subject_id = $request->subject_id;
        $procedure->save();

        return redirect()->route('procedures.index')->with('success', 'Procedure updated successfully.');
    }

    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        return redirect()->route('procedures.index')->with('success', 'Procedure deleted.');
    }

}
