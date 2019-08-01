@extends('layouts.app')
@section('wrapper')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
            </ol>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-success"><i class="ti-book"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 countCourses">{{$countCourses}}</h3>
                                <h5 class="text-muted m-b-0" data-toggle="tooltip" data-placement="bottom"
                                    title="{{trans('courses.courses')}}">{{trans('courses.courses')}}</h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-info"><i class="ti-bookmark"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 countPlos">{{$learningOutcomes->count()}}</h3>
                                <h5 class="text-muted m-b-0" data-toggle="tooltip" data-placement="bottom"
                                    title="{{trans('learningOutcome.learningOutcomes')}}">{{trans('learningOutcome.plos')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-danger"><i class="ti-user"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 countStudents">{{$countStudent}}</h3>
                                <h5 class="text-muted m-b-0" data-toggle="tooltip" data-placement="bottom"
                                    title="{{trans('student.students')}}">{{trans('student.students')}}</h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-success"><i class="ti-check-box"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 countAssignments">{{$assignments->count()}}</h3>
                                <h5 class="text-muted m-b-0" data-toggle="tooltip" data-placement="bottom"
                                    title="{{trans('assignment.assignments')}}">{{trans('assignment.assignments')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
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
                                <th>{{trans('assignment.assignment')}}</th>
                                <th>{{trans('courses.course')}}</th>
                                <th>course section</th>
                                <th>Number of students</th>
                                <th>{{trans('common.progress')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assignments as $assignment)
                                <tr>
                                    <td>{{$assignment->name}}</td>
                                    <td>{{$assignment->courseSection->course->name}}</td>
                                    <td>{{$assignment->courseSection->code}}</td>
                                    <td>{{$assignment->courseSection->students->count()}}</td>
                                    <td>
                                        <div class="chart easy-pie-chart-2"
                                             data-percent="{{$assignment->progress ?? 0}}">
                                            <span class="percent">{{$assignment->progress ?? 0}}</span></div>
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
{{--                        {{$assignments->links()}}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    @push('head')
        <link href="{{asset('assets/plugins/css-chart/css-chart.css')}}" rel="stylesheet">

    @endpush

    @push('script')
        <script src="{{asset('assets/plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
        <script>
            !function ($) {
                "use strict";

                var EasyPieChart = function () {
                };

                EasyPieChart.prototype.init = function () {
                    //initializing various types of easy pie charts

                    $('.easy-pie-chart-2').easyPieChart({
                        easing: 'easeOutBounce',
                        barColor: '#00c292',
                        lineWidth: 3,
                        trackColor: false,
                        lineCap: 'butt',
                        onStep: function (from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent));
                        }
                    });

                },
                    //init
                    $.EasyPieChart = new EasyPieChart, $.EasyPieChart.Constructor = EasyPieChart
            }(window.jQuery),

                //initializing
                function ($) {
                    "use strict";
                    $.EasyPieChart.init()
                }(window.jQuery);

            $({Counter: 0}).animate({
                Counter: $('.countCourses').text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function () {
                    $('.countCourses').text(Math.ceil(this.Counter));
                }
            });

            $({Counter: 0}).animate({
                Counter: $('.countPlos').text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function () {
                    $('.countPlos').text(Math.ceil(this.Counter));
                }
            });

            $({Counter: 0}).animate({
                Counter: $('.countStudents').text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function () {
                    $('.countStudents').text(Math.ceil(this.Counter));
                }
            });

            $({Counter: 0}).animate({
                Counter: $('.countAssignments').text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function () {
                    $('.countAssignments').text(Math.ceil(this.Counter));
                }
            });
        </script>
    @endpush


@endsection
