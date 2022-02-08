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
                        href="{{route('report')}}">{{trans('report.studentReports')}}</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title pull-left">{{trans('report.reports')}}</h4>
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">{{trans('student.students') }}</th>
                                        <th style="text-align: center">{{trans('courses.courses') }}</th>
                                        <th style="text-align: center">assignment evaluations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td style="text-align: center">{{$student->name_en}}</td>
                                            <td style="text-align: center">{{count($student->CourseSections)}}</td>
                                            <td style="text-align: center">{{count($student->assigmentEvaluations)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{$students->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
