<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('departments.department')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="department_id"
                            data-placeholder="{{trans('programs.selectDepartment')}}">
                        <option value="">{{trans('programs.selectDepartment')}}</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}"
                                    {{old('department_id') == $department->id || !empty($program->department_id) && ($department->id == $program->department_id) ? 'selected' : '' }}>
                                {{$department->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('common.nameEn') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name_en" type="text"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.nameEn')}}"
                           value="{{ old('name_en', ($program->name_en ?? '')) }}">
                    @error('name_en')
                        <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_ar" class="control-label col-md-2">{{trans('common.nameAr') }}</label>
                <div class="col-md-10">
                    <input id="name_ar" name="name_ar" type="text"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.nameAr')}}"
                           value="{{ old('name_ar', ($program->name_ar ?? '')) }}">
                    @error('name_ar')
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
                            class="btn btn-linkedin">{{empty($program->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('program.index')}}"
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
        jQuery(document).ready(function() {
            // For select 2
            $(".select2").select2();
        });
    </script>
@endpush