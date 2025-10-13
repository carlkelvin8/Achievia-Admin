<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Questions</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 py-10">
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">

  <!-- Back to Quizzes -->
  <div class="flex justify-end mb-4">
    <a href="{{ route('quizzes.index') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">
      Complete
    </a>
  </div>

  <h2 class="text-xl font-bold mb-4">Manage Questions for: {{ $quiz->title }}</h2>

  <!-- Validation Errors -->
  @if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-700 text-sm">
      <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Success Message -->
  @if (session('success'))
    <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-700 text-sm">
      {{ session('success') }}
    </div>
  @endif

  {{-- Add New Question --}}
  <form action="{{ route('quizzes.questions.store', $quiz->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 mb-8 quiz-form">
    @csrf

    <div>
      <label class="block font-medium mb-1">Question Text</label>
      <input type="text" name="question_text" required class="w-full border px-3 py-2 rounded" />
    </div>

    <div>
      <label class="block font-medium mb-1">Upload Image (optional)</label>
      <input type="file" name="question_image" accept="image/*" class="w-full border px-3 py-2 rounded bg-white" />
    </div>

    <div>
      <label class="block font-medium mb-1">Question Type</label>
      <select name="question_type" required class="w-full border px-3 py-2 rounded">
        <option value="multiple_choice">Multiple Choice</option>
        <option value="true_false">True/False</option>
        <option value="short_answer">Short Answer</option>
      </select>
    </div>

    <div>
      <label class="block font-medium mb-2">Choices</label>
      @for ($i = 0; $i < 4; $i++)
        <div class="flex items-start gap-3 mb-4">
          <div class="flex-1">
            <input type="text"
                   name="choices[{{ $i }}][text]"
                   placeholder="Choice {{ $i + 1 }}"
                   class="w-full border px-3 py-2 rounded mb-2" />
            <input type="file"
                   name="choices[{{ $i }}][image]"
                   accept="image/*"
                   class="w-full border px-3 py-2 rounded bg-white" />
          </div>
          <label class="flex items-center gap-2 mt-2">
            <input type="checkbox" name="correct[]" value="{{ $i }}" />
            <span>Correct</span>
          </label>
        </div>
      @endfor
    </div>

    <div class="mt-3">
  <label for="notes" class="block font-medium mb-1">Notes (optional)</label>
  <textarea name="notes" id="notes" rows="3"
            class="w-full border px-3 py-2 rounded">{{ old('notes', $question->notes ?? '') }}</textarea>
</div>

    <div>
      <label class="block font-medium mb-1">Explanation (Optional)</label>
      <textarea name="correct_description" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
    </div>

    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Add Question</button>
  </form>

  <hr class="my-6">

  {{-- Existing Questions --}}
  <h3 class="text-lg font-semibold mb-2">Existing Questions</h3>
  <ul>
    @foreach ($quiz->questions as $question)
      <li class="mb-6" x-data="{ open: false }">
        <div class="flex items-center justify-between">
          <p class="font-medium">Q: {{ $question->question_text }}</p>
          <button @click="open = true" 
                  class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
            Edit
          </button>
        </div>

        @if($question->image_path)
          <img src="{{ asset('storage/' . $question->image_path) }}" alt="Question Image" class="my-2 max-w-xs rounded border" />
        @endif

        <ul class="ml-4 list-disc space-y-2 mt-2">
          @foreach ($question->choices as $choice)
            <li class="{{ $choice->is_correct ? 'font-semibold text-green-700' : 'text-gray-700' }}">
              <div class="flex items-start gap-3">
                @if($choice->image)
                  <img src="{{ asset('storage/' . $choice->image) }}" class="max-w-[140px] rounded border" />
                @endif
                <div>
                  <div>{{ $choice->choice_text }}</div>
                  @if($choice->is_correct)
                    <span class="inline-block mt-1 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded">Correct</span>
                  @endif
                </div>
              </div>
            </li>
          @endforeach
        </ul>

        @if($question->notes)
      <p class="text-sm text-gray-600 mt-2">🗒 <strong>Notes:</strong> {{ $question->notes }}</p>
    @endif


        @if($question->correct_description)
          <p class="text-sm text-gray-600 mt-2">📝 <strong>Explanation:</strong> {{ $question->correct_description }}</p>
        @endif

        {{-- Delete Question --}}
        <form id="delete-form-{{ $question->id }}" action="{{ route('quizzes.questions.destroy', [$quiz->id, $question->id]) }}" method="POST" class="inline-block mt-3">
          @csrf
          @method('DELETE')
          <button type="button" onclick="confirmDelete({{ $question->id }})" class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 text-sm font-medium bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition">
            Delete
          </button>
        </form>

      
      <!-- Edit Modal -->
<div 
  x-show="open" 
  class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 px-4"
  x-transition
>
  <div 
    class="bg-white rounded-lg shadow-lg w-full max-w-full sm:max-w-lg md:max-w-2xl 
           max-h-[90vh] overflow-y-auto p-6 relative"
  >
    <!-- Close button -->
    <button 
      @click="open = false" 
      class="absolute top-3 right-3 text-gray-500 hover:text-gray-800"
    >
      ✖
    </button>

    <!-- Form -->
    <form action="{{ route('questions.update', [$quiz->id, $question->id]) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="quiz-form space-y-4">
      @csrf
      @method('PUT')

      <label class="block font-medium">Question Text</label>
      <input type="text" name="question_text" 
             value="{{ $question->question_text }}" 
             class="w-full border px-3 py-2 rounded" required />

      <label class="block font-medium">Question Type</label>
      <select name="question_type" required class="w-full border px-3 py-2 rounded">
        <option value="multiple_choice" {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
        <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>True/False</option>
        <option value="short_answer" {{ $question->question_type == 'short_answer' ? 'selected' : '' }}>Short Answer</option>
      </select>

      <label class="block font-medium">Question Image</label>
      @if($question->image_path)
        <img src="{{ asset('storage/' . $question->image_path) }}" class="my-2 max-w-[150px] border rounded" />
      @endif
      <input type="file" name="question_image" accept="image/*" 
             class="w-full border px-3 py-2 rounded bg-white" />

      <label class="block font-medium">Choices</label>
      @foreach ($question->choices as $i => $choice)
        <input type="hidden" name="choices[{{ $i }}][id]" value="{{ $choice->id }}">
        <div class="flex flex-col sm:flex-row items-start gap-3 mb-4">
          <div class="flex-1">
            <input type="text" 
                   name="choices[{{ $i }}][text]" 
                   value="{{ $choice->choice_text }}" 
                   class="w-full border px-3 py-2 rounded mb-2" />
            @if($choice->image)
              <img src="{{ asset('storage/' . $choice->image) }}" class="my-2 max-w-[100px] border rounded" />
            @endif
            <input type="file" 
                   name="choices[{{ $i }}][image]" 
                   accept="image/*" 
                   class="w-full border px-3 py-2 rounded bg-white" />
          </div>
          <label class="flex items-center gap-2 mt-2">
            <input type="checkbox" name="correct[]" value="{{ $i }}" {{ $choice->is_correct ? 'checked' : '' }} />
            <span>Correct</span>
          </label>
        </div>
      @endforeach
 
      <div class="mt-3">
  <label for="notes" class="block font-medium mb-1">Notes (optional)</label>
  <textarea name="notes" id="notes" rows="3"
            class="w-full border px-3 py-2 rounded">{{ old('notes', $question->notes ?? '') }}</textarea>
</div>

      <label class="block font-medium">Explanation</label>
      <textarea name="correct_description" rows="3" 
                class="w-full border px-3 py-2 rounded">{{ $question->correct_description }}</textarea>

      <div class="text-right">
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>

      </li>
    @endforeach
  </ul>
</div>

<script>
function confirmDelete(questionId) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This question will be permanently deleted.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Yes, delete it!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById(`delete-form-${questionId}`).submit();
      }
    });
}

// Apply validation to ALL quiz forms
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.quiz-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      const checkboxes = form.querySelectorAll('input[name="correct[]"]:checked');
      if (checkboxes.length > 1) {
        e.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Only one correct answer allowed',
          text: 'Please select only one correct answer per question.',
          confirmButtonColor: '#d33'
        });
      }
    });
  });
});
</script>

</body>
</html>
