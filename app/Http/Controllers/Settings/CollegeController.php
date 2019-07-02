<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Colleges\CollegeRequest;
use App\Models\Settings\College;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * @var College
     */
    private $college;

    /**
     * CollegeController constructor.
     * @param College $college
     */
    public function __construct(College $college)
    {
        $this->college = $college;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $colleges = $this->college->paginate(15);

        return view('settings.colleges.index')->with('colleges', $colleges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CollegeRequest $request
     * @return Response
     */
    public function store(CollegeRequest $request)
    {
        $this->college->create($request->all());

        return redirect()->route('college.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $college = $this->college->find($id);

        return view('settings.colleges.edit')->with('college', $college);
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
        $college = $this->college->find($id);

        if (!empty($college)) {

            $request->validate([
                'name_en' => "required|unique:colleges,name_en,$id,id" ,
                'name_ar' => "required|unique:colleges,name_ar,$id,id" ,
            ]);

            $college->update($request->all());

            return redirect()->route('college.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('colleges.notFoundCollege')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy($id)
    {
        $college = $this->college->find($id);

        if (!empty($college)) {
            $college->delete();
            return redirect()->route('college.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('colleges.notFoundCollege')]);

    }
}
