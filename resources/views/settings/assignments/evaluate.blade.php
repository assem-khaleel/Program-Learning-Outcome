<?php
/**
 * Created by PhpStorm.
 * User: Assem
 * Date: 17/07/19
 * Time: 11:28 AM
 */
?>
@extends('layouts.app')
@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor"> {{$assignment->name." ". '-'. " "}} {{$courseSections->code}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item active"><a
                        href="{{route('assignment.index')}}">{{trans('assignment.assignments')}}</a></li>
                <li class="breadcrumb-item active"><a
                        href="{{route('evaluate', [$assignment->id])}}">{{trans('assignment.evaluate')}}</a></li>
            </ol>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" id="1">{{trans('assignment.studentsInSection')}}</h4><br>
                        @foreach($students as $student)
                            <p>
                                <a href="{{route('assignment.studentEvaluate', ['id '=> $assignment->id, 'studentId' => $student->id])}}"
                                   class="nav-link {{!empty($studentCurrent) && ($studentCurrent->id == $student->id) ? 'active' : 'btn-secondary'}}">{{$student->name_en}}</a>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(!empty($studentCurrent))
                            <h4 class="card-title">{{trans('assignment.evaluateTheStudent') . $studentCurrent->name_en}}</h4>
                            <form method="post" action="{{route('assignment.assigmentEvaluation')}}"
                                  class="form-horizontal" id="rubric-form-update">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table
                                                class="table color-bordered-table purple-bordered-table deleteColumns"
                                                id="rubric-table">
                                                <thead>
                                                <tr>
                                                    <th>{{trans('common.name')}}</th>
                                                    @php $count = 0 @endphp
                                                    @foreach($assignment->rubric->rubricLevels->sortBy('order') as $keyLevel => $level)
                                                        <th>
                                                            <div class="col-md-12">
                                                                <label id="level-{{$keyLevel}}" type="text"
                                                                       class="form-control form-control-sm">
                                                                    {{ $level->level }}
                                                                </label>

                                                            </div>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($assignment->rubric->rubricIndicators->sortBy('order') as $keyIndicator => $indicator)
                                                    <tr>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label id="indicator-{{$keyIndicator}}" type="text"
                                                                           class="form-control form-control-sm">
                                                                        {{ $indicator->indicator }}
                                                                    </label>
                                                                    <label id="score-{{$keyIndicator}}" type="text"
                                                                           class="form-control form-control-sm">
                                                                        {{  $indicator->score }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @foreach($assignment->rubric->rubricLevels->sortBy('order') as $keyLevel => $level)
                                                            @php $cell = $cells->where('level_id', $level->id)->where('indicator_id', $indicator->id)->first() @endphp
                                                            <td>
                                                                <div class="col-md-12 m-b-0">
                                                                    <div class="form-group row">
                                                                        {{ $cell->description ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <input type="radio"
                                                                       class="with-gap radio-col-teal col-md-2"
                                                                       id="radio-{{ $cell->id  }}"
                                                                       name="cells[{{ $keyIndicator }}]"
                                                                       value="{{$cell->id}}" {{ $assignment->assessmentEvaluations->where('rubric_cell_id', $cell->id)->where('student_id', $studentCurrent->id)->where('assessment_id', $assignment->id)->isNotEmpty() ? 'checked=checked' : ''}}>
                                                                <label for="radio-{{ $cell->id}}"></label>
                                                                @error('cells.'.$keyLevel)
                                                                <small
                                                                    class="form-control-feedback text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>
                                                @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input name="studentId" type="hidden"
                                                           value="{{ $studentCurrent->id }}">
                                                    <input name="assessmentId" type="hidden"
                                                           value="{{ $assignment->id }}">
                                                    <button type="submit"
                                                            class="btn btn-linkedin">{{trans('common.update') }}</button>

                                                    <a href="{{route('rubric.index')}}"
                                                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ============================================================== -->
                                    <!-- End PAge Content -->
                                    <!-- ============================================================== -->
                                </div>
                            </form>
                        @else
                            <div class="text-center">{{trans('assignment.pleaseSelectStudent ')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

