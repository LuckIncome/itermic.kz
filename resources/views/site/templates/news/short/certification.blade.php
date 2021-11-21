@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageHasAside' => true])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            @if ($records->count())
                <div class="row justify-content-center justify-content-md-start js-lg">
                    @foreach($records as $record)
                        @include('site.blocks.snippets.certificate', ['record' => $record])
                    @endforeach
                </div>

                @include('site.blocks.snippets.pagination')
            @else
                @include('site.blocks.snippets.filling')
            @endif

        @endcomponent

    @endcomponent
@endsection
