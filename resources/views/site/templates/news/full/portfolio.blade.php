@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageIntroTitle' => $data->title, 'pageInnerClass' => 'pb-0 pb-xl-4'])

        @component('site.component.page-main')

            @include('site.blocks.snippets.portfolio-images')

        @endcomponent

    @endcomponent
@endsection
