<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label for="code" class="control-label col-md-2">{{ trans('student.studentName') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name_en" type="text"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('student.studentName')}}"
                           value="{{ old('name_en', ($student->name_en ?? '')) }}">
                    @error('name_en')
                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="code" class="control-label col-md-2">{{ trans('student.studentNumber') }}</label>
                <div class="col-md-10">
                    <input id="student_no" name="student_no" type="number"
                           class="form-control {{ $errors->has('student_no') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('student.studentNumber')}}"
                           value="{{ old('student_no', ($student->student_no ?? '')) }}">
                    @error('student_no')
                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('programs.programs')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                            name="program_id"
                            data-placeholder="{{trans('programs.programs')}}">
                        <option value="">{{trans('programs.programs')}}</option>
                        @foreach($programs as $program)
                            <option value="{{$program->id}}"
                                    {{old('program_id') == $program->id || !empty($student->program_id) && ($program->id == $student->program_id) ? 'selected' : '' }}>
                                {{$program->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('program_id')
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
                            class="btn btn-linkedin">{{empty($student->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('student.index')}}"
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