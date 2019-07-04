<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Courses\CourseSectionRequest;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Semester;
use App\Models\Settings\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
     * CourseSectionController constructor.
     * @param CourseSection $courseSection
     * @param User $user
     * @param Course $course
     * @param Semester $semester
     */
    public function __construct(CourseSection $courseSection, User $user, Course $course, Semester $semester)
    {
        $this->courseSection = $courseSection;
        $this->user = $user;
        $this->course = $course;
        $this->semester = $semester;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courseSections = $this->courseSection->paginate(15);

        return view('settings.courseSections.index')->with('courseSections', $courseSections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $teachers = $this->user->all();
        $courses = $this->course->all();
        $semesters = $this->semester->all();

        return view('settings.courseSections.create')->with('teachers', $teachers)->with('courses', $courses)->with('semesters', $semesters);
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

        return redirect()->route('course-section.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $courseSection = $this->courseSection->find($id);
        $teachers = $this->user->all();
        $courses = $this->course->all();
        $semesters = $this->semester->all();

        return view('settings.courseSections.edit')->with('courseSection', $courseSection)->with('teachers', $teachers)->with('courses', $courses)->with('semesters', $semesters);
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
        $courseSection = $this->courseSection->find($id);

        if (!empty($courseSection)) {

            $courseSection->update($request->all());

            return redirect()->route('course-section.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('courseSections.notFoundCourseSection')]);
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
        $courseSection = $this->courseSection->find($id);

        if (!empty($courseSection)) {
            $courseSection->delete();
            return redirect()->route('course-section.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('courseSections.notFoundCourseSection')]);
    }
}
