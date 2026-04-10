<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $quiz->title }} — Questions</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY','no-api-key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .modal-bg { background: rgba(0,0,0,.6); backdrop-filter: blur(4px); }
    .choice-letter {
      width: 28px; height: 28px; border-radius: 50%;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 11px; font-weight: 700; flex-shrink: 0;
    }
    .question-card { transition: box-shadow .2s, transform .2s; }
    .question-card:hover { box-shadow: 0 4px 24px rgba(0,0,0,.08); transform: translateY(-1px); }
    .form-input {
      width: 100%; border: 1.5px solid #e5e7eb; border-radius: 8px;
      padding: 10px 14px; font-size: 13px; outline: none; transition: border-color .2s;
      font-family: 'Inter', sans-serif;
    }
    .form-input:focus { border-color: #111; }
    .form-label { display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 6px; letter-spacing: .02em; text-transform: uppercase; }
    .btn-primary { background: #111; color: #fff; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background .2s; border: none; }
    .btn-primary:hover { background: #333; }
    .btn-secondary { background: #f3f4f6; color: #374151; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background .2s; border: none; }
    .btn-secondary:hover { background: #e5e7eb; }
    .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; }
    /* Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f9fafb; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

{{-- ── Top Bar ── --}}
<div class="bg-white border-b border-gray-200 sticky top-0 z-30">
  <div class="max-w-5xl mx-auto px-6 h-16 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <a href="{{ route('quizzes.index') }}" class="text-gray-400 hover:text-gray-700 transition">
        <i class="fas fa-arrow-left text-sm"></i>
      </a>
      <div>
        <h1 class="text-base font-700 text-gray-900 leading-tight font-bold">{{ $quiz->title }}</h1>
        <p class="text-xs text-gray-400">{{ number_format($questions->total()) }} questions</p>
      </div>
    </div>
    <button onclick="toggleAddForm()"
            class="btn-primary flex items-center gap-2">
      <i class="fas fa-plus text-xs"></i> Add Question
    </button>
  </div>
</div>

<div class="max-w-5xl mx-auto px-6 py-8">

  {{-- Alerts --}}
  @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-100 text-red-700 text-sm rounded-xl flex gap-3">
      <i class="fas fa-circle-exclamation mt-0.5 flex-shrink-0"></i>
      <ul class="list-disc ml-2">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
    </div>
  @endif
  @if(session('success'))
    <div class="mb-5 p-4 bg-green-50 border border-green-100 text-green-700 text-sm rounded-xl flex items-center gap-3">
      <i class="fas fa-circle-check flex-shrink-0"></i> {{session('success')}}
    </div>
  @endif
  @if(session('error'))
    <div class="mb-5 p-4 bg-red-50 border border-red-100 text-red-700 text-sm rounded-xl flex items-center gap-3">
      <i class="fas fa-circle-exclamation flex-shrink-0"></i> {{session('error')}}
    </div>
  @endif

  {{-- ── Add Question Panel ── --}}
  <div id="add-wrapper" style="display:none"
       class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h2 class="text-lg font-bold text-gray-900">New Question</h2>
        <p class="text-xs text-gray-400 mt-0.5">Fill in the question details below</p>
      </div>
      <button onclick="toggleAddForm()" class="text-gray-400 hover:text-gray-600 transition">
        <i class="fas fa-xmark text-lg"></i>
      </button>
    </div>

    <form id="add-form" action="{{ route('quizzes.questions.store', $quiz->id) }}"
          method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
      @csrf

      <div>
        <label class="form-label">Question Text <span class="text-red-500 normal-case">*</span></label>
        <textarea name="question_text" id="add_qt" rows="4" class="form-input"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="form-label">Question Type</label>
          <select name="question_type" class="form-input">
            <option value="multiple_choice">Multiple Choice</option>
            <option value="true_false">True / False</option>
            <option value="short_answer">Short Answer</option>
          </select>
        </div>
        <div>
          <label class="form-label">Question Image</label>
          <input type="file" name="question_image" accept="image/*" class="form-input py-2"/>
        </div>
      </div>

      <div>
        <label class="form-label">Answer Choices <span class="text-red-500 normal-case">*</span></label>
        <div class="space-y-3">
          @php $letters = ['A','B','C','D']; @endphp
          @for($i=0;$i<4;$i++)
            <div class="flex items-start gap-3">
              <span class="choice-letter bg-gray-100 text-gray-500 mt-2">{{ $letters[$i] }}</span>
              <div class="flex-1">
                <textarea name="choices[{{$i}}][text]" id="add_c{{$i}}" placeholder="Choice {{ $letters[$i] }}" rows="2"
                          class="form-input mb-1.5"></textarea>
                <input type="file" name="choices[{{$i}}][image]" accept="image/*" class="form-input py-1.5 text-xs"/>
              </div>
              <label class="flex items-center gap-2 mt-3 cursor-pointer select-none">
                <input type="checkbox" name="correct[]" value="{{$i}}" class="w-4 h-4 accent-black rounded"/>
                <span class="text-xs font-medium text-gray-600">Correct</span>
              </label>
            </div>
          @endfor
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="form-label">Explanation</label>
          <textarea name="correct_description" id="add_exp" rows="3" class="form-input"></textarea>
        </div>
        <div>
          <label class="form-label">Notes</label>
          <textarea name="notes" id="add_notes" rows="3" class="form-input"></textarea>
        </div>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-primary">Save Question</button>
        <button type="button" onclick="toggleAddForm()" class="btn-secondary">Cancel</button>
      </div>
    </form>
  </div>

  {{-- ── Search + Stats Bar ── --}}
  <div class="flex flex-wrap items-center gap-3 mb-5">
    <form method="GET" action="{{ route('quizzes.questions', $quiz->id) }}" class="flex gap-2 flex-1 min-w-[240px]">
      <div class="relative flex-1">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions..."
               class="form-input pl-9 py-2.5"/>
      </div>
      <button type="submit" class="btn-primary px-4 py-2.5">Search</button>
      @if(request('search'))
        <a href="{{ route('quizzes.questions', $quiz->id) }}" class="btn-secondary px-4 py-2.5">Clear</a>
      @endif
    </form>
    <div class="text-xs text-gray-400 whitespace-nowrap">
      {{ $questions->firstItem() }}–{{ $questions->lastItem() }} of {{ number_format($questions->total()) }}
      &nbsp;·&nbsp; Page {{ $questions->currentPage() }}/{{ $questions->lastPage() }}
    </div>
  </div>

  {{-- ── Question List ── --}}
  <div class="space-y-3">
    @forelse($questions as $idx => $question)
      @php $num = $questions->firstItem() + $idx; @endphp
      <div class="question-card bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        {{-- Question Header --}}
        <div class="flex items-start gap-4 p-5">
          <span class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-900 text-white text-xs font-bold flex items-center justify-center">
            {{ $num }}
          </span>
          <div class="flex-1 min-w-0">
            <div class="text-sm font-medium text-gray-900 leading-relaxed">{!! $question->question_text !!}</div>
            @if($question->image_path)
              <img src="{{ asset('storage/'.$question->image_path) }}" loading="lazy"
                   class="mt-3 max-w-xs rounded-xl border border-gray-100"/>
            @endif
          </div>
          <div class="flex gap-2 flex-shrink-0">
            <button type="button" onclick="openEdit({{ $question->id }})"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-900 text-white text-xs font-semibold hover:bg-gray-700 transition">
              <i class="fas fa-pen text-xs"></i> Edit
            </button>
            <form id="df{{$question->id}}" action="{{ route('quizzes.questions.destroy', [$quiz->id, $question->id]) }}"
                  method="POST" class="inline">
              @csrf @method('DELETE')
              <button type="button" onclick="delQ({{$question->id}})"
                      class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition">
                <i class="fas fa-trash text-xs"></i> Delete
              </button>
            </form>
          </div>
        </div>

        {{-- Choices --}}
        @if($question->choices->count())
          <div class="border-t border-gray-100 px-5 py-4 grid grid-cols-1 sm:grid-cols-2 gap-2">
            @php $choiceLetters = ['A','B','C','D','E','F']; @endphp
            @foreach($question->choices as $ci => $c)
              <div class="flex items-start gap-2.5 p-2.5 rounded-xl {{ $c->is_correct ? 'bg-green-50 border border-green-200' : 'bg-gray-50 border border-gray-100' }}">
                <span class="choice-letter {{ $c->is_correct ? 'bg-green-600 text-white' : 'bg-white text-gray-500 border border-gray-200' }}">
                  {{ $choiceLetters[$ci] ?? ($ci+1) }}
                </span>
                <div class="flex-1 min-w-0">
                  @if($c->image)
                    <img src="{{ asset('storage/'.$c->image) }}" loading="lazy" class="max-w-[80px] rounded-lg border mb-1"/>
                  @endif
                  <span class="text-xs {{ $c->is_correct ? 'text-green-800 font-semibold' : 'text-gray-600' }} leading-relaxed">
                    {!! $c->choice_text !!}
                  </span>
                </div>
                @if($c->is_correct)
                  <i class="fas fa-circle-check text-green-500 text-sm flex-shrink-0 mt-0.5"></i>
                @endif
              </div>
            @endforeach
          </div>
        @endif

        {{-- Explanation --}}
        @if($question->correct_description)
          <div class="border-t border-gray-100 px-5 py-3 flex gap-2.5 bg-blue-50/50">
            <i class="fas fa-lightbulb text-blue-400 text-xs mt-0.5 flex-shrink-0"></i>
            <p class="text-xs text-blue-700 leading-relaxed">{!! $question->correct_description !!}</p>
          </div>
        @endif
      </div>
    @empty
      <div class="bg-white rounded-2xl border border-dashed border-gray-300 py-16 text-center">
        <i class="fas fa-circle-question text-4xl text-gray-300 mb-3 block"></i>
        <p class="text-gray-500 font-medium">
          @if(request('search')) No results for "{{ request('search') }}" @else No questions yet @endif
        </p>
        @if(!request('search'))
          <p class="text-gray-400 text-sm mt-1">Click "Add Question" to get started</p>
        @endif
      </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  <div class="mt-6">{{ $questions->links() }}</div>
</div>

{{-- ── Edit Modal ── --}}
<div id="edit-modal" style="display:none"
     class="fixed inset-0 modal-bg flex items-center justify-center z-50 px-4 py-6">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
    <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between rounded-t-2xl z-10">
      <div>
        <h3 class="text-base font-bold text-gray-900">Edit Question</h3>
        <p class="text-xs text-gray-400 mt-0.5">Update the question details</p>
      </div>
      <button onclick="closeEdit()" class="text-gray-400 hover:text-gray-700 transition w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100">
        <i class="fas fa-xmark"></i>
      </button>
    </div>
    <div id="edit-body" class="p-6"></div>
  </div>
</div>

<script>
const QID  = {{ $quiz->id }};
const CSRF = '{{ csrf_token() }}';
const QS   = @json($questionsJson);

const TINY_CFG = {
  menubar:false, branding:false, statusbar:false,
  plugins:'link lists code charmap',
  toolbar:'undo redo | bold italic underline | subscript superscript | bullist numlist | charmap | link | code',
  toolbar_mode:'sliding', convert_urls:false,
  content_style:'body{font-family:Inter,system-ui,sans-serif;font-size:13px;line-height:1.6;color:#111}',
  charmap_append: [
    [0x2013, 'en dash –'],
    [0x2014, 'em dash —'],
    [0x2018, 'left single quote \u2018'],
    [0x2019, 'right single quote \u2019'],
    [0x00B0, 'degree °'],
    [0x201C, 'left double quote \u201C'],
    [0x201D, 'right double quote \u201D'],
    [0x00F7, 'division ÷'],
    [0x00B1, 'plus-minus ±'],
    [0x2265, 'greater or equal ≥'],
    [0x2248, 'approximately ≈'],
    [0x00AE, 'registered ®'],
    [0x2122, 'trademark ™'],
    [0x03C0, 'pi π'],
    [0x00FC, 'u umlaut ü'],
    [0x00F6, 'o umlaut ö'],
    [0x03B2, 'beta β'],
    [0x00DF, 'sharp s ß'],
    [0x00B5, 'micro µ'],
    [0x2264, 'less or equal ≤'],
    [0x03A9, 'omega Ω'],
    [0x0394, 'delta ∆'],
    [0x00E9, 'e acute é'],
    [0x00F1, 'n tilde ñ'],
    [0x00E3, 'a tilde ã'],
    [0x00EB, 'e umlaut ë'],
    [0x00EF, 'i umlaut ï'],
    [0x2260, 'not equal ≠'],
    [0x221A, 'square root √'],
  ]
};

function initEditors(ids) {
  ids.forEach(function(id) {
    var el = document.getElementById(id);
    if (!el) return;
    var existing = tinymce.get(id);
    if (existing) existing.remove();
    tinymce.init(Object.assign({}, TINY_CFG, { target: el }));
  });
}

function txt(html) {
  var d = document.createElement('div');
  d.innerHTML = html || '';
  return (d.textContent || d.innerText || '').trim();
}

var addReady = false;
var addIds = ['add_qt','add_c0','add_c1','add_c2','add_c3','add_exp','add_notes'];

function toggleAddForm() {
  var w = document.getElementById('add-wrapper');
  var opening = w.style.display === 'none';
  w.style.display = opening ? 'block' : 'none';
  if (opening && !addReady) {
    addReady = true;
    initEditors(addIds);
    document.getElementById('add-form').addEventListener('submit', function(e) {
      e.preventDefault();
      tinymce.triggerSave();
      if (!txt(document.getElementById('add_qt').value)) {
        Swal.fire({icon:'warning',title:'Question text required',confirmButtonText:'OK'}); return;
      }
      var anyTxt = ['add_c0','add_c1','add_c2','add_c3'].some(function(id) {
        return txt(document.getElementById(id) ? document.getElementById(id).value : '').length > 0;
      });
      var anyFile = Array.from(this.querySelectorAll('input[type=file][name^="choices"]')).some(function(f) {
        return f.files && f.files.length > 0;
      });
      if (!anyTxt && !anyFile) {
        Swal.fire({icon:'warning',title:'Add at least one choice',confirmButtonText:'OK'}); return;
      }
      var chk = this.querySelectorAll('input[name="correct[]"]:checked');
      if (!chk.length) { Swal.fire({icon:'warning',title:'Select correct answer',confirmButtonText:'OK'}); return; }
      if (chk.length > 1) { Swal.fire({icon:'error',title:'Only one correct answer',confirmButtonText:'OK'}); return; }
      var hiddenIdx = document.createElement('input');
      hiddenIdx.type = 'hidden'; hiddenIdx.name = 'correct_index';
      hiddenIdx.value = parseInt(chk[0].value);
      this.appendChild(hiddenIdx);
      this.submit();
    }, true);
  }
}

var currentEditIds = [];
var LETTERS = ['A','B','C','D','E','F'];

function openEdit(qid) {
  var q = QS[qid];
  if (!q) return;

  currentEditIds.forEach(function(id) { var e = tinymce.get(id); if (e) e.remove(); });

  var uid = Date.now();
  var qtId    = 'eq_qt_'    + uid;
  var expId   = 'eq_exp_'   + uid;
  var notesId = 'eq_notes_' + uid;
  var chIds   = q.ch.map(function(_, i) { return 'eq_c' + i + '_' + uid; });
  currentEditIds = [qtId, expId, notesId].concat(chIds);

  var chHtml = q.ch.map(function(c, i) {
    return '<div class="flex items-start gap-3 mb-3">' +
      '<input type="hidden" name="choices[' + i + '][id]" value="' + c.id + '">' +
      '<span style="width:28px;height:28px;border-radius:50%;background:#f3f4f6;color:#6b7280;display:inline-flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0;margin-top:8px">' + (LETTERS[i]||i+1) + '</span>' +
      '<div class="flex-1">' +
        '<textarea name="choices[' + i + '][text]" id="' + chIds[i] + '" rows="2" class="form-input mb-1.5"></textarea>' +
        (c.img ? '<img src="/storage/' + c.img + '" loading="lazy" class="my-1 max-w-[80px] rounded-lg border"/>' : '') +
        '<input type="file" name="choices[' + i + '][image]" accept="image/*" class="form-input py-1.5 text-xs"/>' +
      '</div>' +
      '<label class="flex items-center gap-2 mt-3 cursor-pointer">' +
        '<input type="checkbox" name="correct[]" value="' + i + '" ' + (c.ok ? 'checked' : '') + ' class="w-4 h-4 accent-black"/>' +
        '<span class="text-xs font-medium text-gray-600 whitespace-nowrap">Correct</span>' +
      '</label>' +
    '</div>';
  }).join('');

  document.getElementById('edit-body').innerHTML =
    '<form id="edit-form" action="/quizzes/' + QID + '/questions/' + q.id + '" method="POST" enctype="multipart/form-data" class="space-y-5" novalidate>' +
      '<input type="hidden" name="_token" value="' + CSRF + '">' +
      '<input type="hidden" name="_method" value="PUT">' +
      '<div>' +
        '<label class="form-label">Question Text</label>' +
        '<textarea name="question_text" id="' + qtId + '" rows="4" class="form-input"></textarea>' +
      '</div>' +
      '<div class="grid grid-cols-2 gap-4">' +
        '<div><label class="form-label">Type</label>' +
          '<select name="question_type" class="form-input">' +
            '<option value="multiple_choice"' + (q.type==='multiple_choice'?' selected':'') + '>Multiple Choice</option>' +
            '<option value="true_false"' + (q.type==='true_false'?' selected':'') + '>True / False</option>' +
            '<option value="short_answer"' + (q.type==='short_answer'?' selected':'') + '>Short Answer</option>' +
          '</select></div>' +
        '<div><label class="form-label">Replace Image</label>' +
          (q.img ? '<img src="/storage/' + q.img + '" loading="lazy" class="mb-2 max-w-[80px] rounded-lg border"/>' : '') +
          '<input type="file" name="question_image" accept="image/*" class="form-input py-2 text-xs"/></div>' +
      '</div>' +
      '<div><label class="form-label">Answer Choices</label>' + chHtml + '</div>' +
      '<div class="grid grid-cols-2 gap-4">' +
        '<div><label class="form-label">Explanation</label>' +
          '<textarea name="correct_description" id="' + expId + '" rows="3" class="form-input"></textarea></div>' +
        '<div><label class="form-label">Notes</label>' +
          '<textarea name="notes" id="' + notesId + '" rows="3" class="form-input"></textarea></div>' +
      '</div>' +
      '<div class="flex gap-3 pt-2">' +
        '<button type="submit" class="btn-primary">Save Changes</button>' +
        '<button type="button" onclick="closeEdit()" class="btn-secondary">Cancel</button>' +
      '</div>' +
    '</form>';

  document.getElementById(qtId).value    = q.qt    || '';
  document.getElementById(expId).value   = q.exp   || '';
  document.getElementById(notesId).value = q.notes || '';
  q.ch.forEach(function(c, i) {
    var el = document.getElementById(chIds[i]);
    if (el) el.value = c.t || '';
  });

  document.getElementById('edit-modal').style.display = 'flex';
  initEditors(currentEditIds);

  document.getElementById('edit-form').addEventListener('submit', function(e) {
    e.preventDefault();
    tinymce.triggerSave();
    if (!txt(document.getElementById(qtId).value)) {
      Swal.fire({icon:'warning',title:'Question text required',confirmButtonText:'OK'}); return;
    }
    var chk = this.querySelectorAll('input[name="correct[]"]:checked');
    if (!chk.length) { Swal.fire({icon:'warning',title:'Select correct answer',confirmButtonText:'OK'}); return; }
    if (chk.length > 1) { Swal.fire({icon:'error',title:'Only one correct answer',confirmButtonText:'OK'}); return; }
    var hidden = document.createElement('input');
    hidden.type = 'hidden'; hidden.name = 'correct_index';
    hidden.value = parseInt(chk[0].value);
    this.appendChild(hidden);
    this.submit();
  }, true);
}

function closeEdit() {
  currentEditIds.forEach(function(id) { var e = tinymce.get(id); if (e) e.remove(); });
  document.getElementById('edit-modal').style.display = 'none';
  document.getElementById('edit-body').innerHTML = '';
  currentEditIds = [];
}

function delQ(id) {
  Swal.fire({
    title: 'Delete question?', text: 'This cannot be undone.', icon: 'warning',
    showCancelButton: true, confirmButtonColor: '#111', cancelButtonColor: '#6b7280',
    confirmButtonText: 'Delete', reverseButtons: true
  }).then(function(r) { if (r.isConfirmed) document.getElementById('df' + id).submit(); });
}

document.getElementById('edit-modal').addEventListener('click', function(e) {
  if (e.target === this) closeEdit();
});
</script>
</body>
</html>
