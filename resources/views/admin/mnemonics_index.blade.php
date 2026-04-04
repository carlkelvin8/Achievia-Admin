<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Admin - Mnemonics</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    @include('admin.sidebar')

    
    <main class="flex-1 overflow-y-auto p-6">



      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Mnemonics</h2>

        <form method="GET" action="{{ route('mnemonics.index') }}" class="mb-4 flex gap-2">
    <select name="subject_id" class="border px-3 py-2 rounded">
        <option value="">-- All Subjects --</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ ($subjectId ?? '') == $subject->id ? 'selected' : '' }}>
                {{ $subject->title }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Filter</button>
</form>
        <div class="text-right">
          <a class="bg-black text-white py-2 px-3 mt-5 text-sm rounded-2xl" href="{{ route('mnemonics.create') }}">
            Upload Mnemonic
          </a>
        </div>

        <div class="overflow-x-auto mt-5">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">File</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="relative px-6 py-3"></th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($mnemonics as $mnemonic)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if ($mnemonic->file_path)
                    <a href="{{ asset('storage/' . $mnemonic->file_path) }}" target="_blank" class="text-blue-600 underline">
                      View File
                    </a>
                  @else
                    <span class="text-gray-400 text-sm italic">No File</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $mnemonic->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $mnemonic->subject ? $mnemonic->subject->title : '—' }}</td>
                 
                <td class="px-6 py-4 text-sm text-gray-500">{{ $mnemonic->description ?? '—' }}</td>
                <td class="px-6 py-4 text-right text-sm font-medium">
                  <div class="relative inline-block text-left">
                    <button id="menu-button-{{ $mnemonic->id }}" type="button"
                      class="inline-flex justify-center w-full p-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-full focus:outline-none"
                      onclick="toggleDropdown({{ $mnemonic->id }})">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v.01M12 12v.01M12 18v.01" />
                      </svg>
                    </button>
                    <div id="dropdown-{{ $mnemonic->id }}"
                      class="hidden absolute right-0 mt-2 w-44 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg z-50">
                      <div class="py-1">
                        <a href="{{ route('mnemonics.edit', $mnemonic->id) }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                      </div>
                      <div class="py-1">
                        <form action="{{ route('mnemonics.destroy', $mnemonic->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                                  class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                            Delete
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
              @if ($mnemonics->isEmpty())
              <tr>
                <td colspan="4" class="text-center text-sm text-gray-500 py-6">No mnemonics uploaded yet.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>

  <script>
    function toggleDropdown(id) {
      document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
        if (el.id !== `dropdown-${id}`) el.classList.add('hidden');
      });
      document.getElementById(`dropdown-${id}`).classList.toggle('hidden');
    }

    window.addEventListener('click', function (e) {
      document.querySelectorAll('[id^="menu-button-"]').forEach(button => {
        const id = button.id.split('-').pop();
        const dropdown = document.getElementById(`dropdown-${id}`);
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
          dropdown.classList.add('hidden');
        }
      });
    });
  </script>
</body>
</html>
