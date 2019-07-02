<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('colleges.colleges')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="college_id"
                            data-placeholder="{{trans('colleges.selectCollege')}}">
                        <option value="">{{trans('colleges.selectCollege')}}</option>
                        @foreach($colleges as $college)
                            <option value="{{$college->id}}"
                                    {{old('college_id') == $college->id || !empty($department->college_id) && ($college->id == $department->college_id) ? 'selected' : '' }}>
                                {{$college->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('college_id')
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
                           value="{{ old('name_en', ($department->name_en ?? '')) }}">
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
                           value="{{ old('name_ar', ($department->name_ar ?? '')) }}">
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
                            class="btn btn-linkedin">{{empty($department->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('department.index')}}"
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