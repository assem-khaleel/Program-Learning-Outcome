<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use App\Models\Rubric;
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
     * @var Rubric
     */
    private $rubric;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param CourseSection $courseSection
     * @param LearningOutcome $learningOutcome
     * @param Assignment $assignment
     * @param Student $student
     * @param Rubric $rubric
     */
    public function __construct(Course $course, CourseSection $courseSection, LearningOutcome $learningOutcome, Assignment $assignment, Student $student, Rubric $rubric)
    {
        $this->course = $course;
        $this->learningOutcome = $learningOutcome;
        $this->assignment = $assignment;
        $this->student = $student;
        $this->courseSection = $courseSection;
        $this->rubric = $rubric;
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
        $assignments = $this->assignment->with('assessmentEvaluations')->with('courseSection')->whereHas('courseSection')->paginate(15);
        $countCourses = $this->course->all()->count();
        $learningOutcomes = $this->learningOutcome->all();

        $countCoursesMonthly = $this->course->whereMonth('created_at' , Carbon::now()->month)->count();
        $countLearningOutcomesMonthly = $this->learningOutcome->whereMonth('created_at' , Carbon::now()->month)->count();
        $countAssignmentsMonthly = $this->assignment->whereMonth('created_at' , Carbon::now()->month)->count();
        $countRubricsMonthly = $this->rubric->whereMonth('created_at' , Carbon::now()->month)->count();

        $countAssignments = $this->assignment->count();

        $students = $this->student->all();
        foreach ($assignments as $key => $assignment) {
            $countStudents = $assignment->courseSection->students->count();

            $countAssessmentEvaluations = $assignment->assessmentEvaluations->count();

            $countRubricIndicators = $assignment->rubric->rubricIndicators->count();

            $progress[$assignment->id] = $countRubricIndicators ? (($countAssessmentEvaluations / $countRubricIndicators) / $countStudents) * 100 : 0;
        }
        if ($assignments->isNotEmpty()){
            /** @var float $progress */
            $assignments = $this->assignment->get()->map(function ($item) use ($progress) {
                $item['progress'] = round($progress[$item->id] ?? 0, 2);
                return $item;
            });
        }else{
            $countStudent = 0;
        }

        return view('dashboardStaff')->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)
            ->with('assignments', $assignments)->with('students', $students)->with('countAssignments', $countAssignments)
            ->with('countCoursesMonthly', $countCoursesMonthly)->with('countLearningOutcomesMonthly', $countLearningOutcomesMonthly)
            ->with('countAssignmentsMonthly', $countAssignmentsMonthly)->with('countRubricsMonthly', $countRubricsMonthly);
    }

    /**
     * @return mixed
     */
    public function dashboardFaculty()
    {
        $countCourses = $this->course->whereHas('courseSection', function ($query) {
            $query->whereTeacherId(auth()->id());
        })->count();

        $assignments = $this->assignment->with('assessmentEvaluations')->with('courseSection')->whereHas('courseSection', function ($query){
            $query->where('teacher_id', auth()->id());
        })->paginate(15);

        $learningOutcomes = $this->learningOutcome->all();
        $courseSections = $this->courseSection->whereTeacherId(auth()->id())->with('students')->whereHas('students')->get();
        if ($courseSections->isNotEmpty())
        {
            foreach($courseSections as $courseSection)
            {
                $countStudent = $courseSection->students->count();

            }
        }else{
            $countStudent = 0;
        }

        /** @var Assignment $assignments */
        foreach($assignments as $assignment)
        {
            $countStudents = $assignment->courseSection->students->count();

            $countAssessmentEvaluations = $assignment->assessmentEvaluations->count();

            $countRubricIndicators = $assignment->rubric->rubricIndicators->count();

            $progress[$assignment->id] = (($countAssessmentEvaluations / $countRubricIndicators) / $countStudents) * 100;
        }

        if ($assignments->isNotEmpty()){
            /** @var float $progress */
            $assignments = $this->assignment->with('assessmentEvaluations')->with('courseSection')->whereHas('courseSection', function ($query){
                $query->where('teacher_id', auth()->id());
            })->get()->map(function ($item) use ($progress) {
                $item['progress'] = round($progress[$item->id] ?? 0, 2);
                return $item;
            });
        }

        /** @var CourseSection $countStudent */
        return view('dashboardFaculty')->with('countStudent', $countStudent)->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)->with('assignments', $assignments);
    }

}
