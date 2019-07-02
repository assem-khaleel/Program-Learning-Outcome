<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Departments\DepartmentRequest;
use App\Models\Settings\College;
use App\Models\Settings\Department;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * @var Department
     */
    private $department;
    /**
     * @var College
     */
    private $college;

    /**
     * DepartmentController constructor.
     * @param Department $department
     * @param College $college
     */
    public function __construct(Department $department, College $college)
    {
        $this->department = $department;
        $this->college = $college;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $departments = $this->department->paginate(15);

        return view('settings.departments.index')->with('departments', $departments);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $colleges = $this->college->all();

        return view('settings.departments.create')->with('colleges', $colleges);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return void
     */
    public function store(DepartmentRequest $request)
    {
        $this->department->create($request->all());

        return redirect()->route('department.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $department = $this->department->find($id);

        $colleges = $this->college->all();

        return view('settings.departments.edit')->with('department', $department)->with('colleges', $colleges);
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
        $department = $this->department->find($id);

        if (!empty($department)) {

            $request->validate([
                'name_en' => "required|unique:departments,name_en,$id,id,college_id," . $request->get('college_id'),
                'name_ar' => "required|unique:departments,name_ar,$id,id,college_id," . $request->get('college_id'),
                'college_id' => 'required|numeric',
            ]);

            $department->update($request->all());

            return redirect()->route('department.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('department.notFoundDepartment')]);
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
        $department = $this->department->find($id);

        if (!empty($department)) {
            $department->delete();
            return redirect()->route('department.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('department.notFoundDepartment')]);
    }
}
