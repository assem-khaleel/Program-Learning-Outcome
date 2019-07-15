<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Courses\CourseRequest;
use App\Models\Settings\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * @var Course
     */
    private $course;

    /**
     * CourseController constructor.
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = $this->course->paginate(15);

        return view('settings.courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return void
     */
    public function store(CourseRequest $request)
    {
        $this->course->create($request->all());

        return redirect()->route('course.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $course = $this->course->find($id);

        return view('settings.courses.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $course = $this->course->find($id);

        if (!empty($course)) {

            $course->update($request->all());

            return redirect()->route('course.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('courses.notFoundCourse')]);
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
        $course = $this->course->find($id);

        if (!empty($course)) {
            $course->delete();
            return redirect()->route('course.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('courses.notFoundCourse')]);
    }
}
