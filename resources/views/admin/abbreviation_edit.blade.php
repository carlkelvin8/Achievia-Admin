<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Abbreviation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dkyGRQbaseT/UST7he7OLeDChTJEjcLHpsHThH31wXWr9a9/pHBA+rdqhPHSB4uK9JnAal+T7OTVf0kGRyQ9YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-white min-h-screen flex items-center justify-center">
  <div class="max-w-xl w-full p-5 space-y-5">
    <div class="text-center">
      <h1 class="text-3xl font-bold text-black mb-4">Edit Abbreviation</h1>
    </div>

    <form class="space-y-6" method="POST" action="{{ route('abbreviations.update', $abbreviation->id) }}">
      @csrf
      @method('PUT')

      <!-- Subject -->
<div>
  <label for="subject_id" class="block text-sm font-medium text-black mb-1">Subject</label>
  <select id="subject_id" name="subject_id"
          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black shadow-sm">
      <option value="">-- Select Subject --</option>
      @foreach($subjects as $subject)
          <option value="{{ $subject->id }}" 
                  {{ old('subject_id', $abbreviation->subject_id) == $subject->id ? 'selected' : '' }}>
              {{ $subject->title }}
          </option>
      @endforeach
  </select>
  @error('subject_id')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
  @enderror
</div>

      <!-- Short Form -->
      <div>
        
        <label for="short_form" class="block text-sm font-medium text-black mb-1">Short Form</label>
        <input type="text" id="short_form" name="short_form" value="{{ old('short_form', $abbreviation->short_form) }}"
               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black shadow-sm"
               placeholder="e.g. BAP" />
        @error('short_form')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Full Form -->
      <div>
        <label for="full_form" class="block text-sm font-medium text-black mb-1">Full Form</label>
        <input type="text" id="full_form" name="full_form" value="{{ old('full_form', $abbreviation->full_form) }}"
               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black shadow-sm"
               placeholder="e.g. Blood Agar Plate" />
        @error('full_form')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Buttons -->
      <div class="flex justify-between items-center">
        <a href="{{ route('abbreviations.index') }}"
           class="text-sm font-semibold text-gray-700 hover:text-black">
          ← Back to List
        </a>
        <button type="submit"
                class="py-2 px-6 rounded-lg bg-black text-white font-semibold shadow-md hover:bg-gray-800 transition duration-200">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</body>
</html>
