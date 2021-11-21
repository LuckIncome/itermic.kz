<section class="section page mb-0{{ isset($pageClass) ? ' ' . $pageClass : '' }}">
    <div class="page__intro">
        <div class="container">
            <div class="row">
                <div class="page__intro-inner{{ isset($pageHasAside) ? ' col-xl-8 offset-xl-4 has-pl' : ' col-xl-12 text-center' }}">
                    <h2 class="title-section font-weight-400 mb-1">
                        @if (isset($pageIntroTitle))
                            {{ $pageIntroTitle }}
                        @elseif (isset($section) && $section)
                            {{ $section->name }}
                        @endif
                    </h2>
                    @include('site.blocks.breadcrumbs')
                </div>
            </div>
        </div>
    </div><!-- /.page__intro -->

    <div class="page__inner container{{ isset($pageInnerClass) ? ' ' . $pageInnerClass : '' }}{{ isset($pageHasAside) ? ' has-aside' : '' }}">
        <div class="row">{{ $slot }}</div>
    </div><!-- /.page__inner -->
</section>
