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
                            href="{{route('assignment.index')}}">{{trans('assignment.assignments')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('assignment.assignments') }}</h4>
                        <a href="{{route('assignment.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('assignment.createAssignment')}}</a>
                    </div><br>
                    <div class="col-md-12">
                        <form action="{{route('assignment.index')}}" method="get" >
                            <div class="input-group">
                                <input type="search" class="form-control" name="search_assignment_en" placeholder="Assignment name(Eng)" id="search" value="{{request('search_assignment_en')}}" >
                                <input type="search" class="form-control" name="search_assignment_ar" placeholder="Assignment name(Ar)" id="search" value="{{request('search_assignment_ar')}}" >
                                <input type="search" class="form-control" name="search_course" placeholder="Assignment Course" id="search" value="{{request('search_course')}}" >
                                <input type="search" class="form-control" name="search_courseSection" placeholder="Assignment Course Section" id="search" value="{{request('search_courseSection')}}" >

                                <span class="input-group-prepend">
                                  <button type="submit" class="btn btn-info">Search</button>
                                   <a href="{{ route('assignment.index') }}" class="btn btn-danger">Reset</a>
                              </span>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if ($assignments->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('assignment.thereAreNoAssignments')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.nameEn') }}</th>
                                        <th>{{trans('common.nameAr') }}</th>
                                        <th>{{trans('assignment.course') }}</th>
                                        <th>{{trans('assignment.courseSection') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assignments as $assignment)
                                        <tr>
                                            <td>{{$assignment->name_en}}</td>
                                            <td>{{$assignment->name_ar}}</td>
                                            <td>{{$assignment->courseSection->course->name ?? '-'}}</td>
                                            <td class="text-center">{{$assignment->courseSection->code}}</td>

                                            <td class="text-nowrap text-center">
                                                <a href="{{route('assignment.edit', [$assignment->id])}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $assignment->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="id-{{ $assignment->id }}"
                                                      action="{{route('assignment.destroy', $assignment->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>


                                                <a href="{{route('publish', $assignment->id)}}" class="share-assignment"
                                                   data-toggle="tooltip"
                                                   data-id-upload="{{ $assignment->id }}"
                                                   data-original-title="{{$assignment->published ?trans('assignment.unpublishSudents'):trans('assignment.publishSudents')}}"><i
                                                            class=" fa fa-upload {{$assignment->published ? 'text-danger':''}}"
                                                            style="margin: 5px"></i></a>

                                                @if($assignment->published)

                                                <a  href="{{route('evaluate', $assignment->id)}}" class="share-assignment"
                                                    data-toggle="tooltip"
                                                    data-id-upload="{{ $assignment->id }}"
                                                    data-original-title="{{trans('assignment.evaluate')}}"><i
                                                            class="fa fa-check"
                                                            style="margin: 5px"></i></a>

                                                @if(!empty($assignment->analysis))
                                                    <a  href="{{route('editAnalysis', $assignment->id)}}" class="share-assignment btn btn-outline-info" style="padding: 0px"
                                                        data-toggle="tooltip"
                                                        data-id-upload="{{ $assignment->id }}"
                                                        data-original-title="{{trans('assignment.editAnalysis')}}"><i class="ti-settings" style="margin: 5px;color: green;border-color: green;background-color: #92da00"></i>
                                                    </a>
                                                    @else
                                                        <a  href="{{route('analysis', $assignment->id)}}" class="share-assignment btn btn-outline-info" style="padding: 0px"
                                                            data-toggle="tooltip"
                                                            data-id-upload="{{ $assignment->id }}"
                                                            data-original-title="{{trans('assignment.createAnalysis')}}"><i class="ti-settings" style="margin: 5px"></i>
                                                        </a>

                                                    @endif

                                                @endif
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
                            {{$assignments->links()}}
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








