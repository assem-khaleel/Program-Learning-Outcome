<div class="form-group">
    <label for="analysis">analysis</label>
    <textarea rows="5" name="analysis"  class="form-control {{ $errors->has('analysis') ? 'is-invalid' : '' }}">
        {{ old('analysis', ($analysis->analysis ?? '')) }}
                </textarea>
    @error('analysis')
    <small class="form-control-feedback text-danger"> {{ $message }} </small>
    @enderror
</div>

<div class="form-group">
    <label for="recommendations">recommendations</label>
    <textarea  rows="5" name="recommendations"  class="form-control {{ $errors->has('recommendations') ? 'is-invalid' : '' }}">
        {{ old('recommendations', ($analysis->recommendations ?? '')) }}
                </textarea>
    @error('recommendations')
    <small class="form-control-feedback text-danger"> {{ $message }} </small>
    @enderror
</div>

<div class="form-group">
    <label for="actions">actions</label>
    <textarea rows="5" name="actions" class="form-control {{ $errors->has('actions') ? 'is-invalid' : '' }}">
          {{ old('actions', ($analysis->actions ?? '')) }}
                </textarea>
    @error('actions')
    <small class="form-control-feedback text-danger"> {{ $message }} </small>
    @enderror
</div>

<input type="hidden" name="assignment_id" value="{{$assignment->id}}">

<hr>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <input type="submit" name="saveClose" value="{{trans('common.save')}}" class="btn btn-linkedin">
                    <a href="{{url('/settings/assignment')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
