@extends('site.templates.pages')

@section('content')
    @component('site.component.page')

        @component('site.component.page-main')

            <div class="contacts row d-flex align-items-center">
                @if ($images->count() || !empty($text))
                    <article class="post col-lg-12 mb-5">
                        @include('site.blocks.snippets.post-images')

                        @if (!empty($text))
                            <div class="post__content formatted-body">
                                {!! $text !!}
                            </div>
                        @endif
                    </article>
                @endif

                <div class="col-lg-4 mb-5 mb-lg-0">
                    {!! getLinks('col-contacts-list', 'contacts-list') !!}
                </div>

                <div class="col-lg-8">
                    <div class="contacts__map">{!! getPage('col-contacts-map') !!}</div>
                </div>
            </div><!-- /.contacts -->

        @endcomponent

    @endcomponent
@endsection
