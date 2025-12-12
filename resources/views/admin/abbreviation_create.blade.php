<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Abbreviation</title>
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- TinyMCE (inline, no partial) --}}
  @php
    $tinyKey  = config('services.tiny.key', 'no-api-key');
    $useNoKey = app()->environment('local') && ($tinyKey === 'no-api-key' || empty($tinyKey));
  @endphp
  <script src="https://cdn.tiny.cloud/1/{{ $useNoKey ? 'no-api-key' : $tinyKey }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

  <style>
    /* Ensure the class-based fonts also render outside the editor */
    .font-sans { font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
    .font-serif { font-family: "Merriweather", Georgia, "Times New Roman", serif; }
    .font-mono { font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      if (!window.tinymce) return;

      tinymce.init({
        selector: 'textarea.rte-mini',
        menubar: false,
        branding: false,
        statusbar: false,
        plugins: 'link lists code fontfamily',
        toolbar: 'undo redo | bold italic underline | subscript superscript | fontfamily | bullist numlist | link | code',
        toolbar_mode: 'sliding',

        // SAFETY: only allow a tight set of elements + class attribute for span
        valid_elements: 'p,br,span[class],em/i,strong/b,u,sub,sup,small,ul,ol,li,a[href|title|target|rel],blockquote,code',
        convert_urls: false,

        // Font family choices that write CSS classes instead of inline styles
        font_family_formats: 'Sans=font-sans;Serif=font-serif;Mono=font-mono',
        formats: {
          fontfamily: [
            { title: 'Sans', inline: 'span', classes: 'font-sans' },
            { title: 'Serif', inline: 'span', classes: 'font-serif' },
            { title: 'Mono', inline: 'span', classes: 'font-mono' }
          ]
        },

        // Make it look compact
        height: 96,
        content_style: `
          body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;line-height:1.55;}
          sub,sup{font-size:0.8em;}
          .font-sans { font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
          .font-serif { font-family: "Merriweather", Georgia, "Times New Roman", serif; }
          .font-mono { font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; }
        `,

        // Links safer by default
        link_target_list: [{ title: 'New tab', value: '_blank' }, { title: 'None', value: '' }],
        link_default_target: '_blank',
        link_default_rel: 'noopener',

        // Ensure TinyMCE writes back to <textarea> before submit
        setup: (ed) => {
          const sync = () => { if (window.tinymce?.triggerSave) tinymce.triggerSave(); };
          ed.on('change input undo redo', sync);
          document.addEventListener('submit', sync, true);
        },
      });
    });
  </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow space-y-6">
    <div class="text-center">
      <h1 class="text-2xl font-bold text-gray-900">Add Abbreviation</h1>
      <p class="text-sm text-gray-500">
        Use <em>italic</em>, <sub>sub</sub>, <sup>sup</sup>, and pick a font (Sans/Serif/Mono) if needed.
      </p>
    </div>

    @if (session('success'))
      <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('abbreviation.store') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
        <select id="subject_id" name="subject_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none bg-white">
          <option value="">-- Select Subject --</option>
          @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
              {{ $subject->title }}
            </option>
          @endforeach
        </select>
        @error('subject_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="short_form" class="block text-sm font-medium text-gray-700 mb-1">Short Form</label>
        <textarea id="short_form" name="short_form" class="rte-mini w-full border rounded min-h-[48px]">{{ old('short_form') }}</textarea>
        @error('short_form') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="full_form" class="block text-sm font-medium text-gray-700 mb-1">Full Form</label>
        <textarea id="full_form" name="full_form" class="rte-mini w-full border rounded min-h-[48px]">{{ old('full_form') }}</textarea>
        @error('full_form') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex justify-end gap-2">
        <a href="{{ route('abbreviations.index') }}" class="inline-block px-5 py-2 border border-gray-500 text-gray-700 rounded hover:bg-gray-100">
          Cancel
        </a>
        <button type="submit" class="px-5 py-2 bg-black text-white rounded hover:bg-gray-800 transition">
          Save
        </button>
      </div>
    </form>
  </div>
</body>
</html>