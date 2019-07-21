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
                        <h4 class="card-title pull-left ">{{trans('rubrics.editRubric')}} </h4>

                        <div class="text-right">
                            <button class="btn-sm btn-info" data-toggle="tooltip" title="{{trans('common.addRow')}}"
                                    onclick="addRow()"><i class="fa fa-plus"></i>
                            </button>
                            <button class="btn-sm btn-info" data-toggle="tooltip" title="{{trans('common.addColumn')}}"
                                    onclick="addColumn()"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="rubric-area">
                        <form method="post" action="{{route('rubric.update',[$rubric->id])}}"
                              class="form-horizontal" id="rubric-form-update">
                            @csrf
                            @method('PUT')
                            <div id="rubricUpdate">
                                @include('rubrics.forms.drawUpdate')
                            </div>
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
    <script type="text/javascript">
        var rowCounter = 0;

        $('body').on('click', 'input.deleteRow', function () {
            var rowCount = document.getElementById('rubric-table').rows.length;
            if (rowCount > 2) {
                $(this).parents('tr').remove();
                $('#rubric-rows').val($('#rubric-rows').val() - 1);
                var id = $(this).closest('tr').data('id');

                $('#myModal').data('id', id).modal('show');
                $('#btnDeleteYes').click(function () {
                    $.ajax({
                        url: '{{ route('rubric.deleteRow',[$rubric->id]) }}',
                        type: 'post',
                        data: $('#rubric-form-update').serialize(),

                    });
                    var id = $('#myModal').data('id');
                    $('[data-id=' + id + ']').remove();
                    $('#myModal').modal('hide');
                });

            } else {
                $("#errorTable").addClass('alert alert-danger');
                var html = ' <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                    '<strong>\n' +
                    '{{trans('common.notDeleteLastRow')}}' +
                    '      </strong>';
                $("#errorTable").append(html);
            }
        });
        var columnCount = 0;
        $('body').on('click', 'input.deleteColumn', function () {
            var columnCount = $("#rubric-table").find('tr')[0].cells.length;
            if (columnCount > 2) {
                var index = $(this).parents('th').index() + 1;
                $(".deleteColumns thead tr th:nth-child(" + index + ")").remove();
                $(".deleteColumns tbody tr td:nth-child(" + index + ")").remove();
                $('#rubric-columns').val($('#rubric-columns').val() - 1);
                var id = $(this).closest('tr').data('id');
                $('#myModal').data('id', id).modal('show');
                $('#btnDeleteYes').click(function () {
                    $.ajax({
                        url: '{{ route('rubric.deleteColumn',[$rubric->id]) }}',
                        type: 'post',
                        data: $('#rubric-form-update').serialize(),
                    });
                    var id = $('#myModal').data('id');
                    $('[data-id=' + id + ']').remove();
                    $('#myModal').modal('hide');
                });

            } else {
                $("#errorTable").addClass('alert alert-danger');
                var html = ' <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                    '<strong>\n' +
                    '{{trans('common.notDeleteLastColumn')}}' +
                    '      </strong>';
                $("#errorTable").append(html);

            }
        });

        $('#btnDeleteNo').click(function () {

            window.location = '{{route('rubric.edit', $rubric->id)}}';

        });

        function addRow() {
            $.ajax({
                url: '{{ route('rubric.rowUpdate',[$rubric->id]) }}',
                type: 'post',
                data: $('#rubric-form-update').serialize(),
                success: function (results) {
                    $('#rubricUpdate').html(results);
                }
            })
        }

        function addColumn() {
            $.ajax({
                url: '{{ route('rubric.columnUpdate',[$rubric->id]) }}',
                type: 'post',
                data: $('#rubric-form-update').serialize(),
                success: function (results) {
                    $('#rubricUpdate').html(results);
                }
            })
        }

        // $('input.btnDelete').on('click', function (e) {
        //     e.preventDefault();
        //     var id = $(this).closest('tr').data('id');
        //     $('#myModal').data('id', id).modal('show');
        // });

        // $('#btnDelteYes').click(function () {
        //     var id = $('#myModal').data('id');
        //     $('[data-id=' + id + ']').remove();
        //     $('#myModal').modal('hide');
        // });
    </script>
@endpush
