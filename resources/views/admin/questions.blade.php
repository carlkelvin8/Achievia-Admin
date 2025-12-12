{{-- resources/views/admin/questions.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Questions</title>

  {{-- Tailwind + Alpine + SweetAlert2 --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- TinyMCE (single include; use API key in prod, no-key in local) --}}
  @php
    $tinyKey  = config('services.tiny.key', 'no-api-key');
    $useNoKey = app()->environment('local') && ($tinyKey === 'no-api-key' || empty($tinyKey));
  @endphp
  <script
    src="https://cdn.tiny.cloud/1/{{ $useNoKey ? 'no-api-key' : $tinyKey }}/tinymce/7/tinymce.min.js"
    referrerpolicy="origin">
  </script>

  <script>
    // Convert HTML from TinyMCE into plain text for validation
    function htmlToText(html) {
      const tmp = document.createElement('div');
      tmp.innerHTML = (html || '').toString();
      return (tmp.textContent || tmp.innerText || '').trim();
    }

    document.addEventListener('DOMContentLoaded', () => {
      if (!window.tinymce) {
        console.warn('TinyMCE failed to load.');
        return;
      }
      if (window.__tinyInit) return; window.__tinyInit = true;

      tinymce.init({
        selector: 'textarea.rte',
        menubar: false,
        branding: false,
        statusbar: false,
        plugins: 'link lists code',
        toolbar: 'undo redo | bold italic underline | subscript superscript | bullist numlist | link | code',
        toolbar_mode: 'sliding',
        link_target_list: [{ title: 'New tab', value: '_blank' }, { title: 'None', value: '' }],
        block_unsupported_drop: true,
        convert_urls: false,
        valid_elements: 'p,br,span,em/i,strong/b,u,sub,sup,small,ul,ol,li,a[href|title|target],blockquote,code',
        content_style: 'body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;line-height:1.6;} sub{font-size:0.8em;} sup{font-size:0.8em;}'
      });

      // Custom validation for all .quiz-form (we use novalidate on the form tags)
      document.querySelectorAll('.quiz-form').forEach((form) => {
        form.addEventListener('submit', function (e) {
          // stop native submit first; we'll re-submit after checks
          e.preventDefault();

          // Sync TinyMCE values into the underlying <textarea>
          if (window.tinymce && tinymce.triggerSave) tinymce.triggerSave();

          // 1) Question text required
          const qTextArea = form.querySelector('textarea[name="question_text"]');
          const qTextPlain = htmlToText(qTextArea ? qTextArea.value : '');
          if (!qTextPlain) {
            Swal.fire({
              icon: 'warning',
              title: 'Question text is required',
              text: 'Please enter the question before saving.',
              confirmButtonText: 'Okay'
            });
            return;
          }

          // 2) At least one non-empty choice (text or image)
          const choiceTextAreas = [...form.querySelectorAll('textarea[name^="choices"]')];
          const choiceFiles     = [...form.querySelectorAll('input[type="file"][name^="choices"]')];

          const anyText = choiceTextAreas.some(t => htmlToText(t.value).length > 0);
          const anyFile = choiceFiles.some(f => (f.files && f.files.length > 0));

          if (!anyText && !anyFile) {
            Swal.fire({
              icon: 'warning',
              title: 'Add at least one choice',
              text: 'Please add at least one choice (text or image) before saving.',
              confirmButtonText: 'Okay'
            });
            return;
          }

          // 3) Exactly one "Correct" checkbox
          const checks = form.querySelectorAll('input[name="correct[]"]:checked');
          if (checks.length === 0) {
            Swal.fire({
              icon: 'warning',
              title: 'Select the correct answer',
              text: 'You forgot to mark a choice as correct. Please select exactly one correct answer.',
              confirmButtonText: 'Okay'
            });
            return;
          }
          if (checks.length > 1) {
            Swal.fire({
              icon: 'error',
              title: 'Only one correct answer allowed',
              text: 'Please select only one “Correct” checkbox.',
              confirmButtonText: 'Got it'
            });
            return;
          }

          // Passed all checks → submit for real
          form.submit();
        }, true);
      });
    });

    function confirmDelete(questionId) {
      Swal.fire({
        title: 'Delete this question?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById(`delete-form-${questionId}`).submit();
        }
      });
    }
  </script>
</head>
<body class="bg-gray-100 py-10">
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">

  {{-- Back to Quizzes --}}
  <div class="flex justify-end mb-4">
    <a href="{{ route('quizzes.index') }}"
       class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">
      Complete
    </a>
  </div>

  <h2 class="text-xl font-bold mb-4">Manage Questions for: {{ $quiz->title }}</h2>

  {{-- Validation Errors --}}
  @if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-700 text-sm">
      <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Success / Fatal --}}
  @if (session('success'))
    <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-700 text-sm">
      {{ session('success') }}
    </div>
  @endif
  @if (session('error'))
    <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-700 text-sm">
      {{ session('error') }}
    </div>
  @endif

  {{-- Add New Question --}}
  <form action="{{ route('quizzes.questions.store', $quiz->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4 mb-8 quiz-form"
        novalidate>
    @csrf

    <div>
      <label class="block font-medium mb-1">Question Text</label>
      <textarea name="question_text"
                class="rte w-full border px-3 py-2 rounded min-h-[140px]"
                required></textarea>
    </div>

    <div>
      <label class="block font-medium mb-1">Upload Image (optional)</label>
      <input type="file"
             name="question_image"
             accept="image/*"
             class="w-full border px-3 py-2 rounded bg-white" />
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
            <textarea
              name="choices[{{ $i }}][text]"
              placeholder="Choice {{ $i + 1 }}"
              class="rte w-full border px-3 py-2 rounded min-h-[100px] mb-2"></textarea>

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

      <p class="text-xs text-gray-500">Tip: You can leave a choice’s text empty if you upload an image; it will still save.</p>
    </div>

    <div>
      <label class="block font-medium mb-1">Explanation (Optional)</label>
      <textarea name="correct_description"
                rows="3"
                class="rte w-full border px-3 py-2 rounded min-h-[120px]"></textarea>
    </div>

    <div class="mt-3">
      <label for="notes" class="block font-medium mb-1">Notes (optional)</label>
      <textarea name="notes" id="notes" rows="3" class="rte w-full border px-3 py-2 rounded min-h-[100px]"></textarea>
    </div>

    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Add Question</button>
  </form>

  <hr class="my-6">

  {{-- Existing Questions --}}
  <h3 class="text-lg font-semibold mb-2">Existing Questions</h3>
  <ul>
    @forelse ($quiz->questions as $question)
      <li class="mb-6" x-data="{ open: false }">
        <div class="flex items-center justify-between">
          <p class="font-medium">{!! $question->question_text !!}</p>
          <button @click="open = true"
                  type="button"
                  class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
            Edit
          </button>
        </div>

        @if($question->image_path)
          <img src="{{ asset('storage/' . $question->image_path) }}"
               alt="Question Image"
               class="my-2 max-w-xs rounded border" />
        @endif

        <ul class="ml-4 list-disc space-y-2 mt-2">
          @foreach ($question->choices as $choice)
            <li class="{{ $choice->is_correct ? 'font-semibold text-green-700' : 'text-gray-700' }}">
              <div class="flex items-start gap-3">
                @if($choice->image)
                  <img src="{{ asset('storage/' . $choice->image) }}"
                       class="max-w-[140px] rounded border" />
                @endif
                <div>
                  {!! $choice->choice_text !!}
                  @if($choice->is_correct)
                    <div>
                      <span class="inline-block mt-1 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded">
                        Correct
                      </span>
                    </div>
                  @endif
                </div>
              </div>
            </li>
          @endforeach
        </ul>

        @if($question->notes)
          <div class="text-sm text-gray-700 mt-2">
            <strong>Note:</strong> {!! $question->notes !!}
          </div>
        @endif

        @if($question->correct_description)
          <div class="text-sm text-gray-700 mt-2">
            <strong>Explanation:</strong> {!! $question->correct_description !!}
          </div>
        @endif

        {{-- Delete Question --}}
        <form id="delete-form-{{ $question->id }}"
              action="{{ route('quizzes.questions.destroy', [$quiz->id, $question->id]) }}"
              method="POST"
              class="inline-block mt-3">
          @csrf
          @method('DELETE')
          <button type="button"
                  onclick="confirmDelete({{ $question->id }})"
                  class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 text-sm font-medium bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition">
            Delete
          </button>
        </form>

        {{-- Edit Modal --}}
        <div x-show="open"
             class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 px-4"
             x-transition>
          <div class="bg-white rounded-lg shadow-lg w-full max-w-full sm:max-w-lg md:max-w-2xl max-h-[90vh] overflow-y-auto p-6 relative">
            <button @click="open = false"
                    type="button"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
              ✖
            </button>

            <form action="{{ route('quizzes.questions.update', [$quiz->id, $question->id]) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="quiz-form space-y-4"
                  novalidate>
              @csrf
              @method('PUT')

              <label class="block font-medium">Question Text</label>
              <textarea name="question_text"
                        class="rte w-full border px-3 py-2 rounded min-h-[140px]"
                        required>{!! $question->question_text !!}</textarea>

              <label class="block font-medium">Question Type</label>
              <select name="question_type" required class="w-full border px-3 py-2 rounded">
                <option value="multiple_choice" {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>True/False</option>
                <option value="short_answer" {{ $question->question_type == 'short_answer' ? 'selected' : '' }}>Short Answer</option>
              </select>

              <label class="block font-medium">Question Image</label>
              @if($question->image_path)
                <img src="{{ asset('storage/' . $question->image_path) }}"
                     class="my-2 max-w-[150px] border rounded" />
              @endif
              <input type="file"
                     name="question_image"
                     accept="image/*"
                     class="w-full border px-3 py-2 rounded bg-white" />

              <label class="block font-medium">Choices</label>
              @foreach ($question->choices as $i => $choice)
                <input type="hidden" name="choices[{{ $i }}][id]" value="{{ $choice->id }}">
                <div class="flex flex-col sm:flex-row items-start gap-3 mb-4 w-full">
                  <div class="flex-1 w-full">
                    <textarea name="choices[{{ $i }}][text]"
                              class="rte w-full border px-3 py-2 rounded min-h-[100px]">{!! $choice->choice_text !!}</textarea>
                    @if($choice->image)
                      <img src="{{ asset('storage/' . $choice->image) }}"
                           class="my-2 max-w-[100px] border rounded" />
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
                <label for="notes-{{ $question->id }}" class="block font-medium mb-1">Notes (optional)</label>
                <textarea name="notes"
                          id="notes-{{ $question->id }}"
                          rows="3"
                          class="rte w-full border px-3 py-2 rounded min-h-[100px]">{!! $question->notes !!}</textarea>
              </div>

              <label class="block font-medium">Explanation</label>
              <textarea name="correct_description"
                        rows="3"
                        class="rte w-full border px-3 py-2 rounded min-h-[120px]">{!! $question->correct_description !!}</textarea>

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
    @empty
      <li class="text-gray-500">No questions yet. Use the form above to add one.</li>
    @endforelse
  </ul>
</div>

<script>
  // keep here so it's available even if Alpine hasn't mounted yet
  function confirmDelete(questionId) {
    Swal.fire({
      title: 'Delete this question?',
      text: 'This action cannot be undone.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Yes, delete it',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById(`delete-form-${questionId}`).submit();
      }
    });
  }
</script>
</body>
</html>