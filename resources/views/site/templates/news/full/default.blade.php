@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageHasAside' => true, 'pageIntroTitle' => $data->title])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            @include('site.blocks.snippets.post')

        @endcomponent

    @endcomponent
@endsection
