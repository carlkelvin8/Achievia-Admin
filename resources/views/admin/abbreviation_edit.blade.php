<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Edit Abbreviation</title>
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- TinyMCE (inline, no partial) --}}
  @php
    $tinyKey  = config('services.tiny.key', 'no-api-key');
    $useNoKey = app()->environment('local') && ($tinyKey === 'no-api-key' || empty($tinyKey));
  @endphp
  <script src="https://cdn.tiny.cloud/1/{{ $useNoKey ? 'no-api-key' : $tinyKey }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      if (!window.tinymce) return;
      tinymce.init({
        selector: 'textarea.rte-mini',
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
        height: 80,
        content_style: 'body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;line-height:1.55;} sub,sup{font-size:0.8em;}'
      });
      document.addEventListener('submit', function () {
        if (window.tinymce && tinymce.triggerSave) tinymce.triggerSave();
      }, true);
    });
  </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow space-y-6">
    <div class="text-center">
      <h1 class="text-2xl font-bold text-gray-900">Edit Abbreviation</h1>
      <p class="text-sm text-gray-500">Use <em>Italic</em>, <sub>sub</sub>, and <sup>sup</sup>.</p>
    </div>

    <form action="{{ route('abbreviations.update', $abbreviation->id) }}" method="POST" class="space-y-5">
      @csrf
      @method('PUT')

      <div>
        <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
        <select id="subject_id" name="subject_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none bg-white">
          @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ old('subject_id', $abbreviation->subject_id) == $subject->id ? 'selected' : '' }}>
              {{ $subject->title }}
            </option>
          @endforeach
        </select>
        @error('subject_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="short_form" class="block text-sm font-medium text-gray-700 mb-1">Short Form</label>
        <textarea id="short_form" name="short_form" class="rte-mini w-full border rounded min-h-[48px]">{{ old('short_form', $abbreviation->short_form) }}</textarea>
        @error('short_form') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="full_form" class="block text-sm font-medium text-gray-700 mb-1">Full Form</label>
        <textarea id="full_form" name="full_form" class="rte-mini w-full border rounded min-h-[48px]">{{ old('full_form', $abbreviation->full_form) }}</textarea>
        @error('full_form') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex justify-end gap-2">
        <a href="{{ route('abbreviations.index') }}" class="inline-block px-5 py-2 border border-gray-500 text-gray-700 rounded hover:bg-gray-100">Cancel</a>
        <button type="submit" class="px-5 py-2 bg-black text-white rounded hover:bg-gray-800 transition">Update</button>
      </div>
    </form>
  </div>
</body>
</html>