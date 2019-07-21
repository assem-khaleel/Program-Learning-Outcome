@extends('layouts.app')
@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item active"><a
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
        @error('score')
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{trans('common.warning')}}</strong> {{ $message }}
        </div>
    @enderror
        <div id="errorTable">

        </div>
    <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title pull-left">{{trans('rubrics.createRubric')}} </h4>
                        <div class="text-right">
                            <button class="btn-sm btn-info" data-toggle="tooltip" title="{{trans('common.addRow')}}" onclick="addRow()"><i class="fa fa-plus"></i>
                            </button>
                            <button class="btn-sm btn-info" data-toggle="tooltip" title="{{trans('common.addColumn')}}" onclick="addColumn()"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="rubric-area">
                        <form method="post" action='{{route('rubric.storeDrawRubric')}}' class="form-horizontal" id="rubric-form">
                            @csrf
                            <div id="rubric">
                                @include('rubrics.forms.draw')
                            </div>
                            <input name="rubric_id" type="hidden" value="{{$rubricId}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->

@endsection
@push('script')
    <script>
        function addRow() {
            $.ajax({
                url: '{{ route('rubric.row') }}',
                type : 'post',
                data: $('#rubric-form').serialize(),
                success: function (results) {
                    $('#rubric').html(results);
                }
            })
        }

        function addColumn() {
            $.ajax({
                url: '{{ route('rubric.column') }}',
                type : 'post',
                data: $('#rubric-form').serialize(),
                success: function (results) {
                    console.log(results);
                    $('#rubric').html(results);
                }
            })
        }
    </script>
@endpush