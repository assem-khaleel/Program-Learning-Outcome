<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Semesters\SemesterRequest;
use App\Models\Settings\Semester;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SemesterController extends Controller
{
    /**
     * @var Semester
     */
    private $semester;

    /**
     * SemesterController constructor.
     * @param Semester $semester
     */
    public function __construct(Semester $semester)
    {
        $this->semester = $semester;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $semesters = $this->semester->paginate(15);

        return view('settings.semesters.index')->with('semesters', $semesters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.semesters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SemesterRequest $request
     * @return void
     */
    public function store(SemesterRequest $request)
    {
        $this->semester->create($request->all());

        return redirect()->route('semester.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $semester = $this->semester->find($id);

        return view('settings.semesters.edit')->with('semester', $semester);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SemesterRequest $request
     * @param int $id
     * @return Response
     */
    public function update(SemesterRequest $request, $id)
    {
        $semester = $this->semester->find($id);

        if (!empty($semester)) {

            $semester->update($request->all());

            return redirect()->route('semester.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('semesters.notFoundSemester')]);
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
        $semester = $this->semester->find($id);

        if (!empty($semester)) {
            $semester->delete();
            return redirect()->route('semester.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('semesters.notFoundSemester')]);
    }

    public function search(Request $request)
    {
        $nameEn = $request->get('name_en');
        $nameAr = $request->get('name_ar');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');



        $semesters = $this->semester->where('name_en','like','%'.$nameEn.'%')
            ->where('name_ar','like','%'.$nameAr.'%')
            ->where('start_date','like',$startDate.'%')
            ->where('end_date','like',$endDate.'%')
            ->paginate(15);

        return view('settings.semesters.index')->with('semesters', $semesters);
    }
}
