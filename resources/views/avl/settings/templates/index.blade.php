@extends('avl.default')

@section('main')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Настройка шаблонов
            @can('create', new App\Models\Templates)
                <div class="card-actions">
                    <a href="{{ route('admin.settings.templates.create') }}" class="w-100 pl-3 pr-3"><i class="icon-plus" style="vertical-align: sub;"></i> Добавить</a>
                </div>
            @endcan
        </div>

        <div class="card-body">
            @if ($templates)
                @foreach (config('avl.sections') as $key => $name)
                    <div class="card">
                        <div class="card-header">
                            Тип - {{ $name }}
                            <div class="card-actions">
                                <a class="text-dark" href="#" data-toggle="collapse" data-target="#templates--{{ $key }}" aria-expanded="false">
                                    <i class="fa fa-sort"></i>
                                </a>
                            </div>
                        </div>

                        <div class="collapse" id="templates--{{ $key }}">
                            <div class="card-body">
                                <table class="table table-sm table-striped table-bordered">
                                    @foreach($templates as $template)
                                        @if ($template->template == $key)
                                            <tr id="template--{{ $template->id }}" class="position-relative">
                                                <td class="align-middle pl-3">
                                                    <div class="mb-2">{{ $template->title }}</div>
                                                    <div class="small">
                                                        <div class="d-inline-block" style="min-width: 200px;"><span class="text-primary">short: </span>{{ $template->file_short ?? '' }}</div>
                                                        <div class="d-inline-block" style="min-width: 200px;"><span class="text-primary">full: </span>{{ $template->file_full ?? '' }}</div>
                                                        <div class="d-inline-block" style="min-width: 200px;"><span class="text-primary">col: </span>{{ $template->file_col ?? '' }} </div>
                                                        <div class="d-inline-block" style="min-width: 200px;"><span class="text-primary">category: </span>{{ $template->file_category ?? '' }}</div>
                                                    </div>
                                                </td>
                                                <td width="150" class="text-center align-middle">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        @can('view',   new App\Models\Templates)
                                                            <a href="{{ route('admin.settings.templates.show', ['template' => $template->id]) }}" class="btn btn-outline-primary" title="Просмотр">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @can('update', new App\Models\Templates)
                                                            <a href="{{ route('admin.settings.templates.edit', ['template' => $template->id]) }}" class="btn btn-outline-success" title="Изменить">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @if ($template->ban == 0)
                                                            @can('delete', new App\Models\Templates)
                                                                <a href="#" class="btn btn-outline-danger remove--record" title="Удалить">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            @endcan
                                                        @endif
                                                    </div>
                                                    @can('delete', new App\Models\Templates)
                                                        <div class="remove-message">
                                                            <span>Вы действительно желаете удалить шаблон?</span>
                                                            <span class="remove--actions btn-group btn-group-sm" style="top: 4px; height: 30px;">
                                                                <button class="btn btn-outline-primary cancel"><i class="fa fa-times-circle"></i> Нет</button>
                                                                <button class="btn btn-outline-danger removeTemplate" data-id="{{ $template->id }}"><i class="fa fa-trash"></i> Да</button>
                                                            </span>
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="/avl/js/modules/settings/templates/index.js" charset="utf-8"></script>
@endsection
