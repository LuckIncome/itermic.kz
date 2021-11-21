@extends('site.templates.pages')

@section('content')
    @component('site.component.page')

        @component('site.component.page-main')

            @if ($images->count() || !empty($text))
                <article class="post">
                    @include('site.blocks.snippets.post-images')

                    @if (!empty($text))
                        <div class="post__content formatted-body">
                            {!! $text !!}
                        </div>
                    @endif
                </article>
            @else
                @include('site.blocks.snippets.filling')
            @endif

        @endcomponent

    @endcomponent
@endsection
