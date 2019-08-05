<?php

namespace App\Http\Controllers;

use App\Models\AssignmentEvaluation;
use App\Models\LearningOutcome;
use App\Models\Rubric;
use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

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
     * @var AssignmentEvaluation
     */
    private $assignmentEvaluation;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param CourseSection $courseSection
     * @param LearningOutcome $learningOutcome
     * @param Assignment $assignment
     * @param Student $student
     * @param Rubric $rubric
     * @param AssignmentEvaluation $assignmentEvaluation
     */
    public function __construct(Course $course, CourseSection $courseSection, LearningOutcome $learningOutcome, Assignment $assignment, Student $student, Rubric $rubric, AssignmentEvaluation $assignmentEvaluation)
    {
        $this->course = $course;
        $this->learningOutcome = $learningOutcome;
        $this->assignment = $assignment;
        $this->student = $student;
        $this->courseSection = $courseSection;
        $this->rubric = $rubric;
        $this->assignmentEvaluation = $assignmentEvaluation;
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
        $rubrics = $this->rubric->whereHas('assignments')->get();

        $countAssignments = $this->assignment->count();

        $students = $this->student->all();
        foreach ($assignments as $key => $assignment) {
            $countStudents = $assignment->courseSection->students->count();
            $countAssessmentEvaluations = $assignment->assessmentEvaluations->count();
            $countRubricIndicators = $assignment->rubric->rubricIndicators->count();
            $progress[$assignment->id] = $countAssessmentEvaluations ? (($countAssessmentEvaluations / $countRubricIndicators) / $countStudents) * 100 : 0;
        }
        if ($assignments->isNotEmpty()) {
            /** @var float $progress */
            $assignments->getCollection()->transform(function ($item) use ($progress) {
                $item['progress'] = round($progress[$item->id] ?? 0, 2);
                return $item;
            });
        }

        return view('dashboardStaff')->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)
          ->with('assignments', $assignments)->with('students', $students)->with('countAssignments', $countAssignments)
          ->with('rubrics', $rubrics);
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

            $progress[$assignment->id] = $countAssessmentEvaluations ? (($countAssessmentEvaluations / $countRubricIndicators) / $countStudents) * 100 : 0;
        }

        if ($assignments->isNotEmpty()){
            /** @var float $progress */
            $assignments->getCollection()->transform(function ($item) use ($progress) {
                $item['progress'] = round($progress[$item->id] ?? 0, 2);
                return $item;
            });
        }

        /** @var CourseSection $countStudent */
        return view('dashboardFaculty')->with('countStudent', $countStudent)->with('countCourses', $countCourses)->with('learningOutcomes', $learningOutcomes)->with('assignments', $assignments);
    }

    /**
     * @param Request $request
     * @return array|RedirectResponse
     * @throws Throwable
     */
    public function getRubric(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('home');
        }

       $currentRubric = $this->rubric->with('rubricIndicators')->find($request->rubric_id);

        if (!empty($currentRubric))
        {
            $rubricLevels = $this->assignmentEvaluation
                ->selectRaw('AVG(rubric_levels.percentage) as percentage')
                ->selectRaw('rubric_cells.indicator_id')
                ->join('rubric_cells', 'rubric_cells.id', '=', 'assignment_evaluations.rubric_cell_id')
                ->join('rubric_levels', 'rubric_levels.id', '=', 'rubric_cells.level_id')
                ->whereIn('rubric_cells.indicator_id', $currentRubric->rubricIndicators->pluck('id'))
                ->groupBy('rubric_cells.indicator_id')
                ->get();

            return ['html' => view('drawChart')->with('currentRubric', $currentRubric)->with('rubricLevels', $rubricLevels)->render()];
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('rubrics.notFoundRubric')]);
    }
}
