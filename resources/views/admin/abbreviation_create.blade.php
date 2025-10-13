<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Abbreviation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dkyGRQbaseT/UST7he7OLeDChTJEjcLHpsHThH31wXWr9a9/pHBA+rdqhPHSB4uK9JnAal+T7OTVf0kGRyQ9YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow space-y-6">
    <div class="text-center">
      <h1 class="text-2xl font-bold text-gray-900">Add Abbreviation</h1>
      <p class="text-sm text-gray-500">Enter the shortened and full term below</p>
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
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none">
      <option value="">-- Select Subject --</option>
      @foreach($subjects as $subject)
          <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
              {{ $subject->title }}
          </option>
      @endforeach
  </select>
  @error('subject_id')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
  @enderror
</div>

      <div>
        <label for="short_form" class="block text-sm font-medium text-gray-700 mb-1">Short Form</label>
        <input type="text" id="short_form" name="short_form" required
               value="{{ old('short_form') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none" />
        @error('short_form')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="full_form" class="block text-sm font-medium text-gray-700 mb-1">Full Form</label>
        <input type="text" id="full_form" name="full_form" required
               value="{{ old('full_form') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none" />
        @error('full_form')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end gap-2">
        <a href="{{ route('abbreviations.index') }}"
           class="inline-block px-5 py-2 border border-gray-500 text-gray-700 rounded hover:bg-gray-100">
          Cancel
        </a>
        <button type="submit"
                class="px-5 py-2 bg-black text-white rounded hover:bg-gray-800 transition">
          Save
        </button>
      </div>
    </form>
  </div>
</body>
</html>
