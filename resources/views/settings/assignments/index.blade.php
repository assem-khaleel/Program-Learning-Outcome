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
                            href="{{route('assignment.index')}}">{{trans('assignment.Assignments')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('assignment.Assignments') }} </h4>
                        <a href="{{route('assignment.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('assignment.createAssignment')}}</a>
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
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assignments as $assignment)
                                        <tr>

                                            <td>{{$assignment->name_en}}</td>
                                            <td>{{$assignment->name_ar}}</td>
                                            <td>{{$assignment->course->name}}</td>

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

                                                <a  class="share-assignment"
                                                   data-toggle="tooltip"
                                                   data-id-upload="{{ $assignment->id }}"
                                                   data-original-title="{{trans('assignment.publishSudents')}}"><i
                                                            class="fa fa-upload"
                                                            style="margin: 5px"></i></a>
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
    @include('settings.assignments.modal.share')


    @push('script')
<script>

        $(".share-assignment").click(function (e) {
            e.preventDefault();

            var $modal = $('#assignment-publish-modal');

            var assignment_id = $(this).data('id-upload');
            var course_id = $(this).data('id-upload');

            $modal.find('#publish-form').empty();
            $.ajax({
                url: '/assignment-publish/'+assignment_id,
                dataType:'json',
                success: function (e) {
                    console.log(e.length);
                    if(e.length===0){
                        $modal.find('#publish-form').append('<div class="col-lg-12 text-center h1">There is no assignment</div>');
                    }else{
                        $('#publish-form').html(e.html);
                        $('#assignment-publish-modal').modal('show');
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });

</script>

@endpush

@endsection








