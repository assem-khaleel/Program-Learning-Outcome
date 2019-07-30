<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
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
     * @var CourseSection
     */
    private $courseSection;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param CourseSection $courseSection
     * @param LearningOutcome $learningOutcome
     * @param Assignment $assignment
     * @param Student $student
     */
    public function __construct(Course $course, CourseSection $courseSection, LearningOutcome $learningOutcome, Assignment $assignment, Student $student)
    {
        $this->course = $course;
        $this->learningOutcome = $learningOutcome;
        $this->assignment = $assignment;
        $this->student = $student;
        $this->courseSection = $courseSection;
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
        $courseSections = $this->courseSection->with('course')->with('students')->with('assignments')->whereHas('assignments')->paginate(15);

        $countCourses = $this->course->all()->count();
        $learningOutcomes = $this->learningOutcome->all();
        $assignments = $this->assignment->all();
        $students = $this->student->all();

        return view('dashboardStaff')->with('courseSections', $courseSections)->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)->with('assignments', $assignments)->with('students', $students);
    }

    /**
     * @return mixed
     */
    public function dashboardFaculty()
    {
        $courseSections = $this->courseSection->with('course')->with('students')->with('assignments')->whereHas('assignments')->whereTeacherId(\Auth::id())->paginate(15);

        $countCourses = $this->course->whereHas('courseSection', function ($query) {
            $query->whereTeacherId(auth()->id());
        })->count();

        $learningOutcomes = $this->learningOutcome->all();
        $assignments = $this->assignment->all();

        return view('dashboardFaculty')->with('courseSections', $courseSections)->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)->with('assignments', $assignments);
    }

}
