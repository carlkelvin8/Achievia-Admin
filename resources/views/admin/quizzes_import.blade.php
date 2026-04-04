<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Admin - Import Quiz</title>
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

    <!-- Main content -->
    <main class="flex-1 overflow-y-auto p-6">
      <!-- Header -->
      <section class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900">Import Quiz Questions</h2>
            <p class="text-sm text-gray-500 mt-1">Upload quiz questions in bulk using CSV format</p>
          </div>
          <div class="text-right">
            <a href="{{ route('quizzes.index') }}" class="text-gray-600 hover:text-gray-800 flex items-center justify-end">
              <i class="fas fa-arrow-left mr-2"></i>
              Back to Quizzes
            </a>
          </div>
        </div>
      </section>

      <!-- Status Messages -->
      @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6 flex items-start">
          <i class="fas fa-check-circle mr-3 text-lg mt-0.5"></i>
          <div>
            <h4 class="font-semibold">Import Successful!</h4>
            <p class="text-sm mt-1">{{ session('success') }}</p>
          </div>
        </div>
      @endif
      
      @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6 flex items-start">
          <i class="fas fa-exclamation-circle mr-3 text-lg mt-0.5"></i>
          <div>
            <h4 class="font-semibold">Import Failed</h4>
            <p class="text-sm mt-1">{{ session('error') }}</p>
          </div>
        </div>
      @endif

      <div class="grid lg:grid-cols-3 gap-6">
        <!-- Template Information -->
        <div class="lg:col-span-2">
          <section class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
              <i class="fas fa-file-csv mr-3 text-indigo-600"></i>
              CSV Template Format
            </h3>
            
            <p class="text-gray-600 text-sm mb-4">Your CSV file must include the following columns in this exact order:</p>
            
            <div class="space-y-2 mb-6">
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 text-xs font-bold mr-3 flex-shrink-0">1</span>
                <div>
                  <span class="font-semibold text-gray-800">quiz_title</span>
                  <p class="text-gray-600 text-xs">Title of the quiz (required)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-xs font-bold mr-3 flex-shrink-0">2</span>
                <div>
                  <span class="font-semibold text-gray-800">quiz_description</span>
                  <p class="text-gray-600 text-xs">Description of the quiz (optional)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 text-xs font-bold mr-3 flex-shrink-0">3</span>
                <div>
                  <span class="font-semibold text-gray-800">subject_id</span>
                  <p class="text-gray-600 text-xs">Subject ID number (required)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 text-xs font-bold mr-3 flex-shrink-0">4</span>
                <div>
                  <span class="font-semibold text-gray-800">module_id</span>
                  <p class="text-gray-600 text-xs">Module ID number (required)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 text-xs font-bold mr-3 flex-shrink-0">5</span>
                <div>
                  <span class="font-semibold text-gray-800">question_text</span>
                  <p class="text-gray-600 text-xs">The question text (required)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-xs font-bold mr-3 flex-shrink-0">6</span>
                <div>
                  <span class="font-semibold text-gray-800">question_type</span>
                  <p class="text-gray-600 text-xs">Type: multiple_choice, true_false, etc.</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 text-xs font-bold mr-3 flex-shrink-0">7</span>
                <div>
                  <span class="font-semibold text-gray-800">option_1, option_2, option_3, option_4</span>
                  <p class="text-gray-600 text-xs">Answer choices (at least 2 required)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-red-100 text-red-600 text-xs font-bold mr-3 flex-shrink-0">8</span>
                <div>
                  <span class="font-semibold text-gray-800">correct_choice_index</span>
                  <p class="text-gray-600 text-xs">Correct answer index: 0, 1, 2, or 3 (required)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-xs font-bold mr-3 flex-shrink-0">9</span>
                <div>
                  <span class="font-semibold text-gray-800">rationale</span>
                  <p class="text-gray-600 text-xs">Explanation for the correct answer (optional)</p>
                </div>
              </div>
              
              <div class="flex items-start p-3 bg-gray-50 rounded border border-gray-200">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-xs font-bold mr-3 flex-shrink-0">10</span>
                <div>
                  <span class="font-semibold text-gray-800">notes</span>
                  <p class="text-gray-600 text-xs">Additional notes or tags (optional)</p>
                </div>
              </div>
            </div>

            <!-- Important Notes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
              <h4 class="text-sm font-semibold text-yellow-800 mb-3 flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Important Notes
              </h4>
              <ul class="text-yellow-700 text-sm space-y-2">
                <li class="flex items-start">
                  <i class="fas fa-check mr-2 mt-0.5 text-xs"></i>
                  <span>Ensure your CSV follows the exact column order shown above</span>
                </li>
                <li class="flex items-start">
                  <i class="fas fa-check mr-2 mt-0.5 text-xs"></i>
                  <span>Both subject_id and module_id must exist in your system</span>
                </li>
                <li class="flex items-start">
                  <i class="fas fa-check mr-2 mt-0.5 text-xs"></i>
                  <span>Use 0-based indexing for correct_choice_index (0=first, 1=second, etc.)</span>
                </li>
                <li class="flex items-start">
                  <i class="fas fa-check mr-2 mt-0.5 text-xs"></i>
                  <span>Empty rows will be automatically skipped</span>
                </li>
              </ul>
            </div>
          </section>
        </div>

        <!-- Upload Form -->
        <div>
          <section class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
              <i class="fas fa-cloud-upload-alt mr-3 text-indigo-600"></i>
              Upload CSV File
            </h3>
            
            <form action="{{ route('quiz.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
              @csrf
              
              <!-- File Upload Area -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Select File
                </label>
                <div class="flex justify-center px-6 pt-6 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors bg-gray-50 hover:bg-gray-100">
                  <div class="space-y-2 text-center">
                    <i class="fas fa-file-csv text-4xl text-gray-400 mb-2"></i>
                    <div class="flex text-sm text-gray-600">
                      <label for="csv-upload" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                        <span>Choose file</span>
                        <input id="csv-upload" name="csv" type="file" accept=".csv,.txt" required class="sr-only" onchange="displayFileName(this)">
                      </label>
                      <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">CSV or TXT (Max: 10MB)</p>
                    <p id="file-name" class="text-sm text-indigo-600 font-semibold mt-2"></p>
                  </div>
                </div>
              </div>

              <!-- Download Templates -->
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                  Download Template
                </label>
                <a href="{{ route('quiz.template', ['type' => 'sample']) }}" class="w-full inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                  <i class="fas fa-download mr-2"></i>
                  With Sample Data
                </a>
                <a href="{{ route('quiz.template', ['type' => 'blank']) }}" class="w-full inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                  <i class="fas fa-file-alt mr-2"></i>
                  Blank Template
                </a>
              </div>

              <!-- Submit Button -->
              <button id="import-btn" type="submit" class="w-full bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                <i class="fas fa-upload mr-2"></i>
                Import Questions
              </button>
            </form>
          </section>
        </div>
      </div>
    </main>
  </div>

  <script>
    function displayFileName(input) {
      const fileName = input.files[0]?.name;
      const fileSize = input.files[0]?.size;
      const fileNameDisplay = document.getElementById('file-name');
      
      if (fileName) {
        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
        fileNameDisplay.innerHTML = `
          <i class="fas fa-check-circle mr-1"></i>
          ${fileName} (${sizeInMB} MB)
        `;
      }
    }

    document.querySelector('form').addEventListener('submit', function () {
      const btn = document.getElementById('import-btn');
      btn.disabled = true;
      btn.innerHTML = '<svg class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Importing...';

      // Show overlay
      document.getElementById('import-overlay').classList.remove('hidden');
    });
  </script>

  <!-- Loading overlay -->
  <div id="import-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl p-8 flex flex-col items-center max-w-sm w-full mx-4">
      <svg class="animate-spin h-12 w-12 text-indigo-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
      </svg>
      <h3 class="text-lg font-semibold text-gray-900 mb-1">Importing Questions</h3>
      <p class="text-sm text-gray-500 text-center">Processing your CSV file. Large imports may take a moment — please don't close this page.</p>
    </div>
  </div>
</body>
</html>
