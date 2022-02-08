<div class="form-body">
    <div class="row">
        <div class="table-responsive">
            <table class="table color-bordered-table info-bordered-table table-striped m-b-0 deleteColumns"
                   id="rubric-table">
                <thead>
                <tr>
                    <th>name</th>
                    @php $count = 0 @endphp
                    @for ($columnLevel = 0; $columnLevel < $columns; $columnLevel++)
                        <th>
                            <div class="col-md-12">
                                <input id="level-{{$columnLevel}}" name="levels[{{$columnLevel}}]" type="text"
                                       class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }} form-control-sm"
                                       placeholder="{{trans('common.level').' '.++$count}}"
                                       value="{{ old('levels.'.$columnLevel)  }}">
                                @error('levels.'.$columnLevel)
                                <small class="form-control-feedback text-white"> {{ $message }} </small>
                                @enderror

                                <input id="orderLevel-{{$columnLevel}}" name="orderLevel[{{$columnLevel}}]" type="text"
                                       class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }} form-control-sm"
                                       placeholder="{{trans('common.order').' '.$count}}"
                                       value="{{ old('orderLevel.'.$columnLevel)  }}">
                                @error('orderLevel.'.$columnLevel)
                                <small class="form-control-feedback text-white"> {{ $message }} </small>
                                @enderror

                                <input id="percentageLevel-{{$columnLevel}}" name="percentageLevel[{{$columnLevel}}]" type="text"
                                       class="form-control {{ $errors->has('percentageLevel') ? 'is-invalid' : '' }} form-control-sm"
                                       placeholder="{{trans('common.percentage').' '.$count}}"
                                       value="{{ old('percentageLevel.'.$columnLevel)  }}">
                                @error('percentageLevel.'.$columnLevel)
                                <small class="form-control-feedback text-white"> {{ $message }} </small>
                                @enderror

                                <input type="button" class="btn btn-sm btn-danger deleteColumn" value="{{trans('common.deleteColumn')}}"/>

                            </div>
                        </th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @for ($row = 0; $row < $rows; $row++)
                    <tr>
                        <td>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <input id="indicator-{{$row}}" name="indicators[{{$row}}]" type="text"
                                           class="form-control {{ $errors->has('indicators') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.indicator')}}"
                                           value="{{ old('indicators.'.$row) }}">
                                    @error('indicators.'.$row)
                                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                    @enderror

                                    <input id="orderIndicator-{{$row}}" name="orderIndicator[{{$row}}]" type="text"
                                           class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.order')}}"
                                           value="{{ old('orderIndicator.'.$row) }}">
                                    @error('orderIndicator.'.$row)
                                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                    @enderror

                                    <input id="score-{{$row}}" name="score[{{$row}}]" type="text"
                                           class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }} form-control-sm"
                                           placeholder="{{trans('common.score')}}"
                                           value="{{ old('score.'.$row) }}">
                                    @error('score.'.$row)
                                    <small class="form-control-feedback text-danger"> {{ $message }} </small>
                                    @enderror

                                    <input type="button" class="btn btn-sm btn-danger deleteRow" value="{{trans('common.deleteRow')}}"/>

                                </div>
                            </div>
                        </td>
                        @for ($column = 0; $column < $columns; $column++)
                            <td>
                                <div class="col-md-12 m-b-0">
                                    <div class="form-group row">
                                    <textarea
                                              name="description[{{$row}}][{{$column}}]"
                                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} form-control-sm"
                                              placeholder="{{trans('common.description')}}">{{ old('description.'.$row.'.'.$column)}}</textarea>
                                        @error('description.'.$row.'.'.$column)
                                        <small class="form-control-feedback text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </td>
                        @endfor
                    </tr>
                @endfor
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
                            class="btn btn-linkedin">{{trans('common.save') }}</button>

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

@push('script')
    <script type="text/javascript">
        var rowCounter = 0;

        $('body').on('click', 'input.deleteRow', function () {
            var rowCount = document.getElementById('rubric-table').rows.length;
            if (rowCount > 2) {
                $(this).parents('tr').remove();

            } else {
                $("#errorTable").addClass('alert alert-danger');
                var html = ' <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                    '<strong>\n' +
                    '{{trans('common.notDeleteLastRow')}}' +
                    '      </strong>';
                $("#errorTable").append(html);
            }
        });

        var columnCount = 0;

        $('#rubric-table').on('click', '.deleteColumn', function () {
            var columnCount = $("#rubric-table").find('tr')[0].cells.length;
            if (columnCount > 2) {
                $(".deleteColumns thead tr th:nth-child(" + ($(this).index() + 1) + ")").remove();
                $(".deleteColumns tbody tr td:nth-child(" + ($(this).index() + 1) + ")").remove();
            } else {
                $("#errorTable").addClass('alert alert-danger');
                var html = ' <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                    '<strong>\n' +
                    '{{trans('common.notDeleteLastColumn')}}' +
                    '      </strong>';
                $("#errorTable").append(html);

            }
        });


    </script>
@endpush
