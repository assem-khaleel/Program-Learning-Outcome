<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearningOutcomes\LearningOutcomeRequest;
use App\Models\LearningOutcome;
use App\Models\Settings\Program;
use Illuminate\Http\Response;

class LearningOutcomeController extends Controller
{
    /**
     * @var LearningOutcome
     */
    private $learningOutcome;
    /**
     * @var Program
     */
    private $program;

    /**
     * LearningOutcomeController constructor.
     * @param LearningOutcome $learningOutcome
     * @param Program $program
     */
    public function __construct(LearningOutcome $learningOutcome, Program $program)
    {
        $this->learningOutcome = $learningOutcome;
        $this->program = $program;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $learningOutcomes = $this->learningOutcome->paginate(15);

        return view('learningOutcomes.index')->with('learningOutcomes', $learningOutcomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $programs = $this->program->all();

        return view('learningOutcomes.create')->with('programs', $programs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LearningOutcomeRequest $request
     * @return Response
     */
    public function store(LearningOutcomeRequest $request)
    {
        $this->learningOutcome->create($request->all());

        return redirect()->route('learning-outcome.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
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
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $learningOutcome = $this->learningOutcome->find($id);

        $programs = $this->program->all();

        return view('learningOutcomes.edit')->with('learningOutcome', $learningOutcome)->with('programs', $programs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LearningOutcomeRequest $request
     * @param int $id
     * @return Response
     */
    public function update(LearningOutcomeRequest $request, $id)
    {
        $learningOutcome = $this->learningOutcome->find($id);

        if (!empty($learningOutcome)) {

            $learningOutcome->update($request->all());

            return redirect()->route('learning-outcome.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('learningOutcome.notFoundLearningOutcome')]);
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
        $learningOutcome = $this->learningOutcome->find($id);

        if (!empty($learningOutcome)) {
            $learningOutcome->delete();
            return redirect()->route('learning-outcome.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('learningOutcome.notFoundLearningOutcome')]);
    }
}
