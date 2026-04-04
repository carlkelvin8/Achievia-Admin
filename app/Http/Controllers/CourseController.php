<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::withCount('subjects')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.courses', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $users = User::whereIn('role', ['teacher', 'admin'])->get();
        return view('admin.create_courses', compact('users'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
    
        $data = $request->except('image');
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/courses', 'public');
        }
    
        Course::create($data);
    
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }
    
    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $users = User::whereIn('role', ['teacher', 'admin'])->get();
        return view('admin.edit_courses', compact('course', 'users'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        $data = $request->except('image');
    
        // Handle image update
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/courses', 'public');
            $data['image'] = $imagePath;
        }
    
        $course->update($data);
    
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }
    
    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
