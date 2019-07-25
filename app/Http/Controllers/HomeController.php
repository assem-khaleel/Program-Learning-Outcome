<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Models\Settings\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var Course
     */
    private $course;
    /**
     * @var LearningOutcome
     */
    private $learningOutcome;
    /**
     * @var Assignment
     */
    private $assignment;
    /**
     * @var Student
     */
    private $student;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param LearningOutcome $learningOutcome
     * @param Assignment $assignment
     * @param Student $student
     */
    public function __construct(Course $course, LearningOutcome $learningOutcome, Assignment $assignment, Student $student)
    {
        $this->course = $course;
        $this->learningOutcome = $learningOutcome;
        $this->assignment = $assignment;
        $this->student = $student;
    }

    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index()
    {
        return $this->dashboardStaff();
//      return $this->dashboardFaculty();
    }

    /**
     * @return mixed
     */
    public function dashboardStaff()
    {
        $courses = $this->course->with('courseSection')->whereHas('courseSection.assignments', function ($query) {
            $query->with('assignments');
        })->paginate(15);

        $countCourses = $this->course->all()->count();
        $learningOutcomes = $this->learningOutcome->all();
        $assignments = $this->assignment->all();
        $students = $this->student->all();

        return view('dashboardStaff')->with('courses', $courses)->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)->with('assignments', $assignments)->with('students', $students);
    }

    /**
     * @return mixed
     */
    public function dashboardFaculty()
    {
        $courses = $this->course->with('courseSection')->whereHas('courseSection.assignments', function ($query) {
            $query->whereTeacherId(auth()->id());
            $query->with('assignments');
        })->paginate(15);

        $countCourses = $this->course->whereHas('courseSection', function ($query) {
            $query->whereTeacherId(auth()->id());
        })->count();

        $learningOutcomes = $this->learningOutcome->all();
        $assignments = $this->assignment->all();

        return view('dashboardFaculty')->with('courses', $courses)->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)->with('assignments', $assignments);
    }

}
