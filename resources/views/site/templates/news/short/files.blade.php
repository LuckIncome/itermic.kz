@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageInnerClasses' => 'pb-0 pb-xl-4'])

        @component('site.component.page-main')

            @if ($records->count() > 0)
                <div class="documents">
                    @foreach($records as $record)
                        @php $file = $record->media('file')->whereLang(app()->getLocale())->first(); @endphp

                        @if (!is_null($file) && file_exists(public_path($file->link)))
                            <div class="document">
                                {!! icon('icon--document', 'document__icon') !!}

                                <span class="document__title">{{ $record->title ?? strip_tags($record->short) }}</span>

                                <a
                                    class="document__download link"
                                    href="/file/save/{{ $file->id }}"
                                    download
                                >
                                    <span>Скачать</span>
                                    {!! icon('icon--arrow', 'icon--arrow-down') !!}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                @include('site.blocks.snippets.pagination')
            @else
                @include('site.blocks.snippets.filling')
            @endif

        @endcomponent

    @endcomponent
@endsection
