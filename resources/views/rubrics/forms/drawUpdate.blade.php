<div class="form-body">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('common.name') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name" type="text"
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
                <label for="descriptionRubric"
                       class="control-label col-md-2">{{trans('common.description')}}</label>
                <div class="col-md-10">
                    <textarea id="descriptionRubric" name="descriptionRubric"
                              class="form-control {{ $errors->has('descriptionRubric') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('common.description')}}">{{ old('descriptionRubric', ($rubric->description ?? '')) }}</textarea>
                    @error('descriptionRubric')
                    <small class="form-control-feedback text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table color-bordered-table purple-bordered-table deleteColumns"
                   id="rubric-table">
                <thead>
                <tr>
                    <th>{{trans('common.name')}}</th>
                    @php $count = 0 @endphp
                    @foreach($rubric->rubricLevels->sortBy('order') as $keyLevel => $level)
                        <th>
                            <div class="col-md-12">
                                <input id="level-{{$keyLevel}}" name="levels[{{$keyLevel}}]" type="text"
                                       class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }} form-control-sm"
                                       placeholder="{{trans('common.level').' '.++$count}}"
                                       value="{{ old('levels.'.$keyLevel, $level->level ?? '')  }}">
                                @error('levels.'.$keyLevel)
                                <small class="form-control-feedback text-white"> {{ $message }} </small>
                                @enderror
                                <input name="levelIds[{{$keyLevel}}]" type="hidden" value="{{ $level->id }}">

                            </div>
                            <div class="col-md-12">
                                <input id="orderLevel-{{$keyLevel}}" name="orderLevel[{{$keyLevel}}]" type="text"
                                       class="form-control {{ $errors->has('orderLevel') ? 'is-invalid' : '' }} form-control-sm"
                                       placeholder="{{trans('common.order').' '.$count}}"
                                       value="{{ old('orderLevel.'.$keyLevel, $level->order ?? '')  }}">
                                @error('orderLevel.'.$keyLevel)
                                <small class="form-control-feedback text-white"> {{ $message }} </small>
                                @enderror

                                <input type="button" class="btn btn-sm btn-danger deleteColumn" value="Delete Column"/>

                            </div>
                        </th>
                    @endforeach
                    @if (!empty($columns) && $rubric->rubricLevels->count() != $columns)
                        @for ($columnLevel = $rubric->rubricLevels->count() ; $columnLevel < $columns; $columnLevel++)
                            <th>
                                <div class="col-md-12">
                                    <input id="level-{{$columnLevel}}" name="levels[{{$columnLevel}}]" type="text"
                                           class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.level').' '.++$count}}"
                                           value="{{ old('levels.'.$columnLevel)  }}">
                                    @error('levels.'.$columnLevel)
                                    <small class="form-control-feedback text-white"> {{ $message }} </small>
                                    @enderror

                                </div>
                                <div class="col-md-12">
                                    <input id="orderLevel-{{$columnLevel}}" name="orderLevel[{{$columnLevel}}]"
                                           type="text"
                                           class="form-control {{ $errors->has('orderLevel') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.order').' '.$count}}"
                                           value="{{ old('orderLevel.'.$columnLevel)  }}">
                                    @error('orderLevel.'.$columnLevel)
                                    <small class="form-control-feedback text-white"> {{ $message }} </small>
                                    @enderror

                                    <input type="button" class="btn btn-sm btn-danger deleteColumn"
                                           value="{{trans('common.deleteColumn')}}"/>
                                </div>
                            </th>
                        @endfor
                    @endif

                </tr>
                </thead>
                <tbody>
                @foreach($rubric->rubricIndicators->sortBy('order') as $keyIndicator => $indicator)
                    <tr>
                        <td>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <input id="indicator-{{$keyIndicator}}" name="indicators[{{$keyIndicator}}]"
                                           type="text"
                                           class="form-control {{ $errors->has('indicators') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.indicator')}}"
                                           value="{{ old('indicators.'.$keyIndicator, $indicator->indicator ?? '') }}">
                                    @error('indicators.'.$keyIndicator)
                                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                    @enderror

                                    <input id="orderIndicator-{{$keyIndicator}}"
                                           name="orderIndicator[{{$keyIndicator}}]" type="text"
                                           class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.order')}}"
                                           value="{{ old('orderIndicator.'.$keyIndicator, $indicator->order ?? '') }}">
                                    @error('orderIndicator.'.$keyIndicator)
                                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                    @enderror

                                    <input id="score-{{$keyIndicator}}" name="score[{{$keyIndicator}}]" type="text"
                                           class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.score')}}"
                                           value="{{ old('score.'.$keyIndicator, $indicator->score ?? '') }}">
                                    @error('score.'.$keyIndicator)
                                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                    @enderror
                                    <input name="indicatorIds[{{$keyIndicator}}]" type="hidden"
                                           value="{{ $indicator->id }}">

                                    <input type="button" class="btn btn-sm btn-danger deleteRow"
                                           value="{{trans('common.deleteRow')}}"/>

                                </div>
                            </div>
                        </td>
                        @foreach($indicator->rubricCells as $keyDescription => $description)

                            <td>
                                <div class="col-md-12 m-b-0">
                                    <div class="form-group row">
                                        <textarea name="description[{{$keyIndicator}}][{{$keyDescription}}]"
                                                  class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} form-control-sm"
                                                  placeholder="{{trans('common.description')}}">{{ old('description.'.$keyIndicator.'.'.$keyDescription, $description->description ?? '' )}}</textarea>
                                        @error('description.'.$keyIndicator.'.'.$keyDescription)
                                        <small class="form-control-feedback text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <input name="descriptionIds[{{$keyIndicator}}][{{$keyDescription}}]" type="hidden"
                                       value="{{$description->id }}">
                            </td>
                        @endforeach

                        @if (!empty($columns) && $rubric->rubricLevels->count() != $columns)
                            @for ($columnLevel = $rubric->rubricLevels->count(); $columnLevel < $columns; $columnLevel++)
                                <td>
                                    <div class="col-md-12 m-b-0">
                                        <div class="form-group row">
                                        <textarea name="description[{{$keyIndicator}}][{{$columnLevel}}]"
                                                  class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} form-control-sm"
                                                  placeholder="{{trans('common.description')}}">{{ old('description.'.$keyIndicator.'.'.$columnLevel)}}</textarea>
                                            @error('description.'.$keyIndicator.'.'.$columnLevel)
                                            <small class="form-control-feedback text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            @endfor
                        @endif
                    </tr>
                @endforeach
                @if (!empty($rows) && $rubric->rubricIndicators->count() != $rows)

                    @for ($rowsIndicator = $rubric->rubricIndicators->count(); $rowsIndicator < $rows; $rowsIndicator++)
                        <tr>
                            <td>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <input id="indicator-{{$rowsIndicator}}" name="indicators[{{$rowsIndicator}}]"
                                               type="text"
                                               class="form-control {{ $errors->has('indicators') ? 'is-invalid' : '' }} form-control-sm"
                                               placeholder="{{trans('common.indicator')}}"
                                               value="{{ old('indicators.'.$rowsIndicator) }}">
                                        @error('indicators.'.$rowsIndicator)
                                        <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                        @enderror

                                        <input id="orderIndicator-{{$rowsIndicator}}"
                                               name="orderIndicator[{{$rowsIndicator}}]" type="text"
                                               class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }} form-control-sm"
                                               placeholder="{{trans('common.order')}}"
                                               value="{{ old('orderIndicator.'.$rowsIndicator) }}">
                                        @error('orderIndicator.'.$rowsIndicator)
                                        <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                        @enderror

                                        <input id="score-{{$rowsIndicator}}" name="score[{{$rowsIndicator}}]"
                                               type="text"
                                               class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }} form-control-sm"
                                               placeholder="{{trans('common.score')}}"
                                               value="{{ old('score.'.$rowsIndicator) }}">
                                        @error('score.'.$rowsIndicator)
                                        <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                        @enderror

                                        <input type="button" class="btn btn-sm btn-danger deleteRow"
                                               value="{{trans('common.deleteRow')}}"/>

                                    </div>
                                </div>
                            </td>
                            @for ($columnLevel = 0 ; $columnLevel < $columns; $columnLevel++)
                                <td>
                                    <div class="col-md-12 m-b-0">
                                        <div class="form-group row">
                                        <textarea name="description[{{$rowsIndicator}}][{{$columnLevel}}]"
                                                  class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} form-control-sm"
                                                  placeholder="{{trans('common.description')}}">{{ old('description.'.$rowsIndicator.'.'.$columnLevel)}}</textarea>
                                            @error('description.'.$rowsIndicator.'.'.$columnLevel)
                                            <small class="form-control-feedback text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </td>

                            @endfor
                        </tr>
                    @endfor
                @endif

                </tbody>
            </table>
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
                            class="btn btn-linkedin">{{trans('common.update') }}</button>

                    <a href="{{route('rubric.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                    <input name="rows" id="rubric-rows" type="hidden"
                           value="{{ $rows ?? $rubric->rubricIndicators->count() }}">
                    <input name="columns" id="rubric-columns" type="hidden"
                           value="{{ $columns ?? $rubric->rubricLevels->count() }}">
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
