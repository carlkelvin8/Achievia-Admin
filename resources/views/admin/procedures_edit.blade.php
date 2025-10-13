<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Procedure</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">
  <div class="max-w-xl w-full p-6 space-y-6">
    <h1 class="text-3xl font-bold mb-4">Edit Procedure</h1>

    <form method="POST" action="{{ route('procedures.update', $procedure->id) }}" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      
      <div class="mb-4">
    <label for="subject_id" class="block text-gray-700">Subject</label>
    <select name="subject_id" id="subject_id" class="w-full border rounded p-2">
        <option value="">-- Select Subject --</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" 
                {{ $procedure->subject_id == $subject->id ? 'selected' : '' }}>
                {{ $subject->title }}
            </option>
        @endforeach
    </select>
</div>


      <!-- Title -->
      <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $procedure->title) }}" 
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-black" required>
        @error('title')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- File -->
      <div>
        <label class="block text-sm font-medium mb-1">File (optional)</label>
        <input type="file" name="file" class="w-full border rounded px-4 py-2">
        @if($procedure->file)
          <p class="mt-2 text-gray-600 text-sm">Current File: 
            <a href="{{ asset('storage/' . $procedure->file) }}" target="_blank" class="underline text-blue-600">
              {{ basename($procedure->file) }}
            </a>
          </p>
        @endif
        @error('file')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Buttons -->
      <div class="text-right">
        <button type="submit" class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800">Update</button>
        <a href="{{ route('procedures.index') }}" class="ml-2 px-5 py-2 border border-gray-500 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
