<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Programs\ProgramsRequest;
use App\Models\Settings\Department;
use App\Models\Settings\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    /**
     * @var Program
     */
    private $program;
    /**
     * @var Department
     */
    private $department;

    /**
     * ProgramController constructor.
     * @param Program $program
     * @param Department $department
     */
    public function __construct(Program $program, Department $department)
    {
        $this->program = $program;
        $this->department = $department;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $programs = $this->program->paginate(15);

        return view('settings.programs.index')->with('programs', $programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $departments = $this->department->all();

        return view('settings.programs.create')->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProgramsRequest $request
     * @return Response
     */
    public function store(ProgramsRequest $request)
    {
        $this->program->create($request->all());

        return redirect()->route('program.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $program = $this->program->find($id);

        $departments = $this->department->all();

        return view('settings.programs.edit')->with('departments', $departments)->with('program', $program);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProgramsRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ProgramsRequest $request, $id)
    {
        $program = $this->program->find($id);

        if (!empty($program)) {

            $program->update($request->all());

            return redirect()->route('program.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('department.notFoundDepartment')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
