<div class="modal fade" id="assignment-publish-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{trans('assignment.shareAssignment')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <form id="publish-form"  class="form-horizontal" method="post">
                    @csrf

                    @if(!empty($assignments))

                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table table-striped m-b-0"
                                   style="table-layout: fixed">
                                <thead>
                                <tr>
                                    <th width="15%">{{trans('assignment.Assignments')}}</th>

                                    @if(!empty($assignments->course) && $system->course != 0)
                                        <th width="25%">{{trans('assignment.Assignments')}}</th>
                                    @endif
{{--                                    @if(!empty($courses))--}}
{{--                                    @foreach($courses as $course)--}}
{{--                                            <th width="5%">{{$course->name}}</th>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}

{{--                                        @if(!empty($students))--}}
{{--                                        @foreach($students as $studnet)--}}
{{--                                        <th width="5%">{{$student->name}}</th>--}}
{{--                                        @endforeach--}}
{{--                                        @endif--}}

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignments as $assignment)
                                    @if ($assignment)

                                            <tr>
                                                    <td class="" width="15%"
                                                        rowspan="{{ $assignment->name }}"> {{$assignment->name}}</td>
{{--                                                <td class="" width="25%">{{$course->name}}</td>--}}
{{--                                                <td class="" width="25%">{{$student->name}}</td>--}}

                                            </tr>

                                    @endif

                                @endforeach


                                </tbody>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-linkedin">{{trans('common.save')}} </button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">{{trans('common.cancel')}}</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </table>
                        </div>

                    @endif

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>







