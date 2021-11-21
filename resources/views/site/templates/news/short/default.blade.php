@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageHasAside' => true])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            @if ($records->count())
                <div class="row">
                    @foreach($records as $record)
                        @include('site.blocks.snippets.post-card', ['record' => $record])
                    @endforeach
                </div>

                @include('site.blocks.snippets.pagination')
            @else
                @include('site.blocks.snippets.filling')
            @endif

        @endcomponent

    @endcomponent
@endsection
