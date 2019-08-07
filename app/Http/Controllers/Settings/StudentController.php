<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;


use App\Http\Requests\Students\StudentsRequest;
use App\Models\Settings\Assignment;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Program;
use App\Models\Settings\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param Assignment $assignment
     * @param Course $course
     * @param CourseSection $courseSection
     * @param Student $student
     * @param Program $program
     */
    public function __construct(Assignment $assignment, Course $course, CourseSection $courseSection, Student $student, Program $program)
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
     * @return Response
     */
    public function index(Request $request)
    {
        $nameEn = $request->get('name_en');
        $program = $request->get('program');

        $students = $this->student->where('name_en', 'like', '%' . $nameEn . '%')
            ->whereHas('program', function ($query) use ($program) {
                $query->where('name_en', 'like', '%' . $program . '%');
            })
            ->paginate(15);
        return view('settings.students.index')->with('students', $students);
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
        $programs = $this->program->all();

        return view('settings.students.create')->with('courses', $courses)->with('courseSections', $courseSections)->with('programs', $programs);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StudentsRequest $request, $id = 0)
    {
        $this->student->create($request->all());

        return redirect()->route('student.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $student = $this->student->find($id);
        $courseSections = $this->courseSection->all();

        $courses = $this->course->all();
        $programs = $this->program->all();


        return view('settings.students.edit')->with('courses', $courses)->with('student', $student)->with('courseSections', $courseSections)->with('programs', $programs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(StudentsRequest $request, $id)
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
     * @param int $id
     * @return Response
     * @throws \Exception
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
