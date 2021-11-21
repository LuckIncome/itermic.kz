@extends('base')

@section('main')

    <section class="section page">
        <div class="page__intro">
            <div class="container">
                <div class="row">
                    <div class="page__intro-inner col-xl-12 text-center">
                        <h2 class="title-section font-weight-400 mb-1">404 страница не найдена</h2>
                        <ul class="breadcrumbs">
                            <li>
                                <a class="link" href="/">Главная</a>
                            </li>
                            <li>
                                <a class="link" href="#">404 страница не найдена</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- /.page__intro -->

        <div class="page-error container">
            <h3 class="page-error__code">404</h3>

            <div class="page-error__desc">
                {!! trans('translations.404.title') !!}
            </div>

            {!! trans('translations.404.link') !!}
        </div><!-- /.page-error -->
    </section>

@endsection
