<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class TeacherController extends Controller
{
    public function index() {
        $teachers = User::where('role', 'teacher')
            ->with('section')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.teachers', compact('teachers'));
    }

    public function destroy($id) {

        $teachers = User::findorFail($id);

        $teachers->delete();

        return redirect()->route('teachers.index')->with('Deleted SuccessFully');

    }

    public function edit($id) {

        $teacher = User::findorFail($id);

        return view('admin.edit_teacher', compact('teacher'));

    }

    public function show($id) {

        $teacher = User::findorFail($id);

        return view('admin.teacher_profile', compact('teacher'));

    }


    public function update(Request $request, $id)
    {
        $teacher = User::findOrFail($id);

        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
            'age'            => 'required|integer|min:1',
            'status'         => 'required|in:active,inactive',
            'profile_image'  => 'nullable|image|max:2048',
        ]);

      // Handle image upload
if ($request->hasFile('profile_image')) {
    // Delete old image if it exists
    if ($teacher->profile_image && Storage::disk('public')->exists($teacher->profile_image)) {
        Storage::disk('public')->delete($teacher->profile_image);
    }

    // Store new image correctly inside the 'public' disk, under 'profile_images' folder
    $path = $request->file('profile_image')->store('profile_images', 'public');
    $validated['profile_image'] = $path;
}

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher profile updated successfully.');
    }

}
