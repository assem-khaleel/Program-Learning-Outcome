<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('institutions.nameEn') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name_en" type="text"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('institutions.nameEn')}}"
                           value="{{ old('name_en', ($institution->name_en ?? '')) }}">
                    @error('name_en')
                        <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_ar" class="control-label col-md-2">{{trans('institutions.nameAr') }}</label>
                <div class="col-md-10">
                    <input id="name_ar" name="name_ar" type="text"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('institutions.nameAr')}}"
                           value="{{ old('name_ar', ($institution->name_ar ?? '')) }}">
                    @error('name_ar')
                        <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en" class="control-label col-md-2">{{trans('institutions.descriptionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="description_en" name="description_en"
                              class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.descriptionEn')}}">{{ old('description_en', ($institution->description_en ?? '')) }}</textarea>
                    @error('description_en')
                        <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_ar" class="control-label col-md-2">{{trans('institutions.descriptionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="description_ar" name="description_ar"
                              class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.descriptionAr')}}">{{ old('description_ar', ($institution->description_ar ?? '')) }}</textarea>
                    @error('description_ar')
                        <small class="form-control-feedback text-danger">{{$message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="vision_en" class="control-label col-md-2">{{trans('institutions.visionEn')}}</label>
                <div class="col-md-10">
                    <textarea id="vision_en" name="vision_en"
                              class="form-control {{ $errors->has('vision_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.visionEn')}}">{{ old('vision_en', ($institution->vision_en ?? '')) }}</textarea>
                    @error('vision_en')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="vision_ar" class="control-label col-md-2">{{trans('institutions.visionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="vision_ar" name="vision_ar"
                              class="form-control {{ $errors->has('vision_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.visionAr')}}">{{ old('vision_ar', ($institution->description_ar ?? '')) }}</textarea>
                    @error('vision_ar')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="mission_en" class="control-label col-md-2">{{trans('institutions.missionEn')}}</label>
                <div class="col-md-10">
                    <textarea id="mission_en" name="mission_en"
                              class="form-control {{ $errors->has('mission_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.missionEn')}}">{{ old('mission_en', ($institution->mission_en ?? '')) }}</textarea>
                    @error('mission_en')
                        <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="mission_ar" class="control-label col-md-2">{{trans('institutions.missionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="mission_ar" name="mission_ar"
                              class="form-control {{ $errors->has('mission_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('institutions.missionAr')}}">{{ old('mission_ar', ($institution->mission_ar ?? '')) }}</textarea>
                    @error('mission_ar')
                        <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="location" class="control-label col-md-2">{{trans('institutions.location') }}</label>
                <div class="col-md-10">
                    <input id="location" name="location" type="text"
                           class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('institutions.location')}}"
                           value="{{ old('location', ($institution->location ?? '')) }}">
                    @error('location')
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
                            class="btn btn-linkedin">{{empty($institution->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('institution.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>
