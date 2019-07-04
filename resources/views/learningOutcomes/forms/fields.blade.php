<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('programs.programs')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                            name="program_id"
                            data-placeholder="{{trans('programs.selectProgram')}}">
                        <option value="">{{trans('programs.selectProgram')}}</option>
                        @foreach($programs as $program)
                            <option value="{{$program->id}}"
                                    {{old('college_id') == $program->id || !empty($learningOutcome->program_id) && ($program->id == $learningOutcome->program_id) ? 'selected' : '' }}>
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

        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('common.nameEn') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name_en" type="text"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.nameEn')}}"
                           value="{{ old('name_en', ($learningOutcome->name_en ?? '')) }}">
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
                           value="{{ old('name_ar', ($learningOutcome->name_ar ?? '')) }}">
                    @error('name_ar')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en"
                       class="control-label col-md-2">{{trans('institutions.descriptionEn')}}</label>
                <div class="col-md-10">
                    <textarea id="description_en" name="description_en"
                              class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.descriptionEn')}}">{{ old('description_en', ($learningOutcome->description_en ?? '')) }}</textarea>
                    @error('description_en')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_ar"
                       class="control-label col-md-2">{{trans('institutions.descriptionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="description_ar" name="description_ar"
                              class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.descriptionAr')}}">{{ old('description_ar', ($learningOutcome->description_ar ?? '')) }}</textarea>
                    @error('description_ar')
                    <small class="form-control-feedback text-danger">{{$message }}</small>
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
                            class="btn btn-linkedin">{{empty($learningOutcome->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('learning-outcome.index')}}"
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