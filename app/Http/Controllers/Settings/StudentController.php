<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;


use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Program;
use App\Models\Settings\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @var Assignment $assignment
     * @var Course

     */
    private $assignment;

    private $course;

    private $courseSection;

    private $student;

    private $program;

    /**
     * CollegeController constructor.
     * @param College $college
     */
    public function __construct(Assignment $assignment , Course $course , CourseSection $courseSection , Student $student, Program $program )
    {
        $this->assignment = $assignment;
        $this->course = $course;
        $this->courseSection = $courseSection;
        $this->student = $student;
        $this->program = $program;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->student->paginate(15);

        return view('settings.students.index')->with('students', $students);
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
        $programs = $this->program->all();

        return view('settings.students.create')->with('courses',$courses)->with('courseSections',$course_scetions)->with('programs',$programs);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->student->create($request->all());

        return redirect()->route('student.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->student->find($id);
        $course_scetions = $this->courseSection->all();

        $courses = $this->course->all();
        $programs = $this->program->all();


        return view('settings.students.edit')->with('courses', $courses)->with('student', $student)->with('courseSections',$course_scetions)->with('programs',$programs);
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
        $student = $this->student->find($id);

        if (!empty($student)) {

            $student->update($request->all());

            return redirect()->route('student.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('student.notFoundStudent')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = $this->student->find($id);

        if (!empty($student)) {
            $student->delete();
            return redirect()->route('student.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('student.notFoundStudent')]);
    }
}
