<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Institutions\InstitutionRequest;
use App\Models\Settings\Institution;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstitutionController extends Controller
{
    /**
     * @var Institution
     */
    private $institution;

    /**
     * InstitutionController constructor.
     * @param Institution $institution
     */
    public function __construct(Institution $institution)
    {
        $this->institution = $institution;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $institutions = $this->institution->paginate(15);

        return view('settings.institutions.index')->with('institutions', $institutions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InstitutionRequest $request
     * @return Response
     */
    public function store(InstitutionRequest $request)
    {
        $this->institution->create($request->all());

        return redirect()->route('institution.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
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
        $institution = $this->institution->find($id);

        return view('settings.institutions.edit')->with('institution', $institution);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param InstitutionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(InstitutionRequest $request, $id)
    {
        $institution = $this->institution->find($id);

        if (!empty($institution)) {

            $institution->update($request->all());

            return redirect()->route('institution.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('institutions.notFoundInstitution')]);
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
