<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 2/07/19
 * Time: 9:28 AM
 */
?>
@extends('layouts.app')
@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('learning-outcome.index')}}">{{trans('learningOutcome.learningOutcomes')}}</a>
                </li>
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
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title pull-left">{{trans('learningOutcome.learningOutcomes') }} </h4>
                        <a href="{{route('learning-outcome.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('learningOutcome.createLearningOutcome')}}
                        </a>
                    </div>
                    <div class="card-body">

                        @if ($learningOutcomes->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('learningOutcome.thereAreNoLearningOutcomes')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.nameEn') }}</th>
                                        <th>{{trans('common.nameAr') }}</th>
                                        <th>{{trans('common.descriptionEn') }}</th>
                                        <th>{{trans('common.descriptionAr') }}</th>
                                        <th>{{trans('programs.program') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($learningOutcomes as $learningOutcome)
                                        <tr>

                                            <td>{{$learningOutcome->name_en}}</td>
                                            <td>{{$learningOutcome->name_ar}}</td>
                                            <td>{{$learningOutcome->description_en}}</td>
                                            <td>{{$learningOutcome->description_ar}}</td>
                                            <td>{{$learningOutcome->program->name}}</td>

                                            <td class="text-nowrap text-center">
                                                <a href="{{route('learning-outcome.edit', [$learningOutcome->id])}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $learningOutcome->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="id-{{ $learningOutcome->id }}"
                                                      action="{{route('learning-outcome.destroy', $learningOutcome->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{$learningOutcomes->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

