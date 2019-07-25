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
                        <h4 class="card-title" id="1">Students in Section</h4><br>
                        @foreach($students as $student)
                            <p>
                               {{$student->name_en}}
                            </p>
                            @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" id="1">evaluate the student</h4> <br>

                    </div>
                </div>
            </div>
        </div>

        </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

