<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="name" class="control-label col-md-2">{{ trans('common.name') }}</label>
                <div class="col-md-10">
                    <input id="name" name="name" type="text"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.name')}}"
                           value="{{ old('name', ($rubric->name ?? '')) }}">
                    @error('name')
                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="description"
                       class="control-label col-md-2">{{trans('common.description')}}</label>
                <div class="col-md-10">
                    <textarea id="description" name="description"
                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('common.description')}}">{{ old('description', ($rubric->description ?? '')) }}</textarea>
                    @error('description')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group row">
                <label for="rows" class="control-label col-md-2">{{ trans('common.rows') }}</label>
                <div class="col-md-10">
                    <input id="rows" name="rows" type="text"
                           class="form-control {{ $errors->has('rows') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.rows')}}"
                           value="{{ old('rows') }}">
                    @error('rows')
                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group row">
                <label for="columns" class="control-label col-md-2">{{ trans('common.columns') }}</label>
                <div class="col-md-10">
                    <input id="columns" name="columns" type="text"
                           class="form-control {{ $errors->has('columns') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('common.columns')}}"
                           value="{{ old('columns') }}">
                    @error('columns')
                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
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
                    <input type="submit" name="saveClose" value="{{trans('common.saveAndClose')}}" class="btn btn-linkedin">
                    <input type="submit" name="saveContinue" value="{{trans('common.saveAndContinue')}}" class="btn btn-linkedin">
                    <a href="{{route('rubric.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>

