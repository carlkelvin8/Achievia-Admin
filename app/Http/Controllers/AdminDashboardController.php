<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index() {
        $students = User::where('role', 'student')->count();
        $teachers = User::where('role', 'teacher')->count();
        $courses  = Course::count();
        $quizzes  = Quiz::count();
        $questions = Question::count();
        $subjects = Subject::count();

        // Recent students (last 10)
        $recentStudents = User::where('role', 'student')
            ->latest()
            ->limit(10)
            ->get();

        // Paginated students for the table
        $users = User::where('role', 'student')->latest()->paginate(20);

        // Monthly enrollment trend for current year
        $currentYear = now()->year;
        $enrollmentByMonth = User::where('role', 'student')
            ->whereYear('created_at', $currentYear)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill all 12 months (0 if no data)
        $monthLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $enrollmentData = [];
        for ($m = 1; $m <= 12; $m++) {
            $enrollmentData[] = $enrollmentByMonth[$m] ?? 0;
        }

        return view('admin.dashboard', compact(
            'users', 'students', 'teachers', 'courses',
            'quizzes', 'questions', 'subjects',
            'recentStudents', 'monthLabels', 'enrollmentData'
        ));
    }
}
