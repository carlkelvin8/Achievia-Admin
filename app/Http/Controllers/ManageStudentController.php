<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;


class ManageStudentController extends Controller
{
    public function index() {
        $students = User::where('role', 'student')
            ->with('section')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.students_index', compact('students'));
    }
    

    public function show($id) {
        $students = User::findorFail($id);
        return view('admin.students_show', compact('students'));
    }


    public function edit($id){
        $students = User::findorFail($id);
        return view('admin.students_edit', compact('students'));
    }
    public function destroy($id) {

      $students =  User::findorFail($id);
      $students->delete();

      return redirect()->route('students.index')->with('Deleted Successfully');


    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'age'            => 'required|integer|min:1',
            'status'         => 'required|in:active,inactive',
            'profile_image'  => 'nullable|image|max:2048',
        ]);

      // Handle image upload
if ($request->hasFile('profile_image')) {
    // Delete old image if it exists
    if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
        Storage::disk('public')->delete($student->profile_image);
    }

    // Store new image correctly inside the 'public' disk, under 'profile_images' folder
    $path = $request->file('profile_image')->store('profile_images', 'public');
    $validated['profile_image'] = $path;
}

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student profile updated successfully.');
    }


    public function sections($id){
        $sections = Section::where('user_id', $id)->where('status', 'published')->get();

        return view('admin.students_index', compact('sections'));
    }

}
