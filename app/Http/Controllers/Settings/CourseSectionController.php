<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Courses\CourseSectionRequest;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Semester;
use App\Models\Settings\Student;
use App\Models\Settings\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CourseSectionController extends Controller
{
    /**
     * @var CourseSection
     */
    private $courseSection;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Course
     */
    private $course;
    /**
     * @var Semester
     */
    private $semester;
    /**
     * @var Student
     */
    private $student;

    /**
     * CourseSectionController constructor.
     * @param CourseSection $courseSection
     * @param User $user
     * @param Course $course
     * @param Semester $semester
     * @param Student $student
     */
    public function __construct(CourseSection $courseSection, User $user, Course $course, Semester $semester,Student $student)
    {
        $this->courseSection = $courseSection;
        $this->user = $user;
        $this->course = $course;
        $this->semester = $semester;
        $this->student = $student;
    }


    /**
     * @param $id
     * @return View
     */
    public function show($id)
    {
        $courseSection = $this->courseSection->whereCourseId($id)->with('course')->paginate(15);
        $course = $this->course->find($id);

        return view('settings.courseSections.show')->with('courseSection', $courseSection)->with('course', $course);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $courseId
     * @return Response
     */
    public function create($courseId)
    {
        $teachers = $this->user->all();
        $course = $this->course->find($courseId);
        $semesters = $this->semester->all();

        return view('settings.courseSections.create')->with('teachers', $teachers)->with('course', $course)->with('semesters', $semesters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseSectionRequest $request
     * @return Response
     */
    public function store(CourseSectionRequest $request)
    {
        $this->courseSection->create($request->all());

        return redirect()->route('course-section.show', [$request->course_id])->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $courseSection = $this->courseSection->find($id);
        $teachers = $this->user->all();
        $course = $this->course->find($courseSection->course_id);
        $semesters = $this->semester->all();

        return view('settings.courseSections.edit')->with('courseSection', $courseSection)->with('teachers', $teachers)->with('course', $course)->with('semesters', $semesters);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseSectionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CourseSectionRequest $request, $id)
    {
        /** @var courseSection $courseSection */
        $courseSection = $this->courseSection->find($id);

        if (!empty($courseSection)) {

            $courseSection->update($request->all());

            return redirect()->route('course-section.show', [$courseSection->course_id])->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('courseSections.notFoundCourseSection')]);
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
        $courseSection = $this->courseSection->find($id);

        if (!empty($courseSection)) {
            $courseSection->delete();
            return redirect()->route('course-section.show', [$courseSection->course_id])->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('courseSections.notFoundCourseSection')]);
    }

    public function students($id){

        $courseSection = $this->courseSection->find($id);
        $students = $this->student->all();
        return view('settings.courseSections.students')->with('courseSection', $courseSection)->with('students', $students);
    }

    public function storeStudents(Request $request)
    {
        /** @var CourseSection $courseSection */
        $courseSection = $this->courseSection->find($request->get('course_section_id'));
        $studentId = $request->get('student_id');
        $courseSection->students()->attach([$studentId]);

        return redirect()->route('students', ['id' => $courseSection->id])->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    public function deleteStudents(Request $request)
    {
        $courseSection = $this->courseSection->find($request->get('course_section_id'));
        $studentId = $request->get('student_id');
        $courseSection->students()->detach([$studentId]);

        return redirect()->route('students', ['id' => $courseSection->id])->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);

    }

}
