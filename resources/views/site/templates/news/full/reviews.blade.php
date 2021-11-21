@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageHasAside' => true, 'pageIntroTitle' => $data->title])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            <article class="review">
                <div class="review__city">{{ $data->rubric->title }}</div>

                <div class="review__content formatted-body">
                    {!! $data->full !!}
                </div>
            </article>

        @endcomponent

    @endcomponent
@endsection
