@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-4">{{ $quiz->title }}</h1>
    <p class="mb-6 text-gray-600">{{ $quiz->description }}</p>

    <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
        @csrf

        @foreach ($quiz->questions as $index => $question)
            <div class="mb-6">
                <h2 class="font-semibold text-lg mb-2">
                    Question {{ $index + 1 }}: {{ $question->question_text }}
                </h2>

                @foreach ($question->choices as $choice)
                    <div class="mb-1">
                        <label class="inline-flex items-center">
                            <input 
                                type="radio" 
                                name="answers[{{ $question->id }}]" 
                                value="{{ $choice->id }}" 
                                class="form-radio text-indigo-600"
                                required
                            >
                            <span class="ml-2">{{ $choice->choice_text }}</span>
                        </label>
                    </div>
                @endforeach

                @error("answers.{$question->id}")
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
            Submit Quiz
        </button>
    </form>
</div>
@endsection
