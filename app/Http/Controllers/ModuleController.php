<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{

    public function index(Request $request) {
        $subjectId = $request->input('subject');

        if (Auth::user()->role === 'teacher') {
            $modules = Module::with('subject')
                             ->where('user_id', Auth::id())
                             ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
                             ->orderBy('id', 'desc')
                             ->paginate(20)->withQueryString();
        } else {
            $modules = Module::with('subject')
                             ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
                             ->orderBy('id', 'desc')
                             ->paginate(20)->withQueryString();
        }

        $subjects = Subject::select('id', 'title')->orderBy('title')->get();

        return view('admin.admin_modules', compact('modules', 'subjects', 'subjectId'));
    }
    
    public function create() {
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        return view('admin.upload_modules', compact('subjects'));
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'title' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:5120'],
        ]);
    
        $validatedData['user_id'] = Auth::id();

        // Store files
        $validatedData['image'] = $request->file('image')->store('uploads', 'public');
        $validatedData['file'] = $request->file('file')->store('uploads', 'public');
    
        // Default status
        $validatedData['status'] = $request->input('status', 'published');
    
        // Create module with all validated + assigned data
        $module = Module::create($validatedData);
    
        return redirect()->route('modules.index')->with('success', 'Module Created Successfully');
    }
    

    public function edit($id) {
        $module   = Module::findOrFail($id);
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        return view('admin.edit_modules', compact('module', 'subjects'));
    }

    public function update(Request $request, $id) {

        $validatedData = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'title' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'file' => ['required','file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:5120'],
        ]);

        $module = Module::findorFail($id);

        if ($request->hasFile('image')) {
            if ($module->image) {
                Storage::disk('public')->delete($module->image);
            }
            $validatedData['image'] = $request->file('image')->store('uploads', 'public');
        }

        if ($request->hasFile('file')) {
            if ($module->file) {
                Storage::disk('public')->delete($module->file);
            }
            $validatedData['file'] = $request->file('file')->store('uploads', 'public');
        }

        $module->update($validatedData);
        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');

    }

    public function destroy ($id) {

        $module = Module::findorFail($id);

        if ($module->file) {
            Storage::disk('public')->delete($module->file);
        }
        
        if ($module->image) {
            Storage::disk('public')->delete($module->image);
        }

        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');

    }


}
