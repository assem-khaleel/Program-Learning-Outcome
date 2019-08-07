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
                            href="{{route('institution.index')}}">{{trans('institutions.institutions')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('institutions.institutions') }} </h4>

                        @if($institutions->isEmpty())
                        <a href="{{route('institution.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('institutions.createInstitution')}}</a>
                            @endif
                    </div><br>
{{--                    @if($institutions->isNotEmpty())--}}
{{--                    <div class="col-md-12">--}}
{{--                        <form action="{{route('searchInstitution')}}" method="get">--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="search" class="form-control" name="search_name_en" placeholder="Name(en)" id="search" >--}}
{{--                                <input type="search" class="form-control" name="search_name_ar" placeholder="Name(ar)" id="search" >--}}
{{--                                <span class="input-group-prepend">--}}
{{--                                  <button type="submit" class="btn btn-info">Search</button>--}}
{{--                                  <button type="submit" class="btn btn-danger">Reset</button>--}}
{{--                              </span>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    @endif--}}
                    <div class="card-body">

                        @if ($institutions->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('institutions.thereAreNoInstitutions')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.nameEn') }}</th>
                                        <th>{{trans('common.nameAr') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($institutions as $institution)
                                        <tr>

                                            <td>{{$institution->name_en}}</td>
                                            <td>{{$institution->name_ar}}</td>


                                            <td class="text-nowrap text-center">
                                                <a href="{{route('institution.edit', [$institution->id])}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

{{--                                                <a href="javascript:void(0);" class="sa-warning"--}}
{{--                                                   data-id="{{ $institution->id }}"--}}
{{--                                                   data-toggle="tooltip"--}}
{{--                                                   data-original-title="{{trans('common.delete')}}"><i--}}
{{--                                                            class="fa fa-trash"--}}
{{--                                                            style="margin: 5px"></i></a>--}}

{{--                                                <form style="display: inline-block;" method="POST"--}}
{{--                                                      id="id-{{ $institution->id }}"--}}
{{--                                                      action="{{route('institution.destroy', $institution->id)}}">--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    @csrf--}}
{{--                                                </form>--}}
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
                            {{$institutions->links()}}
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

