<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subject;

class TopicController extends Controller
{
    /**
     * Display a listing of topics.
     */
    public function index()
    {
        $topics = Topic::with('subject')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new topic.
     */
    public function create()
    {
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        return view('topics.create', compact('subjects'));
    }

    /**
     * Store a newly created topic in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'content' => 'nullable|string',
            'video_link' => 'nullable|url'
        ]);

        Topic::create($request->all());

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
    }

    /**
     * Show the form for editing the specified topic.
     */
    public function edit(Topic $topic)
    {
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        return view('topics.edit', compact('topic', 'subjects'));
    }

    /**
     * Update the specified topic in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'content' => 'nullable|string',
            'video_link' => 'nullable|url'
        ]);

        $topic->update($request->all());

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified topic from storage.
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }
}
