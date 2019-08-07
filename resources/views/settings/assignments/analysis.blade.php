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
        <div class="col-md-7 align-self-center">
            <h3 class="text-themecolor">{{trans('assignment.analysisFor')}} {{$assignment->name." ". '-'. " "}} {{$assignment->courseSection->course->name." ". '-'. " "}} {{$assignment->rubric->name}}</h3>
        </div>
        <div class="col-md-5 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item active"><a
                        href="{{route('analysis', [$assignment->id])}}">{{trans('assignment.analysis')}}</a></li>
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
            <div class="col-12">

    <form method="post" action='{{route('storeAnalysis')}}' class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @include('settings.assignments.forms.anlysis')
    </form>

            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

