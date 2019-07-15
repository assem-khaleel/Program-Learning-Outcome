<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label for="code" class="control-label col-md-2">{{ trans('common.code') }}</label>
                <div class="col-md-10">
                    <input id="code" name="code" type="text"
                           class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.code')}}"
                           value="{{ old('code', ($courseSection->code ?? '')) }}">
                    @error('code')
                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.teacher')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                            name="teacher_id"
                            data-placeholder="{{trans('courseSections.selectTeacher')}}">
                        <option value="">{{trans('courseSections.selectTeacher')}}</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}"
                                    {{old('teacher_id') == $teacher->id || !empty($courseSection->teacher_id) && ($teacher->id == $courseSection->teacher_id) ? 'selected' : '' }}>
                                {{$teacher->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.course')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                            name="course_id"
                            data-placeholder="{{trans('courseSections.selectCourse')}}">
                        <option value="">{{trans('courseSections.selectCourse')}}</option>
                        <option value="{{$course->id}}"
                                {{old('course_id') == $course->id || !empty($courseSection->course_id) && ($course->id == $courseSection->course_id) ? 'selected' : '' }}>
                            {{$course->name}}
                        </option>
                    </select>
                    @error('course_id')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.semester')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                            name="semester_id"
                            data-placeholder="{{trans('courseSections.selectSemester')}}">
                        <option value="">{{trans('courseSections.selectSemester')}}</option>
                        @foreach($semesters as $semester)
                            <option value="{{$semester->id}}"
                                    {{old('semester_id') == $semester->id || !empty($courseSection->semester_id) && ($semester->id == $courseSection->semester_id) ? 'selected' : '' }}>
                                {{$semester->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('semester_id')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

    </div>
</div>
<hr>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit"
                            class="btn btn-linkedin">{{empty($courseSection->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('course-section.show', [$course->id])}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>
@push('script')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // For select 2
            $(".select2").select2();
        });
    </script>
@endpush