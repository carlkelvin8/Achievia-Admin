<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;

class SubjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Subject::with('course')->orderBy('id', 'desc');

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $subjects = $query->paginate(20)->withQueryString();
        $courses  = \App\Models\Course::select('id', 'title')->orderBy('title')->get();

        return view('admin.subject', compact('subjects', 'courses'));
    }

    public function create()
    {
        $courses = Course::select('id', 'title')->orderBy('title')->get();
        return view('admin.create_subjects', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/subjects', 'public');
        }

        Subject::create($data);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Show the form for editing the specified subject.
     */
    public function edit(Subject $subject)
    {
        $courses = Course::select('id', 'title')->orderBy('title')->get();
        return view('admin.edit_subjects', compact('subject', 'courses'));
    }

    /**
     * Update the specified subject in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/subjects', 'public');
        }

        $subject->update($data);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified subject from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
