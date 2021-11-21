@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageHasAside' => true])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            @if ($records->count())
                <div class="row">
                    @foreach($records as $record)
                        <div class="cooperation col-12">
                            <div class="cooperation__image-wrap">
                                @if ($record->photo)
                                    <img src="/{{ $record->photo }}" alt="{{ $record->title }}">
                                @endif
                            </div>
                            <div class="cooperation__info formatted-body">{!! $record->description !!}</div>
                        </div>
                    @endforeach
                </div>

                @include('site.blocks.snippets.pagination')
            @else
                @include('site.blocks.snippets.filling')
            @endif

        @endcomponent

    @endcomponent
@endsection
