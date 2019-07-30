<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Analysis\AnalysisRequest;
use App\Models\AssignmentEvaluation;
use App\Models\Rubric;
use App\Models\RubricAnalysis;
use App\Models\RubricCells;
use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Http\Requests\Assignments\AssignmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Student;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AssignmentController extends Controller
{

    /**
     * @var Assignment $assignment
     */
    private $assignment;
    /**
     * @var Course
     */
    private $course;
    /**
     * @var CourseSection
     */
    private $courseSection;
    /**
     * @var Student
     */
    private $student;
    /**
     * @var Rubric
     */
    private $rubric;
    /**
     * @var RubricCells
     */
    private $rubricCell;
    /**
     * @var AssignmentEvaluation
     */
    private $assigmentEvaluations;
    /**
     * @var RubricAnalysis
     */
    private $analysis;

    /**
     * CollegeController constructor.
     * @param Assignment $assignment
     * @param Course $course
     * @param CourseSection $courseSection
     * @param Student $student
     * @param Rubric $rubric
     * @param RubricCells $rubricCell
     * @param AssignmentEvaluation $assignmentEvaluations
     * @param RubricAnalysis $analysis
     */
    public function __construct(Assignment $assignment, Course $course, CourseSection $courseSection, Student $student, Rubric $rubric, RubricCells $rubricCell, AssignmentEvaluation $assignmentEvaluations, RubricAnalysis $analysis)
    {
        $this->assignment = $assignment;
        $this->course = $course;
        $this->courseSection = $courseSection;
        $this->student = $student;
        $this->rubric = $rubric;
        $this->rubricCell = $rubricCell;
        $this->assigmentEvaluations = $assignmentEvaluations;
        $this->analysis = $analysis;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $assignments = $this->assignment->paginate(15);

        return view('settings.assignments.index')->with('assignments', $assignments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $courses = $this->course->all();
        $courseSections = $this->courseSection->all();
        $rubrics = $this->rubric->all();

        return view('settings.assignments.create')->with('courses', $courses)->with('courseSections', $courseSections)->with('rubrics', $rubrics);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssignmentRequest $request
     * @return Response
     */
    public function store(AssignmentRequest $request)
    {
        $request['created_by'] = Auth::user()->id;

        $this->assignment->create($request->all());

        return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $assignment = $this->assignment->find($id);
        if (!empty($assignment))
        {
            $courseSections = $this->courseSection->all();
            $courses = $this->course->all();
            $rubrics = $this->rubric->all();

            return view('settings.assignments.edit')->with('courses', $courses)->with('assignment', $assignment)->with('courseSections', $courseSections)->with('rubrics', $rubrics);
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $assignment = $this->assignment->find($id);

        if (!empty($assignment)) {

            $assignment->update($request->all());

            return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $assignment = $this->assignment->find($id);

        if (!empty($assignment)) {
            $assignment->delete();
            return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);

    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function toogle($id)
    {
        $assignment = $this->assignment->find($id);
        if (!empty($assignment)) {
            $assignment->published = !$assignment->published;

            $assignment->save();

            if ($assignment->published) {

                return redirect()->back()->with('message', ['type' => 'success', 'text' => trans('common.updatePublished')]);
            } else {
                return redirect()->back()->with('message', ['type' => 'success', 'text' => trans('common.updateUNPublished')]);

            }
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);
    }

    /**
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function evaluate($id)
    {
        $assignment = $this->assignment->find($id);
        if (!empty($assignment)) {

            return view('settings.assignments.evaluate')->with('assignment', $assignment);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);
    }

    /**
     * @param $id
     * @param $studentId
     * @return Factory|View
     */
    public function studentEvaluate($id, $studentId)
    {
        /** @var Assignment $assignment */
        $assignment = $this->assignment->find($id);
        $studentCurrent = $this->student->find($studentId);
        if (!empty($assignment) && !empty($studentCurrent)) {
            $cells = $this->rubricCell->whereHas('rubricIndicator', function ($query) use ($assignment) {
                $query->where('rubric_id', $assignment->rubric_id);
            })->get();

            return view('settings.assignments.evaluate')
                ->with('assignment', $assignment)
                ->with('studentCurrent', $studentCurrent)
                ->with('courseSections', $assignment->courseSection)
                ->with('cells', $cells)
                ->with('students', $assignment->courseSection->students);

        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function assigmentEvaluations(Request $request)
    {
        /** @var Assignment $assignment */
        $assignment = $this->assignment->find($request->assignmentId);
        $studentCurrent = $this->student->find($request->studentId);
        if (!empty($assignment) && !empty($studentCurrent))
        {
            $assigmentEvaluations = $this->assigmentEvaluations->whereAssignmentsId($request->assignmentId)->whereStudentId($request->studentId)->get();
            if (!empty($assigmentEvaluations))
            {
                foreach ($assigmentEvaluations as $keyEvaluation => $evaluation)
                    $assignmentEvaluationIds[$keyEvaluation] = $evaluation->id;
            }
            foreach ($request->get('cells') as $key => $cell)
            {

                if (count($request->get('cells')) > $assigmentEvaluations->count())
                {
                    $checkAssigmentEvaluations = $this->assigmentEvaluations->whereAssignmentsId($request->assignmentId)->whereStudentId($request->studentId)->whereRubricCellId($cell)->first();
                    if (!isset($checkAssigmentEvaluations))
                    {
                        $this->assigmentEvaluations->create(['assignments_id' => $request->assignmentId, 'student_id' => $request->studentId, 'rubric_cell_id' => $cell]);

                    } else {
                        /** @var array $assignmentEvaluationIds */
                        $assigmentEvaluation = $this->assigmentEvaluations->find($checkAssigmentEvaluations->id);
                        $assigmentEvaluation->update(['assignments_id' => $request->assignmentId, 'student_id' => $request->studentId, 'rubric_cell_id' => $cell]);

                    }
                } elseif ($assigmentEvaluations->isEmpty()) {
                    dd('rtgrtg');

                    $this->assigmentEvaluations->create(['assignments_id' => $request->assignmentId, 'student_id' => $request->studentId, 'rubric_cell_id' => $cell]);

                } else {
                    /** @var array $assignmentEvaluationIds */
                    $assigmentEvaluation = $this->assigmentEvaluations->find($assignmentEvaluationIds[$key]);
                    $assigmentEvaluation->update(['assignments_id' => $request->assignmentId, 'student_id' => $request->studentId, 'rubric_cell_id' => $cell]);
                }
            }

            return redirect()->route('evaluate', $request->assignmentId)
                ->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('assignment.notFoundAssignment')]);
    }


    public function analysis($id){

        $assignment = $this->assignment->findOrFail($id);

        $rubric = $assignment->rubric;

        $analysis = $this->analysis->assignment;

        return view('settings.assignments.analysis')->with('rubric',$rubric)->with('assignment',$assignment)->with('analysis',$analysis);
    }

    public function storeAnalysis(AnalysisRequest $request)
    {
        $this->analysis->create($request->all());

        return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    public function editAnalysis($id)
    {
        $assignment = $this->assignment->findOrFail($id);

        $rubric = $assignment->rubric;

        $analysis = $this->analysis->where('assignment_id',$assignment->id)->first();;

        return view('settings.assignments.editanalysis')->with('assignment',$assignment)->with('analysis',$analysis)->with('rubrics',$rubric);
    }

    public function updateAnalysis(AnalysisRequest $request, $id)
    {
        $assignment = $this->assignment->findOrFail($id);

        $analysis = $this->analysis->where('assignment_id',$assignment->id)->first();;

        if (!empty($analysis)){
            $analysis->update($request->all());
        }

        return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }
}
