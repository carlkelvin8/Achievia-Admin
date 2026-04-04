<?php

namespace App\Http\Controllers;

use App\Models\Mnemonic;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MnController extends Controller
{
    public function index(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $subjects  = Subject::select('id', 'title')->orderBy('title')->get();

        $mnemonics = Mnemonic::with('subject')
            ->when($subjectId, fn($query) => $query->where('subject_id', $subjectId))
            ->orderBy('id', 'desc')
            ->paginate(20)->withQueryString();

        return view('admin.mnemonics_index', compact('mnemonics', 'subjects', 'subjectId'));
    }

    public function create()
    {
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        return view('admin.mnemonics_create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // validate subject
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ppt,pptx|max:5120',
            'description' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('mnemonics', 'public');
        }

        Mnemonic::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'file_path' => $filePath,
            'description' => $request->description,
        ]);

        return redirect()->route('mnemonics.index')->with('success', 'Mnemonic uploaded successfully.');
    }

    public function edit(Mnemonic $mnemonic)
    {
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        return view('admin.mnemonics_edit', compact('mnemonic', 'subjects'));
    }

    public function update(Request $request, Mnemonic $mnemonic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // validate subject
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ppt,pptx|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            if ($mnemonic->file_path) {
                Storage::disk('public')->delete($mnemonic->file_path);
            }
            $mnemonic->file_path = $request->file('file')->store('mnemonics', 'public');
        }

        $mnemonic->title = $request->title;
        $mnemonic->subject_id = $request->subject_id; // update subject
        $mnemonic->description = $request->description;
        $mnemonic->save();

        return redirect()->route('mnemonics.index')->with('success', 'Mnemonic updated.');
    }

    public function destroy(Mnemonic $mnemonic)
    {
        if ($mnemonic->file_path) {
            Storage::disk('public')->delete($mnemonic->file_path);
        }

        $mnemonic->delete();
        return redirect()->route('mnemonics.index')->with('success', 'Mnemonic deleted.');
    }
}

