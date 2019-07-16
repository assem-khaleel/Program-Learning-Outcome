<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('courses.courses')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="course_sections_id"
                            data-placeholder="{{trans('assignment.selectCourse')}}">
                        <option value="">{{trans('assignment.selectCourse')}}</option>
                        @foreach($courseSections as $section)
                            <option value="{{$section->id}}"
                                    {{old('course_sections_id') == $section->id || !empty($assignment->course_sections_id) && ($section->id == $assignment->course_sections_id) ? 'selected' : '' }}>
                                {{$section->code." ". '-'. " "}}  {{$section->course->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('course_sections_id')
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
                           value="{{ old('name_en', ($assignment->name_en ?? '')) }}">
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
                           value="{{ old('name_ar', ($assignment->name_ar ?? '')) }}">
                    @error('name_ar')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en" class="control-label col-md-2">{{trans('assignment.descriptionEn')}}</label>
                <div class="col-md-10">
                    <textarea id="description_en" name="description_en"
                              class="form-control {{$errors->has('description_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('assignment.descriptionEn')}}">{{ old('description_en', ($assignment->description_en ?? '')) }}</textarea>
                    @if ($errors->has('description_en'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('description_en') }}</small>
                    @endif
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_ar" class="control-label col-md-2">{{trans('assignment.descriptionar')}}</label>
                <div class="col-md-10">
                    <textarea id="description_ar" name="description_ar"
                              class="form-control {{$errors->has('description_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('assignment.descriptionar')}}">{{ old('description_ar', ($assignment->description_ar ?? '')) }}</textarea>
                    @if ($errors->has('description_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('description_ar') }}</small>
                    @endif
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
                            class="btn btn-linkedin">{{empty($assignment->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('assignment.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>
