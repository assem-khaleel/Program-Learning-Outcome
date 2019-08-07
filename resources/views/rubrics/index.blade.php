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
                            href="{{route('rubric.index')}}">{{trans('rubrics.rubrics')}}</a>
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
                        <h4 class="card-title pull-left">{{trans('rubrics.rubrics') }} </h4>
                        <a href="{{route('rubric.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('rubrics.createRubric')}}
                        </a>
                    </div><br>
                    @if($rubrics->isNotEmpty())
                        <div class="col-md-12">
                            <form action="{{route('rubric.index')}}" method="get">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="name" placeholder="Name" id="search" value="{{request('name')}}">
                                    <input type="search" class="form-control" name="description" placeholder="Description" id="search" value="{{request('description')}}">
                                    <input type="search" class="form-control" name="created_by" placeholder="Created By" id="search" value="{{request('created_by')}}" >
                                    <span class="input-group-prepend">
                                                      <button type="submit" class="btn btn-info">Search</button>
                                                        <a href="{{route('rubric.index') }}" class="btn btn-danger">Reset</a>
                                                  </span>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="card-body">

                        @if ($rubrics->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('rubrics.thereAreNoRubrics')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.name') }}</th>
                                        <th>{{trans('common.description') }}</th>
                                        <th>{{trans('common.createdBy') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rubrics as $rubric)
                                        <tr>

                                            <td>{{$rubric->name}}</td>
                                            <td>{{$rubric->description}}</td>
                                            <td>{{$rubric->user->name}}</td>

                                            <td class="text-nowrap text-center">
                                                <a href="{{route('rubric.edit', [$rubric->id])}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $rubric->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="id-{{ $rubric->id }}"
                                                      action="{{route('rubric.destroy', $rubric->id)}}">
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
                            {{$rubrics->links()}}
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

