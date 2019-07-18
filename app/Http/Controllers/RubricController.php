<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rubrics\RubricCellsRequest;
use App\Http\Requests\Rubrics\RubricRequest;
use App\Models\Rubric;
use App\Models\RubricCells;
use App\Models\RubricIndicators;
use App\Models\RubricLevels;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Rules\SumScoreValidation;

class RubricController extends Controller
{
    /**
     * @var Rubric
     */
    private $rubric;
    /**
     * @var RubricCells
     */
    private $cells;
    /**
     * @var RubricIndicators
     */
    private $indicators;
    /**
     * @var RubricLevels
     */
    private $levels;

    /**
     * RubricController constructor.
     * @param Rubric $rubric
     * @param RubricCells $cells
     * @param RubricIndicators $indicators
     * @param RubricLevels $levels
     */
    public function __construct(Rubric $rubric, RubricCells $cells, RubricIndicators $indicators, RubricLevels $levels)
    {
        $this->rubric = $rubric;
        $this->cells = $cells;
        $this->indicators = $indicators;
        $this->levels = $levels;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rubrics = $this->rubric->paginate(15);

        return view('rubrics.index')->with('rubrics', $rubrics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('rubrics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RubricRequest $request
     * @return Response
     */
    public function store(RubricRequest $request)
    {
        if (isset($request->saveContinue)) {
            $request->validate([
                'rows' => 'required|numeric',
                'columns' => 'required|numeric',
            ]);

        }

        $request->merge(['created_by' => auth()->id()]);
        $rubric = $this->rubric->create($request->all());

        if (isset($request->saveContinue)) {

            return redirect()->route('rubric.draw', ['rows' => $request->rows, 'columns' => $request->columns, 'rubricId' => $rubric->id]);

        }

        return redirect()->route('rubric.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);
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
        $rubric = $this->rubric->with(['rubricIndicators', 'rubricLevels'])->find($id);


        return view('rubrics.edit')->with('rubric', $rubric);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RubricCellsRequest $request
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function update(RubricCellsRequest $request, $id)
    {
        $sumScore = 0;
        foreach ($request->score as $key => $score) {
            $sumScore += $score;
        }

        if ($sumScore > 100 || $sumScore < 100) {
            $request->validate([
                'score' => [new SumScoreValidation],
            ]);
        }

        $rubric = $this->rubric->find($id);

        if (!empty($rubric)) {
            $rubric->update(['name' => $request->name, 'description' => $request->descriptionRubric, 'created_by' => auth()->id()]);
            foreach ($request->levels as $key => $level) {
                if (!empty($request->levelIds[$key])) {

                    $levelId = $request->levelIds[$key];
                    $levelCheck = $rubric->rubricLevels->find($levelId);
                    $levelCheck->update(['level' => $level, 'rubric_id' => $rubric->id, 'order' => $request->orderLevel[$key]]);
                    $levelsID[$key] = $levelId;

                } else {


                    $level = $this->levels->create(['level' => $level, 'rubric_id' => $rubric->id, 'order' => $request->orderLevel[$key]]);
                    $levelsID[$key] = $level->id;

                }
            }

            foreach ($request->indicators as $indicatorKey => $indicator) {
                if (!empty($request->indicatorIds[$indicatorKey])) {
                    $indicatorId = $request->indicatorIds[$indicatorKey];
                    $indicatorCheck = $rubric->rubricIndicators->find($indicatorId);
                    $indicatorCheck->update(['indicator' => $indicator, 'order' => $request->orderIndicator[$indicatorKey], 'score' => $request->score[$indicatorKey], 'rubric_id' => $rubric->id]);

                } else {

                    $indicator = $this->indicators->create(['indicator' => $indicator, 'order' => $request->orderIndicator[$indicatorKey], 'score' => $request->score[$indicatorKey], 'rubric_id' => $rubric->id]);
                    $indicatorId = $indicator->id;
                }


                foreach ($request->levels as $levelKey => $level) {
                    if (!empty($request->descriptionIds[$indicatorKey][$levelKey])) {
                        $descriptionId = $request->descriptionIds[$indicatorKey][$levelKey];
                        $cellCheck = $this->cells->find($descriptionId);
                        $cellCheck->update(['description' => $request->description[$indicatorKey][$levelKey], 'indicator_id' => $indicatorId, 'level_id' => $levelsID[$levelKey]]);
                    } else {

                        $this->cells->create(['description' => $request->description[$indicatorKey][$levelKey], 'indicator_id' => $indicatorId, 'level_id' => $levelsID[$levelKey]]);
                    }
                }

            }


            return redirect()->route('rubric.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);

        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('learningOutcome.notFoundLearningOutcome')]);
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
        $rubric = $this->rubric->find($id);

        if (!empty($rubric)) {
            $rubric->delete();
            return redirect()->route('rubric.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('learningOutcome.notFoundLearningOutcome')]);
    }

    /**
     * @param $rows
     * @param $columns
     * @param $rubricId
     * @return Factory|View
     */
    public function drawRubric($rows, $columns, $rubricId)
    {
        return view('rubrics.drawRubric')->with('rows', $rows)->with('columns', $columns)->with('rubricId', $rubricId);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addRow(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('home');
        }

        $rows = count($request->get('indicators'));
        $columns = count($request->get('levels'));

        $params['levels'] = $request->get('levels');
        $params['indicators'] = $request->get('indicators');
        $params['orderIndicator'] = $request->get('orderIndicator');
        $params['orderLevel'] = $request->get('orderLevel');
        $params['score'] = $request->get('score');
        $params['description'] = $request->get('description');
        $params['columns'] = $columns;
        $params['rows'] = ++$rows;

        return view('rubrics.forms.draw', $params);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addColumn(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('home');
        }

        $rows = count($request->get('indicators'));
        $columns = count($request->get('levels'));

        $params['levels'] = $request->get('levels');
        $params['indicators'] = $request->get('indicators');
        $params['orderIndicator'] = $request->get('orderIndicator');
        $params['orderLevel'] = $request->get('orderLevel');
        $params['score'] = $request->get('score');
        $params['description'] = $request->get('description');
        $params['columns'] = ++$columns;
        $params['rows'] = $rows;

        return view('rubrics.forms.draw', $params);
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function addRowUpdate($id, Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('home');
        }
        $rubric = $this->rubric->with(['rubricIndicators', 'rubricLevels'])->find($id);
        $row = $request->rows;
        $rows = ++$row;
        $columns = $request->columns;

        return view('rubrics.forms.drawUpdate')->with('rubric', $rubric)->with('rows', $rows)->with('columns', $columns);
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function addColumnUpdate($id, Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('home');
        }

        $rubric = $this->rubric->with(['rubricIndicators', 'rubricLevels'])->find($id);

        $column = $request->get('columns');
        $columns = ++$column;
        $rows = $request->rows;
        return view('rubrics.forms.drawUpdate')->with('rubric', $rubric)->with('columns', $columns)->with('rows', $rows);
    }

    /**
     * @param RubricCellsRequest $request
     * @return RedirectResponse
     */
    public function storeDrawRubric(RubricCellsRequest $request)
    {
        $sumScore = 0;
        foreach ($request->score as $key => $score) {
            $sumScore += $score;
        }

        if ($sumScore > 100 || $sumScore < 100) {
            $request->validate([
                'score' => [new SumScoreValidation],
            ]);
        }

        foreach ($request->levels as $key => $level) {
            $levels = $this->levels->create(['level' => $level, 'rubric_id' => $request->rubric_id, 'order' => $request->orderLevel[$key]]);
            $levelsID[$key] = $levels->id;
        }

        foreach ($request->indicators as $indicatorKey => $indicator) {
            $indicator = $this->indicators->create(['indicator' => $indicator, 'order' => $request->orderIndicator[$indicatorKey], 'score' => $request->score[$indicatorKey], 'rubric_id' => $request->rubric_id]);

            foreach ($request->levels as $levelKey => $level) {

                $this->cells->create(['description' => $request->description[$indicatorKey][$levelKey], 'indicator_id' => $indicator->id, 'level_id' => $levelsID[$levelKey]]);

            }
        }


        return redirect()->route('rubric.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteColumn(Request $request, $id)
    {
        $rubric = $this->rubric->find($id);
        /**  Delete Level*/
        $checkLevelDelete = $rubric->rubricLevels->pluck('id')->diff($request->levelIds);

        if (!empty($checkLevelDelete)) {
            foreach ($checkLevelDelete as $deleteLevel) {
                $deletedLevel = $this->levels->find($deleteLevel);
                if (!empty($deletedLevel)) {
                    $deletedLevel->delete();
                    foreach ($deletedLevel->rubricCells as $deletedCell) {
                        $deletedCell->delete();
                    }
                }
            }
        }

        return response()->json(true);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteRow(Request $request, $id)
    {
        $rubric = $this->rubric->find($id);
        /**  Delete Indicator*/
        $checkIndicatorDelete = $rubric->rubricIndicators->pluck('id')->diff($request->indicatorIds);
        if (!empty($checkIndicatorDelete)) {
            foreach ($checkIndicatorDelete as $deleteIndicator) {
                $deletedIndicator = $this->indicators->find($deleteIndicator);
                if (!empty($deletedIndicator)) {
                    $deletedIndicator->delete();
                    foreach ($deletedIndicator->rubricCells as $deleteCell) {
                        $deleteCell->delete();

                    }
                }
            }
        }

        return response()->json(true);
    }
}
