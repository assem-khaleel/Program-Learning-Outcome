<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Analysis\AnalysisRequest;
use App\Models\Rubric;
use App\Models\RubricAnalysis;
use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Http\Requests\Assignments\AssignmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AssignmentController extends Controller
{

    /**
     * @var Assignment $assignment
     * @var Course

     */
    private $assignment;

    private $course;

    private $courseSection;

    private $student;

    private $rubric;

    private $analysis;

    /**
     * CollegeController constructor.
     * @param College $college
     */
    public function __construct(Assignment $assignment , Course $course , CourseSection $courseSection , Student $student,Rubric $rubric,RubricAnalysis $analysis)
    {
        $this->assignment = $assignment;
        $this->course = $course;
        $this->courseSection=$courseSection;
        $this->student = $student;
        $this->rubric = $rubric;
        $this->analysis = $analysis;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = $this->assignment->paginate(15);

        return view('settings.assignments.index')->with('assignments', $assignments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->course->all();
        $course_scetions = $this->courseSection->all();
        $rubrics = $this->rubric->all();

        return view('settings.assignments.create')->with('courses',$courses)->with('courseSections',$course_scetions)->with('rubrics',$rubrics);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request)
    {
        $request['created_by'] = Auth::user()->id;

        if (!empty($this->assignment)) {
            $this->assignment->create($request->all());
        }

        return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignment = $this->assignment->find($id);
        $course_scetions = $this->courseSection->all();

        $courses = $this->course->all();
        $rubrics = $this->rubric->all();


        return view('settings.assignments.edit')->with('courses', $courses)->with('assignment', $assignment)->with('courseSections',$course_scetions)->with('rubrics',$rubrics);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $assignment = $this->assignment->find($id);

        if (!empty($assignment)) {

            $assignment->update($request->all());

            return redirect()->route('assignment.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('course.notFoundCourse')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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


    public function publish(Assignment $assignment,CourseSection $courseSection,$id,Student $student,Request $request)
    {

        $assignment_id = $assignment->find($id);

        $assignment = $assignment>create($request->all($assignment_id));
        $course = $assignment->course;

        $students = $assignment->students->sync(array_filter($course));


            return ['status' => true, 'html' => view('assignments.modal.share')->with('assignments', $assignment)->with('students', $students)->with('courses', $course)->render()];
        }

    public function toogle($id)
    {
        $assignment = $this->assignment->findOrFail($id);

        $assignment->published = !$assignment->published;

        $assignment->save();

        if ($assignment->published) {

            return redirect()->back()->with('message', ['type' => 'success', 'text' => trans('common.updatePublished')]);
        } else{
            return redirect()->back()->with('message', ['type' => 'success', 'text' => trans('common.updateUNPublished')]);

        }

    }

    public function evaluate($id){

        $assignment = $this->assignment->findOrFail($id);

        $courseSections = $assignment->courseSection;


        $students = $assignment->courseSection->students ;

         $rubric = $this->rubric->where('id',$assignment->rubric_id)->get();



        return view('settings.assignments.evaluate')->with('assignment', $assignment)->with('assignment',$assignment)->with('courseSections',$courseSections)->with('students',$students)->with('rubrics',$rubric);

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
