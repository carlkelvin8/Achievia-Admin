<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $quiz->title }} — Questions</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY','no-api-key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <style>.modal-bg{background:rgba(0,0,0,.5)}</style>
</head>
<body class="bg-gray-100 py-6">
<div class="max-w-5xl mx-auto px-4">

  <div class="bg-white rounded-lg shadow p-4 mb-4 flex flex-wrap items-center justify-between gap-3">
    <div>
      <h1 class="text-xl font-bold text-gray-900">{{ $quiz->title }}</h1>
      <p class="text-sm text-gray-500">{{ number_format($questions->total()) }} questions</p>
    </div>
    <div class="flex gap-2">
      <button onclick="toggleAddForm()" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 text-sm">
        <i class="fas fa-plus mr-1"></i>Add Question
      </button>
      <a href="{{ route('quizzes.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 text-sm">Back</a>
    </div>
  </div>

  @if($errors->any())
    <div class="mb-3 p-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded">
      <ul class="list-disc ml-4">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
    </div>
  @endif
  @if(session('success'))
    <div class="mb-3 p-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded">{{session('success')}}</div>
  @endif
  @if(session('error'))
    <div class="mb-3 p-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded">{{session('error')}}</div>
  @endif

  <div id="add-wrapper" style="display:none" class="bg-white rounded-lg shadow p-6 mb-4">
    <h2 class="text-lg font-semibold mb-4">Add New Question</h2>
    <form id="add-form" action="{{ route('quizzes.questions.store', $quiz->id) }}"
          method="POST" enctype="multipart/form-data" class="space-y-4" novalidate>
      @csrf
      <div>
        <label class="block text-sm font-medium mb-1">Question Text *</label>
        <textarea name="question_text" id="add_qt" rows="4" class="w-full border rounded px-3 py-2 text-sm"></textarea>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Question Type</label>
          <select name="question_type" class="w-full border rounded px-3 py-2 text-sm">
            <option value="multiple_choice">Multiple Choice</option>
            <option value="true_false">True/False</option>
            <option value="short_answer">Short Answer</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Image (optional)</label>
          <input type="file" name="question_image" accept="image/*" class="w-full border rounded px-3 py-2 bg-white text-sm"/>
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium mb-2">Choices *</label>
        @for($i=0;$i<4;$i++)
          <div class="flex items-start gap-3 mb-2">
            <div class="flex-1">
              <textarea name="choices[{{$i}}][text]" id="add_c{{$i}}" placeholder="Choice {{$i+1}}" rows="2"
                        class="w-full border rounded px-3 py-2 text-sm mb-1"></textarea>
              <input type="file" name="choices[{{$i}}][image]" accept="image/*" class="w-full border rounded px-2 py-1 bg-white text-xs"/>
            </div>
            <label class="flex items-center gap-1 mt-2 text-sm whitespace-nowrap">
              <input type="checkbox" name="correct[]" value="{{$i}}"/> Correct
            </label>
          </div>
        @endfor
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Explanation</label>
          <textarea name="correct_description" id="add_exp" rows="3" class="w-full border rounded px-3 py-2 text-sm"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Notes</label>
          <textarea name="notes" id="add_notes" rows="3" class="w-full border rounded px-3 py-2 text-sm"></textarea>
        </div>
      </div>
      <div class="flex gap-2">
        <button type="submit" class="bg-black text-white px-4 py-2 rounded text-sm hover:bg-gray-800">Add Question</button>
        <button type="button" onclick="toggleAddForm()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">Cancel</button>
      </div>
    </form>
  </div>

  <div class="bg-white rounded-lg shadow p-4">
    <form method="GET" action="{{ route('quizzes.questions', $quiz->id) }}" class="flex gap-2 mb-4">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions..."
             class="flex-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-black"/>
      <button type="submit" class="bg-black text-white px-4 py-2 rounded text-sm">Search</button>
      @if(request('search'))
        <a href="{{ route('quizzes.questions', $quiz->id) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">Clear</a>
      @endif
    </form>
    <div class="flex justify-between text-xs text-gray-400 mb-3">
      <span>{{ $questions->firstItem() }}–{{ $questions->lastItem() }} of {{ number_format($questions->total()) }}</span>
      <span>Page {{ $questions->currentPage() }}/{{ $questions->lastPage() }}</span>
    </div>
    <ul class="divide-y divide-gray-100">
      @forelse($questions as $idx => $question)
        <li class="py-3">
          <div class="flex items-start justify-between gap-2">
            <div class="flex-1 min-w-0">
              <span class="text-xs text-gray-400 mr-1">#{{ $questions->firstItem() + $idx }}</span>
              <span class="text-sm font-medium">{!! $question->question_text !!}</span>
            </div>
            <div class="flex gap-1 flex-shrink-0">
              <button type="button" onclick="openEdit({{ $question->id }})"
                      class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</button>
              <form id="df{{$question->id}}" action="{{ route('quizzes.questions.destroy', [$quiz->id, $question->id]) }}"
                    method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="button" onclick="delQ({{$question->id}})"
                        class="bg-red-50 hover:bg-red-100 text-red-600 px-2 py-1 rounded text-xs">Delete</button>
              </form>
            </div>
          </div>
          @if($question->image_path)
            <img src="{{ asset('storage/'.$question->image_path) }}" loading="lazy" class="mt-2 max-w-[200px] rounded border"/>
          @endif
          <ul class="mt-2 space-y-0.5 pl-4">
            @foreach($question->choices as $c)
              <li class="text-xs flex items-start gap-1 {{ $c->is_correct ? 'text-green-700 font-semibold' : 'text-gray-500' }}">
                <span class="mt-0.5 flex-shrink-0">{{ $c->is_correct ? '✓' : '○' }}</span>
                <span>
                  @if($c->image)<img src="{{ asset('storage/'.$c->image) }}" loading="lazy" class="max-w-[80px] rounded border inline-block mr-1"/>@endif
                  {!! $c->choice_text !!}
                </span>
              </li>
            @endforeach
          </ul>
          @if($question->correct_description)
            <p class="text-xs text-gray-400 mt-1 italic pl-4">{!! $question->correct_description !!}</p>
          @endif
        </li>
      @empty
        <li class="py-8 text-center text-gray-400 text-sm">
          @if(request('search')) No results for "{{ request('search') }}" @else No questions yet. @endif
        </li>
      @endforelse
    </ul>
    <div class="mt-4">{{ $questions->links() }}</div>
  </div>
</div>

<div id="edit-modal" style="display:none" class="fixed inset-0 modal-bg flex items-center justify-center z-50 px-4">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 relative">
    <button onclick="closeEdit()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-lg">✕</button>
    <h3 class="text-lg font-semibold mb-4">Edit Question</h3>
    <div id="edit-body"></div>
  </div>
</div>

<script>
const QID  = {{ $quiz->id }};
const CSRF = '{{ csrf_token() }}';
const QS   = @json($questionsJson);

const TINY_CFG = {
  menubar:false, branding:false, statusbar:false,
  plugins:'link lists code',
  toolbar:'undo redo | bold italic underline | subscript superscript | bullist numlist | link | code',
  toolbar_mode:'sliding', convert_urls:false,
  content_style:'body{font-family:Inter,system-ui,sans-serif;font-size:13px;line-height:1.5}'
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

      // Convert correct[] to correct_index integer
      var hiddenIdx = document.createElement('input');
      hiddenIdx.type = 'hidden';
      hiddenIdx.name = 'correct_index';
      hiddenIdx.value = parseInt(chk[0].value);
      this.appendChild(hiddenIdx);

      this.submit();
    }, true);
  }
}

var currentEditIds = [];

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
    return '<input type="hidden" name="choices[' + i + '][id]" value="' + c.id + '">' +
      '<div class="flex items-start gap-2 mb-3">' +
        '<div class="flex-1">' +
          '<textarea name="choices[' + i + '][text]" id="' + chIds[i] + '" rows="2" class="w-full border rounded px-2 py-1 text-sm"></textarea>' +
          (c.img ? '<img src="/storage/' + c.img + '" loading="lazy" class="my-1 max-w-[80px] border rounded"/>' : '') +
          '<input type="file" name="choices[' + i + '][image]" accept="image/*" class="w-full border rounded px-2 py-1 bg-white text-xs mt-1"/>' +
        '</div>' +
        '<label class="flex items-center gap-1 mt-1 text-sm whitespace-nowrap">' +
          '<input type="checkbox" name="correct[]" value="' + i + '" ' + (c.ok ? 'checked' : '') + '/> Correct' +
        '</label>' +
      '</div>';
  }).join('');

  document.getElementById('edit-body').innerHTML =
    '<form id="edit-form" action="/quizzes/' + QID + '/questions/' + q.id + '" method="POST" enctype="multipart/form-data" class="space-y-4" novalidate>' +
      '<input type="hidden" name="_token" value="' + CSRF + '">' +
      '<input type="hidden" name="_method" value="PUT">' +
      '<div><label class="block text-sm font-medium mb-1">Question Text</label>' +
        '<textarea name="question_text" id="' + qtId + '" rows="4" class="w-full border rounded px-3 py-2 text-sm"></textarea></div>' +
      '<div class="grid grid-cols-2 gap-3">' +
        '<div><label class="block text-sm font-medium mb-1">Type</label>' +
          '<select name="question_type" class="w-full border rounded px-3 py-2 text-sm">' +
            '<option value="multiple_choice"' + (q.type==='multiple_choice'?' selected':'') + '>Multiple Choice</option>' +
            '<option value="true_false"' + (q.type==='true_false'?' selected':'') + '>True/False</option>' +
            '<option value="short_answer"' + (q.type==='short_answer'?' selected':'') + '>Short Answer</option>' +
          '</select></div>' +
        '<div><label class="block text-sm font-medium mb-1">Replace Image</label>' +
          (q.img ? '<img src="/storage/' + q.img + '" loading="lazy" class="mb-1 max-w-[80px] border rounded"/>' : '') +
          '<input type="file" name="question_image" accept="image/*" class="w-full border rounded px-2 py-1 bg-white text-xs"/></div>' +
      '</div>' +
      '<div><label class="block text-sm font-medium mb-2">Choices</label>' + chHtml + '</div>' +
      '<div class="grid grid-cols-2 gap-3">' +
        '<div><label class="block text-sm font-medium mb-1">Explanation</label>' +
          '<textarea name="correct_description" id="' + expId + '" rows="3" class="w-full border rounded px-3 py-2 text-sm"></textarea></div>' +
        '<div><label class="block text-sm font-medium mb-1">Notes</label>' +
          '<textarea name="notes" id="' + notesId + '" rows="3" class="w-full border rounded px-3 py-2 text-sm"></textarea></div>' +
      '</div>' +
      '<div class="text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Save</button></div>' +
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

    // Convert correct[] checkbox to correct_index integer that the controller expects
    var correctIndex = parseInt(chk[0].value);
    var hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'correct_index';
    hidden.value = correctIndex;
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
    title:'Delete this question?', text:'Cannot be undone.', icon:'warning',
    showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6b7280',
    confirmButtonText:'Delete', reverseButtons:true
  }).then(function(r) { if (r.isConfirmed) document.getElementById('df' + id).submit(); });
}

document.getElementById('edit-modal').addEventListener('click', function(e) {
  if (e.target === this) closeEdit();
});
</script>
</body>
</html>
