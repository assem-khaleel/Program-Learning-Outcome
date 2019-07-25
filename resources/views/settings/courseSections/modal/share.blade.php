<div class="modal fade" id="student-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{trans('assignment.shareAssignment')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <form id="students-form"  action='{{route('storeStudents')}}' class="form-horizontal" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="student_id" class="control-label col-md-2">{{ trans('student.students') }}</label><br>
                            <div  class="col-md-10">
                                <select id="student_id" class="category form-control {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id">
                                    <option value="">{{ trans('student.students') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name_en }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('student_id'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('student_id')}}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="course_section_id" value="{{ $courseSection->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit"
                                                class="btn btn-linkedin">{{trans('common.save')}}</button>
                                        <a href="{{route('students',['id'=> $courseSection->id ])}}"
                                           class="btn btn-danger"> {{trans('common.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

@push('script')
<script type="text/javascript">
    @if (count($errors) > 0)
    $('#student-modal').modal('show');
    @endif
</script>


@endpush



