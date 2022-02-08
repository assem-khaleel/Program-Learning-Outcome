<?php
/**
 * Created by PhpStorm.
 * User: Assem
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
                        href="{{route('course.index')}}">{{trans('courses.courses')}}</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('course-section.show',[$courseSection->id])}}">{{trans('courseSections.courseSections')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('student.students') }} </h4>
                        <button class="pull-right btn-sm btn btn-info" data-target="#student-modal" data-toggle="modal">
                            <span class="btn-label"><i class="fa fa-plus"></i></span> {{trans('student.addStudent')}}
                        </button>
                    </div>
                    <div class="card-body">

                        @if ($courseSection->students->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('student.thereAreNoStudents')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.nameEn') }}</th>
                                        <th>{{trans('programs.programs') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courseSection->students as $student)
                                        <tr>
                                            <td>{{$student->name_en}}</td>
                                            <td>{{$student->program->name}}</td>
                                            <td class="text-nowrap text-center">

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $student->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="id-{{ $student->id }}"
                                                      action="{{route('deleteStudents')}}">
                                                    <input type="hidden" name="course_section_id" value="{{$courseSection->id}}">
                                                    <input type="hidden" name="student_id" value="{{$student->id}}" >
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
                </div>
            </div>
        </div>
        @include('settings.courseSections.modal.share')
    </div>
@endsection
