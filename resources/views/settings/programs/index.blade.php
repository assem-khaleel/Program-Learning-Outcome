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
                            href="{{route('program.index')}}">{{trans('programs.programs')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('programs.programs') }} </h4>
                        <a href="{{route('program.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('programs.createProgram')}}</a>
                    </div><br>
                    @if($programs->isNotEmpty())
                        <div class="col-md-12">
                            <form action="{{route('program.index')}}" method="get">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="name_en" placeholder="Name English" id="search" value="{{request('name_en')}}">
                                    <input type="search" class="form-control" name="name_ar" placeholder="Name Arabic" id="search" value="{{request('name_ar')}}" >
                                    <input type="search" class="form-control" name="department" placeholder="Department" id="search" value="{{request('department')}}" >

                                    <span class="input-group-prepend">
                                                      <button type="submit" class="btn btn-info">Search</button>
                                                        <a href="{{ route('program.index') }}" class="btn btn-danger">Reset</a>
                                                  </span>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="card-body">

                        @if ($programs->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('programs.thereAreNoPrograms')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.nameEn') }}</th>
                                        <th>{{trans('common.nameAr') }}</th>
                                        <th>{{trans('programs.department') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($programs as $program)
                                        <tr>

                                            <td>{{$program->name_en}}</td>
                                            <td>{{$program->name_ar}}</td>
                                            <td>{{$program->department->name}}</td>

                                            <td class="text-nowrap text-center">
                                                <a href="{{route('program.edit', [$program->id])}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $program->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="id-{{ $program->id }}"
                                                      action="{{route('program.destroy', $program->id)}}">
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
                            {{$programs->links()}}
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

