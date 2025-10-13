<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Mnemonic</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">
  <div class="max-w-xl w-full p-5 space-y-5">
    <div class="text-center">
      <h1 class="text-4xl font-bold text-black mb-2">Upload Mnemonic</h1>
    </div>
    <form class="space-y-6" method="POST" action="{{ route('mnemonics.store') }}" enctype="multipart/form-data">
      @csrf

      <!-- File -->
      <div>
        <label for="file_path" class="block text-sm font-medium text-black mb-2">File (Image or PDF)</label>
        <label for="file_path" 
               class="cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-black bg-gray-100 rounded-xl p-10 hover:border-black hover:bg-gray-200 transition-all">
          <svg xmlns="http://www.w3.org/2000/svg" 
               fill="none" viewBox="0 0 24 24" 
               stroke="currentColor" stroke-width="2" 
               class="w-10 h-10 text-gray-600 mb-2">
            <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <path d="M21 15l-5-5L5 21" />
          </svg>
          <span class="text-sm font-medium text-black">Click to select a file</span>
          <input type="file" id="file_path" name="file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" />
        </label>
        @error('file')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Title -->
      <div>
        <label for="title" class="block text-sm font-medium text-black mb-1">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter title"
               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black shadow-sm"
               value="{{ old('title') }}" />
        @error('title')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Description -->
      <div>
        <label for="description" class="block text-sm font-medium text-black mb-1">Description (Optional)</label>
        <textarea id="description" name="description" rows="4" placeholder="Add a brief explanation"
                  class="w-full px-2 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black shadow-sm">{{ old('description') }}</textarea>
        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Subject Dropdown -->
      <div>
        <label for="subject_id" class="block text-sm font-medium text-black mb-1">Subject</label>
        <select id="subject_id" name="subject_id"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black shadow-sm">
          <option value="">-- Select Subject --</option>
          @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
              {{ $subject->title }}
            </option>
          @endforeach
        </select>
        @error('subject_id')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit -->
      <button type="submit"
              class="w-full py-3 rounded-lg bg-black text-white font-semibold shadow-md hover:bg-gray-800 transition duration-200">
        Upload Mnemonic
      </button>

      <a href="{{ route('mnemonics.index') }}"
         class="block text-center w-full py-3 bg-white border border-black text-black font-semibold shadow-xl hover:bg-red-800 hover:text-white transition duration-200 rounded-lg">
        Discard
      </a>
    </form>
  </div>
</body>

<script>
  document.querySelectorAll('label[for="file_path"]').forEach(label => {
    label.addEventListener('dragover', e => e.preventDefault());
    label.addEventListener('drop', e => e.preventDefault());
  });
</script>
</html>
