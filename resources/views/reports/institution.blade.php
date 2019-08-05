@extends('layouts.app')
@section('wrapper')

{{--    @php /** @var \Illuminate\Database\Eloquent\Collection \App\Models\LearningOutcome @endphp--}}


    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{route('report.institution')}}">{{trans('report.institutionReports')}}</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title pull-left">{{trans('report.institutionReports')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                <thead>
                                <tr>
                                    <th style="text-align: center">{{trans('colleges.college') }}</th>
                                    <th style="text-align: center">{{trans('departments.department') }}</th>
                                    <th style="text-align: center">{{trans('programs.program') }}</th>
                                    <th style="text-align: center">{{trans('learningOutcome.learningOutcome') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($colleges as $college)
                                    <tr>
                                        <td style="text-align: center">{{$college->name}}</td>
                                        <td style="text-align: center">{{count($college->departments)}}</td>
                                        <td style="text-align: center">{{count($college->programs)}}</td>
                                        @if(!empty($college->programs))
                                        <td style="text-align: center">{{ $plos->whereIn('program_id', $college->programs->pluck('id')->toArray())->count() }}</td>
                                            @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{$colleges->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
