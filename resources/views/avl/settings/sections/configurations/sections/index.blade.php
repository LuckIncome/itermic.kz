@extends('avl.default')

@section('main')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Конфигурация раздела: {{ $section->name }}
            <div class="card-actions">
              <button type="submit" form="submit" value="save" class="btn btn-success pl-3 pr-3" style="width: 70px;" title="Сохранить"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
        <div class="card-body">
          {{ Form::open(['route' => ['admin.settings.sections.configuration.save', $section->id], 'method' => 'post', 'id' => 'submit']) }}

            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active show" href="#seo" data-toggle="tab">SEO</a>
              </li>
            </ul>

            <div class="tab-content">

              <div class="tab-pane active show" id="seo" role="tabpanel">

                <ul class="nav nav-tabs" role="tablist">
                  @foreach($langs as $lang)
                    <li class="nav-item">
                      <a class="nav-link @if($lang->key == 'ru') active show @endif" href="#seo--sub-tab_{{ $lang->key }}" data-toggle="tab">
                        {{ $lang->name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
                <div class="tab-content">
                  @foreach ($langs as $lang)
                    <div class="tab-pane @if($lang->key == "ru") active show @endif"  id="seo--sub-tab_{{$lang->key}}" role="tabpanel">

                      <div class="row">

                        <div class="col-12">
                          <div class="form-group">
                            {{ Form::label(null, 'Название (альтернативное название раздела)') }}
                            {{ Form::text('name_' . $lang->key, $section->configuration->{'name_' . $lang->key} ?? '', ['class' => 'form-control']) }}
                          </div>

                          <div class="form-group">
                            {{ Form::label(null, 'Meta keywords') }}
                            {{ Form::text('keywords_' . $lang->key, $section->configuration->{'keywords_' . $lang->key} ?? '', ['class' => 'form-control']) }}
                          </div>

                          <div class="form-group">
                            {{ Form::label(null, 'Meta description') }}
                            {{ Form::textarea('description_' . $lang->key, $section->configuration->{'description_' . $lang->key} ?? '', ['class' => 'form-control', 'rows' => 5]) }}
                          </div>
                        </div>

                      </div>

                    </div>
                  @endforeach
                </div>
              </div>

            </div>

          {{ Form::close() }}
        </div>
    </div>
@endsection
