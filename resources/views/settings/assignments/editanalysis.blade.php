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
                        href="{{route('editAnalysis', [$assignment->id])}}">{{trans('common.edit')}}
                    </a></li>
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

                <form id="editForm" method="post" action='{{route('updateAnalysis', [$assignment->id])}}' class="form-horizontal" >
                    @csrf
                    @method('PUT')

                    @include('settings.assignments.forms.anlysis')
                </form>

            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

@push('script')
    <script>
        @if(!$assignment->published)
        $("#editForm").click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $("#editForm").find("textarea").val("");
        });

        @endif


    </script>
@endpush

