@extends('avl.default')

@section('js')
    <script src="/avl/js/jquery-ui/jquery-ui.min.js" charset="utf-8"></script>
    <script src="/avl/js/uploadifive/jquery.uploadifive.min.js" charset="utf-8"></script>

    <script src="/avl/js/modules/settings/news/edit.js" charset="utf-8"></script>
    <script src="/avl/js/tinymce/tinymce.min.js" charset="utf-8"></script>

    <script src="/avl/js/jquery-ui/timepicker/jquery.ui.timepicker.js" charset="utf-8"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="/avl/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/avl/js/uploadifive/uploadifive.css">
    <link rel="stylesheet" href="/avl/js/jquery-ui/timepicker/jquery.ui.timepicker.css">
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Добавление новости
            <div class="card-actions">
                <a href="{{ route('news.index', [ 'id' => $id, 'page' => session('page', '1') ]) }}" class="btn btn-default pl-3 pr-3" style="width: 70px;" title="Назад"><i
                        class="fa fa-arrow-left"></i></a>
                <button type="submit" form="submit" name="button" value="add" class="btn btn-primary pl-3 pr-3" style="width: 70px;" title="Сохранить и добавить новую"><i
                        class="fa fa-plus"></i></button>
                <button type="submit" form="submit" name="button" value="save" class="btn btn-success pl-3 pr-3" style="width: 70px;" title="Сохранить и перейти к списку"><i
                        class="fa fa-floppy-o"></i></button>
                <button type="submit" form="submit" name="button" value="edit" class="btn btn-warning pl-3 pr-3" style="width: 70px;" title="Сохранить и изменить"><i
                        class="fa fa-floppy-o"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/settings/sections/'.$id.'/news') }}" method="post" id="submit">
                {!! csrf_field(); !!}
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Дата публикации</label>
                            {!! Form::text('news_published_at', date('Y-m-d'), ['class' => 'form-control', 'id' => 'datepicker']) !!}
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="news_published_time">Время публикации</label>
                            {!! Form::text('news_published_time', date('H:i'), ['class' => 'form-control timepicker']) !!}
                        </div>
                    </div>

                    @if ($section->rubric == 1)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="news_published_time">Рубрика</label>
                                <select class="form-control" name="news_rubric_id">
                                    <option value="0">---</option>
                                    @if (!is_null($rubrics))
                                        @foreach ($rubrics as $rubric)
                                            <option value="{{ $rubric->id }}" @if(old('news_rubric_id') == $rubric->id){{ 'selected' }}@endif>
                                                {{ !is_null($rubric->title_ru) ? $rubric->title_ru : str_limit(strip_tags($rubric->description_ru), 100) }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    @foreach($langs as $lang)
                        <li class="nav-item">
                            <a class="nav-link @if($lang->key == 'ru') active show @endif" href="#title_{{ $lang->key }}" data-toggle="tab">
                                {{ $lang->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($langs as $lang)
                        @php $name = 'title_' . $lang->key; @endphp
                        @php $good = 'good_' . $lang->key; @endphp
                        @php $add = 'additionally_' . $lang->key; @endphp
                        @php $full = 'full_' . $lang->key; @endphp
                        @php $short = 'short_' . $lang->key; @endphp
                        @php $position = 'position_' . $lang->key; @endphp
                        <div class="tab-pane @if($lang->key == "ru") active show @endif" id="title_{{$lang->key}}" role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active show" href="#sub-tab_{{ $lang->key }}-index" data-toggle="tab">Основные</a></li>
                                <li class="nav-item"><a class="nav-link" href="#sub-tab_{{ $lang->key }}-full" data-toggle="tab">Полное описание</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="sub-tab_{{ $lang->key }}-index" role="tabpanel">
                                    <div class="row">
                                        <div class="col-2 col-sm-1">
                                            <div class="form-group">
                                                <label class="switch switch-3d switch-primary">
                                                    <input name='news_good_{{$lang->key}}' type='hidden' value='0'>
                                                    <input type="checkbox" class="switch-input" name="news_good_{{$lang->key}}" value="1"
                                                           @if (old('news_good_{{$lang->key}}') == 1) checked @endif>
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-5 col-sm-6">
                                            {!! Form::text('news_title_' . $lang->key, null, ['class' => 'form-control', 'placeholder' => 'Название']) !!}
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            {!! Form::text('news_additionally_' . $lang->key, null, ['class' => 'form-control', 'placeholder' => 'Дополнительно']) !!}
                                        </div>
                                    </div>

                                    {!! Form::textarea('news_short_' . $lang->key, null, ['class' => 'tinymce']) !!}
                                </div>
                                <div class="tab-pane" id="sub-tab_{{ $lang->key }}-full" role="tabpanel">
                                    {!! Form::textarea('news_full_' . $lang->key, null, ['class' => 'tinymce']) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
